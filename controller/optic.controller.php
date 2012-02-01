<?php
	require_once HTDOCS . '/model/optic.model.php';
	require_once HTDOCS . '/model/optic_type.model.php';
	require_once HTDOCS . '/model/optic_image.model.php';
	require_once HTDOCS . '/model/optic_mark.model.php';
	require_once HTDOCS . '/model/optic_size.model.php';
	require_once HTDOCS . '/model/city.model.php';
	require_once HTDOCS . '/model/currency.model.php';
	require_once HTDOCS . '/classes/upload.class.php';
	
	class OpticController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			echo "Да се направи";
			parent::display('html/templates/home_optics.tpl');
		}
		
		function setOpticData() {
			//Ако се събмитва или не сме в редакция  слагаме каквото е пратено или стойност по подразбиране
			if (($this->getValue('submitForm')) || (empty($_GET['edit']))) {
				$_SESSION['optic_id'] = false;
				$_SESSION['tmp_optic_save']['real_name'] = $this->getValue('real_name');
				$_SESSION['tmp_optic_save']['phone'] = $this->getValue('phone');
				$_SESSION['tmp_optic_save']['email'] = $this->getValue('email');
				$_SESSION['tmp_optic_save']['website'] = $this->getValue('website');
				$_SESSION['tmp_optic_save']['type_id'] = $this->getValue('type_id');
				$_SESSION['tmp_optic_save']['mark_id'] = $this->getValue('mark_id');
				$_SESSION['tmp_optic_save']['model_id'] = $this->getValue('model_id');
				$_SESSION['tmp_optic_save']['size_id'] = $this->getValue('size_id');
				$_SESSION['tmp_optic_save']['price'] = $this->getValue('price');
				$_SESSION['tmp_optic_save']['currency_id'] = $this->getValue('currency_id');
				$_SESSION['tmp_optic_save']['city_id'] = $this->getValue('city_id');
				$_SESSION['tmp_optic_save']['is_old'] = $this->getValue('is_old');
				$_SESSION['tmp_optic_save']['description'] = $this->getValue('description');
			}
				
			//данни за потребителя
			$this->registry->smarty->assign('real_name', $_SESSION['tmp_optic_save']['real_name']);
			$this->registry->smarty->assign('phone', $_SESSION['tmp_optic_save']['phone']);
			$this->registry->smarty->assign('email', $_SESSION['tmp_optic_save']['email']);
			$this->registry->smarty->assign('website', $_SESSION['tmp_optic_save']['website']);
			//данни за обявата
			$this->registry->smarty->assign('type_id', $_SESSION['tmp_optic_save']['type_id']);
			$this->registry->smarty->assign('mark_id', $_SESSION['tmp_optic_save']['mark_id']);
			$this->registry->smarty->assign('model_id', $_SESSION['tmp_optic_save']['model_id']);
			$this->registry->smarty->assign('size_id', $_SESSION['tmp_optic_save']['size_id']);
			$this->registry->smarty->assign('price', $_SESSION['tmp_optic_save']['price']);
			$this->registry->smarty->assign('currency_id', $_SESSION['tmp_optic_save']['currency_id']);
			$this->registry->smarty->assign('city_id', $_SESSION['tmp_optic_save']['city_id']);
			$this->registry->smarty->assign('is_old', $_SESSION['tmp_optic_save']['is_old']);
			$this->registry->smarty->assign('description', $_SESSION['tmp_optic_save']['description']);
		}
		
		/**
		 * 
		 * Формата за добавяне на нова оптика от нерегистриран потребител
		 */
		function ur_add() {
			$this->setOpticData();
				
			$tmp_optic_type = new OpticTypeModel();
			$optic_types = $tmp_optic_type->fetchAll();
			$this->registry->smarty->assign('optic_types', $optic_types);
				
			$tmp_city = new CityModel();
			$cities = $tmp_city->fetchAll();
			$this->registry->smarty->assign('cities', $cities);
				
			$tmp_currency = new CurrencyModel();
			$currency = $tmp_currency->fetchAll();
			$this->registry->smarty->assign('currency', $currency);
				
			$this->display('html/optic/ur_add_optic.tpl');
		}

		/**
		 * 
		 * Запис на данните за оптика
		 * Ако има $_SESSION['optic_id'] то данните се обновяват, в противен случай се записват като нови
		 */
		function save_ur_optic() {
			if (empty($_SESSION['optic_id'])) {
				$this->save_ur_optic_new();
			} else {
				$this->update_ur_optic();
			}
		}
		
		/**
		 * 
		 * Обнявяване на данните
		 * @return boolean
		 */
		private function update_ur_optic() {
			//Взимаме потребителя
			$optic_id = $_SESSION['optic_id'];
			$optic = new OpticModel($_SESSION['optic_id']);
			$optic->fetch();
			
			//Обновяване на потребителските данни
			$user = new UserModel($optic->user->id);
			$_POST['username'] = md5($this->getValue('email') . time());
			$_POST['password'] = $_POST['username'];
			$_SESSION['tmp_username'] = $_POST['username'];
			$_SESSION['tmp_password'] = $_POST['password'];
			$_POST['is_dealer'] = 0;
			$user->setRequiredFields(array('username', 'password', 'email'));
			$user_id = $user->update($_POST);
					
			if (is_array($user_id)) {
				foreach ($user_id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('site_error', 'Не са попълнени всички задължителни полета!!!');
				}
		
				$this->rollBack();
					$this->ur_add();
					return false;
				}
					
				$_POST['user_id'] = $user_id;
				$optic_id = $optic->update($_POST);
				
				if (is_array($optic_id)) {
					foreach ($optic_id as $column) {
						$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
						$this->registry->smarty->assign('site_error', 'Не са попълнени всички задължителни полета!!!');
					}
			
					$this->rollBack();
					$this->ur_add();
					return false;
				}
						
				//Прикачане на картинките за обява
				$optic->deleteImages();
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
					$handle->image_x = 800;
					$handle->image_y = 600;
					$handle->Process(HTDOCS . '/templates/images/user_data/');
					if ($handle->processed) {
						$data = array('optic_id' => $optic_id, 'image' => 'templates/images/user_data/' . $file_name . '.' . $handle->file_src_name_ext);
						$optic_image = new OpticImageModel();
						$optic_image->insert($data);
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
			//Слагаме id-то на пистолета, за да можем да го редактираме
			$_SESSION['optic_id'] = $optic_id;
			$this->preview($optic_id);
		}
		
		/**
		*
		* Запис на оптиката от не регистриран потребител
		*/
		private function save_ur_optic_new() {
			$this->setOpticData();
				
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
				$this->ur_add();
				return false;
			}
			if (empty($user_id)) {
				$this->registry->smarty->assign('site_error', 'Възникна грешка при запис на информацията за контракти!!!');
				
				$this->ur_add();
				return false;
			}
					
			//Запис на обявата за пистолет
			$optic = new OpticModel();
			$_POST['user_id'] = $user_id;
			$optic_id = $optic->insert($_POST);
			
			if (is_array($optic_id)) {
				foreach ($optic_id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('site_error', 'Не са попълнени всички задължителни полета!!!');
				}
			
				$this->rollBack();
				$this->ur_add();
				return false;
			}
			
			if (empty($optic_id)) {
				$this->registry->smarty->assign('site_error', 'Възникна грешка при запис на информацията за обявата!!!');
					
				$this->ur_add();
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
					$handle->image_x = 800;
					$handle->image_y = 600;
					$handle->Process(HTDOCS . '/templates/images/user_data/');
					if ($handle->processed) {
						$data = array('optic_id' => $optic_id, 'image' => 'templates/images/user_data/' . $file_name . '.' . $handle->file_src_name_ext);
						$optic_image = new OpticImageModel();
						$optic_image->insert($data);
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
			//Слагаме id-то на пистолета, за да можем да го редактираме
			$_SESSION['optic_id'] = $optic_id;
			$this->preview($optic_id);
		}
		
		/**
		 * 
		 * Преглед на обява за оптика
		 * @param int $id
		 */
		public function preview($id = false) {
			//Ако е нов пистолет трябва да може да се види от този, който го е вкарал и за това няма да се прави проверка за това дали потребителя е активен
			$is_new_optic = false;
			if (empty($id)) {
				$id = $this->getValue('optic_id', false, '_GET');
			} else {
				$is_new_optic = true;
			}
				
			if ($id) {
				$optic = new OpticModel($id);
				$optic->fetch();
			
				if ((($optic->is_active_user) && ($optic->is_active_admin)) || ($is_new_optic)) {
					$this->registry->smarty->assign('optic', $optic);
					$this->display('html/optic/ur_preview.tpl');
				} else {
					$this->registry->smarty->assign('site_error', 'Обявата не е намерена!!!');
					//TODO: Трябва да се извиква някаква страница на която да се показва грешката
					echo "Трябва да се извиква някаква страница на която да се показва грешката";
				}
			} else {
				$this->redirect(WWW . 'optic/search');
			}
		}
		
		/**
		 * 
		 * Активиране на обявата за оптика
		 */
		public function ur_activate() {
			$optic = new OpticModel();
			$optic->urAcativate($_SESSION['tmp_username'], $_SESSION['tmp_password']);
			$optic = $optic->urFetch($_SESSION['tmp_username'], $_SESSION['tmp_password']);
			if (empty($optic)) {
				$this->registry->smarty->assign('site_error', 'Обявата не е намерена!!!');
			} else {
				$this->preview($optic->id);
			}
		}
		
		
		
		private function setOpticSearchData() {
			$tmp_type = new OpticTypeModel();
			$types = $tmp_type->fetchAll();
			$this->registry->smarty->assign('types', $types);
							
			$tmp_mark = new OpticMarkModel();
			$marks = $tmp_mark->fetchAll();
			$this->registry->smarty->assign('marks', $marks);
			
			$tmp_size = new OpticSizeModel();
			$sizes = $tmp_size->fetchAll();
			$this->registry->smarty->assign('sizes', $sizes);
			
			$tmp_city = new CityModel();
			$cities = $tmp_city->fetchAll();
			$this->registry->smarty->assign('cities', $cities);
			
			$tmp_currencies = new CurrencyModel();
			$currencies = $tmp_currencies->fetchAll();
			$this->registry->smarty->assign('currencies', $currencies);
				
			if ($this->getValue('submitForm')) {
				$_SESSION['tmp_optic_search']['is_old'] = $this->getValue('is_old', array());
				$_SESSION['tmp_optic_search']['type_id'] = $this->getValue('type_id', array());
				$_SESSION['tmp_optic_search']['mark_id'] = $this->getValue('mark_id', array());
				$_SESSION['tmp_optic_search']['model_id'] = $this->getValue('model_id', array());
				$_SESSION['tmp_optic_search']['size_id'] = $this->getValue('size_id', array());
				$_SESSION['tmp_optic_search']['city_id'] = $this->getValue('city_id', array());
				$_SESSION['tmp_optic_search']['order_by'] = $this->getValue('order_by', 'created desc');
				$_SESSION['tmp_optic_search']['start_price'] = $this->getValue('start_price', '');
				$_SESSION['tmp_optic_search']['end_price'] = $this->getValue('end_price', '');
				$_SESSION['tmp_optic_search']['currency_id'] = $this->getValue('currency_id', '');
				$_SESSION['tmp_optic_search']['date'] = $this->getValue('date', '');
				$_SESSION['tmp_optic_search']['has_image'] = $this->getValue('has_image');
		
				return true;
			}
					
			if (empty($_GET['edit_search'])) {
				$_SESSION['tmp_optic_search']['is_old'] = array();
				$_SESSION['tmp_optic_search']['type_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_optic_search']['mark_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_optic_search']['model_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_optic_search']['size_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_optic_search']['city_id'] = array();
				$_SESSION['tmp_optic_search']['order_by'] = 'created desc';
				$_SESSION['tmp_optic_search']['start_price'] = '';
				$_SESSION['tmp_optic_search']['end_price'] = '';
				$_SESSION['tmp_optic_search']['currency_id'] = '';
				$_SESSION['tmp_optic_search']['date'] = '';
				$_SESSION['tmp_optic_search']['has_image'] = '';
							
				return true;
			}
		}
		
		public function search() {
			$this->setOpticSearchData();
					
			$this->display('html/optic/search.tpl');
		}
		
		public function results() {
			print_r($_POST);
			$filter = array('filter' => ' where is_active_user = 1 and is_active_admin = 1 ', 'values' => array());
			
			$this->setOpticSearchData();
			
			if ($_SESSION['tmp_optic_search']['start_price']) {
				$this->registry->smarty->assign('start_price_text', 'от ' . $_SESSION['tmp_optic_search']['start_price']);
			} else {
				$this->registry->smarty->assign('start_price_text', '');
			}
			if ($_SESSION['tmp_optic_search']['end_price']) {
				$this->registry->smarty->assign('end_price_text', 'до ' . $_SESSION['tmp_optic_search']['end_price']);
			} else {
				if ($_SESSION['tmp_optic_search']['start_price']) {
					$this->registry->smarty->assign('end_price_text', '');
				} else {
					$this->registry->smarty->assign('end_price_text', 'Без значение');
				}
			}
			
			
			if ((count($_SESSION['tmp_optic_search']['is_old']) == 2) || (count($_SESSION['tmp_optic_search']['is_old']) == 0)) {
				$this->registry->smarty->assign('is_old_text', 'Употребявани и Нови');
			} else {
				$filter['filter'] .= ' and is_old = :is_old';
				$filter['values']['is_old'] = $_SESSION['tmp_optic_search']['is_old'][0];
				$this->registry->smarty->assign('is_old_text', $_SESSION['tmp_optic_search']['is_old'][0]?'Употребявани':'Нови');
			}
			
			//Филтрите за типовете пистолети
			$tmp_filter = '';
			$type_id_text = '';
			foreach($_SESSION['tmp_optic_search']['type_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':type_id_' . $key . ', ';
				$filter['values']['type_id_' . $key] = $value;
				$optic_type = new OpticTypeModel($value);
				$optic_type->fetch();
				$type_id_text .= $optic_type->type . ', ';
			}
			if (!empty($type_id_text)) {
				$type_id_text = trim($type_id_text, ', ');
				$this->registry->smarty->assign('type_id_text', $type_id_text);
				
				$tmp_filter = trim($tmp_filter, ', ');
				$filter['filter'] .= ' and type_id in (' . $tmp_filter . ') ';
			} else {
				$this->registry->smarty->assign('type_id_text', 'Всички');
			}
			
			//Филтрите за марките пистолети
			$tmp_filter = '';
			$mark_id_text = '';
			foreach($_SESSION['tmp_optic_search']['mark_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':mark_id_' . $key . ', ';
				$filter['values']['mark_id_' . $key] = $value;
				$optic_mark = new OpticMarkModel($value);
				$optic_mark->fetch();
				$mark_id_text .= $optic_mark->mark . ', ';
			}
			if (!empty($mark_id_text)) {			
				$mark_id_text = trim($mark_id_text, ', ');
				$this->registry->smarty->assign('mark_id_text', $mark_id_text);
				
				$tmp_filter = trim($tmp_filter, ', ');
				$filter['filter'] .= ' and mark_id in (' . $tmp_filter . ') ';
			} else {
				$this->registry->smarty->assign('mark_id_text', 'Всички');
			}
			
			//Филтрите за моделите пистолети
			$tmp_filter = '';
			$model_id_text = '';
			foreach($_SESSION['tmp_optic_search']['model_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':model_id_' . $key . ', ';
				$filter['values']['model_id_' . $key] = $value;
				$optic_model = new OpticModelModel($value);
				$optic_model->fetch();
				$model_id_text .= $optic_model->model . ', ';
			}
			if (!empty($model_id_text)) {			
				$model_id_text = trim($model_id_text, ', ');
				$this->registry->smarty->assign('model_id_text', $model_id_text);
				
				$tmp_filter = trim($tmp_filter, ', ');
				$filter['filter'] .= ' and model_id in (' . $tmp_filter . ') ';
			} else {
				$this->registry->smarty->assign('model_id_text', 'Всички');
			}
			
			//Филтрите за калибрите пистолети
			$tmp_filter = '';
			$size_id_text = '';
			foreach($_SESSION['tmp_optic_search']['size_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':size_id_' . $key . ', ';
				$filter['values']['size_id_' . $key] = $value;
				$optic_size = new OpticSizeModel($value);
				$optic_size->fetch();
				$size_id_text .= $optic_size->size . ', ';
			}
			if (!empty($size_id_text)) {
				$size_id_text = trim($size_id_text, ', ');
				$this->registry->smarty->assign('size_id_text', $size_id_text);
				
				$tmp_filter = trim($tmp_filter, ', ');
				$filter['filter'] .= ' and size_id in (' . $tmp_filter . ') ';
			} else {
				$this->registry->smarty->assign('size_id_text', 'Всички');
			}
			
			if (!empty($_SESSION['tmp_optic_search']['city_id'])) {
				$tmp_filter = '';
				$city_id_text = '';
				foreach($_SESSION['tmp_optic_search']['city_id'] as $key=>$value) {
					$tmp_filter .= ':city_id_' . $key . ', ';
					$filter['values']['city_id_' . $key] = $value;
					$city = new CityModel($value);
					$city->fetch();
					$city_id_text .= $city->city . ', ';
				}
				$city_id_text = trim($city_id_text, ', ');
				$this->registry->smarty->assign('city_id_text', $city_id_text);
				
				$tmp_filter = trim($tmp_filter, ', ');
				$filter['filter'] .= ' and city_id in (' . $tmp_filter . ') ';
			} else {
				$this->registry->smarty->assign('city_id_text', 'Всички');
			}
			
			//Филтрите за цената
			if ((!empty($_SESSION['tmp_optic_search']['currency_id'])) && ($_SESSION['tmp_optic_search']['currency_id'] == 2)) {
				$correction = COURSE_EUR;
			} else {
				$correction = 1;
			}
			if (!empty($_SESSION['tmp_optic_search']['start_price'])) {
				$filter['filter'] .= ' and real_price >= :start_price ';
				$filter['values']['start_price'] = $_SESSION['tmp_optic_search']['start_price'] * $correction;
			}
			if (!empty($_SESSION['tmp_optic_search']['end_price'])) {
				$filter['filter'] .= ' and real_price <= :end_price ';
				$filter['values']['end_price'] = $_SESSION['tmp_optic_search']['end_price'] * $correction;
			}
			
			print_r($filter);
			
			$results_per_page = 20;
			$page = empty($_POST['page'])?'1':$_POST['page'];
			$start_result = ($page - 1) * $results_per_page;
			
			$filter['filter'] .= " order by " . $_SESSION['tmp_optic_search']['order_by'] . " limit " . $start_result . ", " . $results_per_page;
			
			$tmp_optic = new OpticModel();
			$optics = $tmp_optic->fetchAll($filter);
			$this->registry->smarty->assign('optics', $optics);
			$all_result = $tmp_optic->count($filter); 
			
			$end_result = count($optics) + $start_result;
			$max_page = ceil($all_result/$results_per_page);
			
			$this->registry->smarty->assign('page', $page);
			$this->registry->smarty->assign('max_page', $max_page);
			$this->registry->smarty->assign('start_result', $start_result + 1);
			$this->registry->smarty->assign('end_result', $end_result);
			$this->registry->smarty->assign('all_result', $all_result);
			
			$results_button = 9;
			if ($page <= floor($results_button / 2)) {
				$this->registry->smarty->assign('start_button', 1);
				if ($max_page < $results_button) {
					$this->registry->smarty->assign('end_button', $max_page);
				} else {
					$this->registry->smarty->assign('end_button', $results_button);
				}
			} else {
				$this->registry->smarty->assign('start_button', $page - floor($results_button / 2));
				if ($page >= $max_page - floor($results_button / 2)) {
					$this->registry->smarty->assign('start_button', $max_page - $results_button);
					$this->registry->smarty->assign('end_button', $max_page);
				}
			}
			
			$this->display('html/optic/results.tpl');
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
			$tmp_marks = new OpticMarkModel();
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
		
		/**
		*
		* Връща моделите на дадена марка оптика в json формат
		* @return boolean
		*/
		function models() {
			$mark_id = $this->getValue('mark_id', false, '_GET');
			if (empty($mark_id)) {
				return false;
			}
				
			$return = array();
			$tmp_models = new OpticModelModel();
			$models = $tmp_models->fetchAll(array('filter' => ' where mark_id = :mark_id', 'values' => array('mark_id' => $mark_id)));
			foreach ($models as $model) {
				$tmp = new stdClass();
				$tmp->id = $model->id;
				$tmp->model = $model->model;
				$return[] = $tmp;
			}
			echo json_encode($return);
				
			return true;
		}
		
		function sizes() {
			$model_id = $this->getValue('model_id', false, '_GET');
			if (empty($model_id)) {
				return false;
			}
				
			$return = array();
			$tmp_size = new OpticSizeModel();
			$sizes = $tmp_size->fetchAll(array('filter' => ' where model_id = :model_id', 'values' => array('model_id' => $model_id)));
			foreach ($sizes as $size) {
				$tmp = new stdClass();
				$tmp->id = $size->id;
				$tmp->mark = $size->size;
				$return[] = $tmp;
			}
			echo json_encode($return);
				
			return true;
		}
	}