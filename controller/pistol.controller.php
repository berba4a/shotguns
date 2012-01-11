<?php
	require_once HTDOCS . '/model/pistol.model.php';
	require_once HTDOCS . '/model/pistol_type.model.php';
	require_once HTDOCS . '/model/pistol_image.model.php';
	require_once HTDOCS . '/model/pistol_mark.model.php';
	require_once HTDOCS . '/model/pistol_caliber.model.php';
	require_once HTDOCS . '/model/city.model.php';
	require_once HTDOCS . '/model/currency.model.php';
	require_once HTDOCS . '/classes/upload.class.php';
	
	class PistolController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			parent::display('html/index/login.tpl');
		}
		
		function setPistolData() {
			//данни за потребителя
			$this->registry->smarty->assign('real_name', $this->getValue('real_name'));
			$this->registry->smarty->assign('phone', $this->getValue('phone'));
			$this->registry->smarty->assign('email', $this->getValue('email'));
			$this->registry->smarty->assign('website', $this->getValue('website'));
			//данни за обявата
			$this->registry->smarty->assign('type_id', $this->getValue('type_id'));
			$this->registry->smarty->assign('mark_id', $this->getValue('mark_id'));
			$this->registry->smarty->assign('caliber_id', $this->getValue('caliber_id'));
			$this->registry->smarty->assign('price', $this->getValue('price'));
			$this->registry->smarty->assign('currency_id', $this->getValue('currency_id'));
			$this->registry->smarty->assign('city_id', $this->getValue('city_id'));
			$this->registry->smarty->assign('is_old', $this->getValue('is_old'));
			$this->registry->smarty->assign('description', $this->getValue('description'));
			$this->registry->smarty->assign('is_old', $this->getValue('is_old'));
			$this->registry->smarty->assign('is_old', $this->getValue('is_old'));
			$this->registry->smarty->assign('is_old', $this->getValue('is_old'));
			$this->registry->smarty->assign('is_old', $this->getValue('is_old'));
		}
		
		/**
		 * 
		 * Добавяне на пистолет от не регистриран потребител
		 */
		function ur_add_pistol() {
			$this->setPistolData();
			
			$tmp_pistol_type = new PistolTypeModel();
			$pistol_types = $tmp_pistol_type->fetchAll();
			$this->registry->smarty->assign('pistol_types', $pistol_types);
			
			$tmp_city = new CityModel();
			$cities = $tmp_city->fetchAll();
			$this->registry->smarty->assign('cities', $cities);
			
			$tmp_currency = new CurrencyModel();
			$currency = $tmp_currency->fetchAll();
			$this->registry->smarty->assign('currency', $currency);
			
			$this->display('html/pistol/ur_add_pistol.tpl');
		}
		
		/**
		 * 
		 * Запис на пистолет от не регистриран потребител
		 */
		function save_ur_pistol() {
			//Запис на потребителските данни
			$user = new UserModel();
			$_POST['username'] = md5($this->getValue('email') . time());
			$_POST['password'] = $_POST['username'];
			$_SESSION['tmp_username'] = $_POST['username'];
			$_SESSION['tmp_password'] = $_POST['password'];
			$_POST['is_dealer'] = 0;
			$user->setRequiredFields(array('username', 'password', 'email'));
			$user_id = $user->insert($_POST);
			
			if (is_array($user_id)) {
				foreach ($user_id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('site_error', 'Не са попълнени всички задължителни полета!!!');
				}

				$this->rollBack();
				$this->ur_add_pistol();
				return false;
			}
			
			if (empty($user_id)) {
				$this->registry->smarty->assign('site_error', 'Възникна грешка при запис на информацията за контракти!!!');
				
				$this->ur_add_pistol();
				return false;
			}
			
			//Запис на обявата за пистолет
			$pistol = new PistolModel();
			$_POST['user_id'] = $user_id;
			$pistol_id = $pistol->insert($_POST);
			
			if (is_array($pistol_id)) {
				foreach ($pistol_id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('site_error', 'Не са попълнени всички задължителни полета!!!');
				}
			
				$this->rollBack();
				$this->ur_add_pistol();
				return false;
			}
				
			if (empty($pistol_id)) {
				$this->registry->smarty->assign('site_error', 'Възникна грешка при запис на информацията за обявата!!!');
			
				$this->ur_add_pistol();
				return false;
			}
			
			//Прикачане на картинките за обява
			$files = array();
			foreach ($_FILES['images'] as $k => $l) {
				foreach ($l as $i => $v) {
					if (!array_key_exists($i, $files))
					$files[$i] = array();
					$files[$i][$k] = $v;
				}
			}
			foreach ($files as $file) {
				$handle = new Upload($file);
				if ($handle->uploaded) {
					$file_name = time() . '_' . rand(1,10000);
					$handle->file_new_name_body = $file_name;
					$handle->image_resize = true;
					$handle->image_x = 360;
					$handle->image_y = 270;
					$handle->Process(HTDOCS . '/templates/images/user_data/');
					if ($handle->processed) {
						$data = array('pistol_id' => $pistol_id, 'image' => 'templates/images/user_data/' . $file_name . '.' . $handle->file_src_name_ext);
						$pistol_image = new PistolImageModel();
						$pistol_image->insert($data);
					} else {
						$this->rollBack();
						$this->registry->smarty->assign('site_error', 'Възникна грешка при запис на снимките към обявата!!!');
						//TODO: Запис на грешката в лог файл
					}
				} else {
					$this->rollBack();
					$this->registry->smarty->assign('site_error', 'Възникна грешка при запис на снимките към обявата!!!');
					//TODO: Запис на грешката в лог файл
// 					echo 'Error: ' . $handle->error;
				}
				unset($handle);
			}
			
			$this->registry->smarty->assign('save_preview', true);
			$this->preview($pistol_id);
		}
		
		public function preview($id = false) {
			if (empty($id)) {
				$id = $this->getValue('pistol_id', false, '_GET');
			}
			
			if ($id) {
				$pistol = new PistolModel($id);
				$pistol->fetch();
				
				if (($pistol->is_active_user) && ($pistol->is_active_admin)) {
					$this->registry->smarty->assign('pistol', $pistol);
					$this->display('html/pistol/ur_preview.tpl');
				} else {
					$this->registry->smarty->assign('site_error', 'Обявата не е намерена!!!');
				}
			} else {
				$this->redirect(WWW . 'pistol/search');
			}
		}
		
		public function ur_activate() {
			$pistol = new PistolModel();
			$pistol->urAcativate($_SESSION['tmp_username'], $_SESSION['tmp_password']);
			$pistol = $pistol->urFetch($_SESSION['tmp_username'], $_SESSION['tmp_password']);
			if (empty($pistol)) {
				$this->registry->smarty->assign('site_error', 'Обявата не е намерена!!!');
			} else {
				$this->preview($pistol->id);
			}
		}
		
		/**
		 * 
		 * Връяа марките на даден вид пистолет в json формат
		 * @return boolean
		 */
		function marks() {
			$type_id = $this->getValue('type_id', false, '_GET');
			if (empty($type_id)) {
				return false;
			}
			
			$return = array();
			$tmp_marks = new PistolMarkModel();
			$marks = $tmp_marks->fetchAll(array('filter' => ' where type_id = :type_id', 'values' => array('type_id' => $type_id)));
			foreach ($marks as $mark) {
				$tmp = new stdClass();
				$tmp->id = $mark->id;
				$tmp->mark = $mark->mark;
				$return[] = $tmp;
			}
			echo json_encode($return);
			
			return true;
		}
		
		function calibers() {
			$mark_id = $this->getValue('mark_id', false, '_GET');
			if (empty($mark_id)) {
				return false;
			}
				
			$return = array();
			$tmp_caliber = new PistolCaliberModel();
			$calibers = $tmp_caliber->fetchAll(array('filter' => ' where mark_id = :mark_id', 'values' => array('mark_id' => $mark_id)));
			foreach ($calibers as $caliber) {
				$tmp = new stdClass();
				$tmp->id = $caliber->id;
				$tmp->mark = $caliber->caliber;
				$return[] = $tmp;
			}
			echo json_encode($return);
				
			return true;
		}
	}