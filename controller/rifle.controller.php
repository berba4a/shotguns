<?php
	require_once HTDOCS . '/model/rifle.model.php';
	require_once HTDOCS . '/model/rifle_type.model.php';
	require_once HTDOCS . '/model/rifle_image.model.php';
	require_once HTDOCS . '/model/rifle_mark.model.php';
	require_once HTDOCS . '/model/rifle_caliber.model.php';
	require_once HTDOCS . '/model/city.model.php';
	require_once HTDOCS . '/model/currency.model.php';
	require_once HTDOCS . '/classes/upload.class.php';
	
	class RifleController Extends BaseController {
		
		function __construct($registry) {
			
			
			parent::__construct($registry);
		}
		
		function index() {
			//Последно добавените пистолети
			$filter = array('filter' => ' where is_active_user = 1 and is_active_admin = 1 order by created desc limit 12', 'values' => array());
			$tmp_rifle = new RifleModel();
			$rifles = $tmp_rifle->fetchAll($filter);
			$this->registry->smarty->assign('rifles', $rifles);
			
			//Попълване на филтрите
			$this->setRifleSearchData();
			
			parent::display('html/rifle/index.tpl');
		}
		
		function setRifleData() {
			//Ако се събмитва или не сме в редакция  слагаме каквото е пратено или стойност по подразбиране
			if (($this->getValue('submitForm')) || (empty($_GET['edit']))) {
				$_SESSION['rifle_id'] = false;
				$_SESSION['tmp_rifle_save']['real_name'] = $this->getValue('real_name');
				$_SESSION['tmp_rifle_save']['phone'] = $this->getValue('phone');
				$_SESSION['tmp_rifle_save']['email'] = $this->getValue('email');
				$_SESSION['tmp_rifle_save']['website'] = $this->getValue('website');
				$_SESSION['tmp_rifle_save']['type_id'] = $this->getValue('type_id');
				$_SESSION['tmp_rifle_save']['mark_id'] = $this->getValue('mark_id');
				$_SESSION['tmp_rifle_save']['model_id'] = $this->getValue('model_id');
				$_SESSION['tmp_rifle_save']['caliber_id'] = $this->getValue('caliber_id');
				$_SESSION['tmp_rifle_save']['price'] = $this->getValue('price');
				$_SESSION['tmp_rifle_save']['currency_id'] = $this->getValue('currency_id');
				$_SESSION['tmp_rifle_save']['city_id'] = $this->getValue('city_id');
				$_SESSION['tmp_rifle_save']['is_old'] = $this->getValue('is_old');
				$_SESSION['tmp_rifle_save']['description'] = $this->getValue('description');
			}
			
			//данни за потребителя
			$this->registry->smarty->assign('real_name', $_SESSION['tmp_rifle_save']['real_name']);
			$this->registry->smarty->assign('phone', $_SESSION['tmp_rifle_save']['phone']);
			$this->registry->smarty->assign('email', $_SESSION['tmp_rifle_save']['email']);
			$this->registry->smarty->assign('website', $_SESSION['tmp_rifle_save']['website']);
			//данни за обявата
			$this->registry->smarty->assign('type_id', $_SESSION['tmp_rifle_save']['type_id']);
			$this->registry->smarty->assign('mark_id', $_SESSION['tmp_rifle_save']['mark_id']);
			$this->registry->smarty->assign('model_id', $_SESSION['tmp_rifle_save']['model_id']);
			$this->registry->smarty->assign('caliber_id', $_SESSION['tmp_rifle_save']['caliber_id']);
			$this->registry->smarty->assign('price', $_SESSION['tmp_rifle_save']['price']);
			$this->registry->smarty->assign('currency_id', $_SESSION['tmp_rifle_save']['currency_id']);
			$this->registry->smarty->assign('city_id', $_SESSION['tmp_rifle_save']['city_id']);
			$this->registry->smarty->assign('is_old', $_SESSION['tmp_rifle_save']['is_old']);
			$this->registry->smarty->assign('description', $_SESSION['tmp_rifle_save']['description']);
		}
		
		/**
		 * 
		 * Добавяне на пистолет от не регистриран потребител
		 */
		function ur_add() {
			$this->setRifleData();
			
			$tmp_rifle_type = new RifleTypeModel();
			$rifle_types = $tmp_rifle_type->fetchAll();
			$this->registry->smarty->assign('rifle_types', $rifle_types);
			
			$tmp_city = new CityModel();
			$cities = $tmp_city->fetchAll();
			$this->registry->smarty->assign('cities', $cities);
			
			$tmp_currency = new CurrencyModel();
			$currency = $tmp_currency->fetchAll();
			$this->registry->smarty->assign('currency', $currency);
			
			$this->display('html/rifle/ur_add_rifle.tpl');
		}
		
		function ur_update() {
			$this->ur_add;
		}
		
		function save_ur_rifle() {
			if (empty($_SESSION['rifle_id'])) {
				$this->save_ur_rifle_new();
			} else {
				$this->update_ur_rifle();
			}
		}
		
		private function update_ur_rifle() {
			//Взимаме потребителя
			$rifle_id = $_SESSION['rifle_id'];
			$rifle = new RifleModel($_SESSION['rifle_id']);
			$rifle->fetch();
			
			//Обновяване на потребителските данни
			$user = new UserModel($rifle->user->id);
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
			$rifle_id = $rifle->update($_POST);
				
			if (is_array($rifle_id)) {
				foreach ($rifle_id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('site_error', 'Не са попълнени всички задължителни полета!!!');
				}
					
				$this->rollBack();
				$this->ur_add();
				return false;
			}
				
			//Прикачане на картинките за обява
			$rifle->deleteImages();
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
						$data = array('rifle_id' => $rifle_id, 'image' => 'templates/images/user_data/' . $file_name . '.' . $handle->file_src_name_ext);
						$rifle_image = new RifleImageModel();
						$rifle_image->insert($data);
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
			$_SESSION['rifle_id'] = $rifle_id;
			$this->preview($rifle_id);
		}
		
		/**
		 * 
		 * Запис на пистолет от не регистриран потребител
		 */
		private function save_ur_rifle_new() {
			$this->setRifleData();
			
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
			$rifle = new RifleModel();
			$_POST['user_id'] = $user_id;
			$rifle_id = $rifle->insert($_POST);
			
			if (is_array($rifle_id)) {
				foreach ($rifle_id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('site_error', 'Не са попълнени всички задължителни полета!!!');
				}
			
				$this->rollBack();
				$this->ur_add();
				return false;
			}
			
			if (empty($rifle_id)) {
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
						$data = array('rifle_id' => $rifle_id, 'image' => 'templates/images/user_data/' . $file_name . '.' . $handle->file_src_name_ext);
						$rifle_image = new RifleImageModel();
						$rifle_image->insert($data);
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
			$_SESSION['rifle_id'] = $rifle_id;
			$this->preview($rifle_id);
		}
		
		public function preview($id = false) {
			//Ако е нов пистолет трябва да може да се види от този, който го е вкарал и за това няма да се прави проверка за това дали потребителя е активен 
			$is_new_rifle = false;
			if (empty($id)) {
				$id = $this->getValue('rifle_id', false, '_GET');
			} else {
				$is_new_rifle = true;
			}
			
			if ($id) {
				$rifle = new RifleModel($id);
				$rifle->fetch();
				
				if ((($rifle->is_active_user) && ($rifle->is_active_admin)) || ($is_new_rifle)) {
					$this->registry->smarty->assign('rifle', $rifle);
					$this->display('html/rifle/ur_preview.tpl');
				} else {
					$this->registry->smarty->assign('site_error', 'Обявата не е намерена!!!');
					//TODO: Трябва да се извиква някаква страница на която да се показва грешката
					echo "Трябва да се извиква някаква страница на която да се показва грешката";
				}
			} else {
				$this->redirect(WWW . 'rifle/search');
			}
		}
		
		public function ur_activate() {
			$rifle = new RifleModel();
			$rifle->urAcativate($_SESSION['tmp_username'], $_SESSION['tmp_password']);
			$rifle = $rifle->urFetch($_SESSION['tmp_username'], $_SESSION['tmp_password']);
			if (empty($rifle)) {
				$this->registry->smarty->assign('site_error', 'Обявата не е намерена!!!');
			} else {
				$this->preview($rifle->id);
			}
		}
		
		private function setRifleSearchData() {
			$tmp_type = new RifleTypeModel();
			$types = $tmp_type->fetchAll();
			$this->registry->smarty->assign('types', $types);
				
			$tmp_mark = new RifleMarkModel();
			$marks = $tmp_mark->fetchAll();
			$this->registry->smarty->assign('marks', $marks);
				
			$tmp_caliber = new RifleCaliberModel();
			$calibers = $tmp_caliber->fetchAll();
			$this->registry->smarty->assign('calibers', $calibers);
				
			$tmp_city = new CityModel();
			$cities = $tmp_city->fetchAll();
			$this->registry->smarty->assign('cities', $cities);
				
			$tmp_currencies = new CurrencyModel();
			$currencies = $tmp_currencies->fetchAll();
			$this->registry->smarty->assign('currencies', $currencies);
			
			if ($this->getValue('submitForm')) {
				$_SESSION['tmp_rifle_search']['is_old'] = $this->getValue('is_old', array());
				$_SESSION['tmp_rifle_search']['type_id'] = $this->getValue('type_id', array());
				$_SESSION['tmp_rifle_search']['mark_id'] = $this->getValue('mark_id', array());
				$_SESSION['tmp_rifle_search']['model_id'] = $this->getValue('model_id', array());
				$_SESSION['tmp_rifle_search']['caliber_id'] = $this->getValue('caliber_id', array());
				$_SESSION['tmp_rifle_search']['city_id'] = $this->getValue('city_id', array());
				$_SESSION['tmp_rifle_search']['order_by'] = $this->getValue('order_by', 'created desc');
				$_SESSION['tmp_rifle_search']['start_price'] = $this->getValue('start_price', '');
				$_SESSION['tmp_rifle_search']['end_price'] = $this->getValue('end_price', '');
				$_SESSION['tmp_rifle_search']['currency_id'] = $this->getValue('currency_id', '');
				$_SESSION['tmp_rifle_search']['date'] = $this->getValue('date', '');
				$_SESSION['tmp_rifle_search']['has_image'] = $this->getValue('has_image');
				
				return true;
			}
			
			if (empty($_GET['edit_search'])) {
				$_SESSION['tmp_rifle_search']['is_old'] = array();
				$_SESSION['tmp_rifle_search']['type_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_rifle_search']['mark_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_rifle_search']['model_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_rifle_search']['caliber_id'] = array(0 => '', 1 => '', 2 => '');
				$_SESSION['tmp_rifle_search']['city_id'] = array();
				$_SESSION['tmp_rifle_search']['order_by'] = 'created desc';
				$_SESSION['tmp_rifle_search']['start_price'] = '';
				$_SESSION['tmp_rifle_search']['end_price'] = '';
				$_SESSION['tmp_rifle_search']['currency_id'] = '';
				$_SESSION['tmp_rifle_search']['date'] = '';
				$_SESSION['tmp_rifle_search']['has_image'] = '';
				
				return true;
			}
		}
		
		public function search() {
			$this->setRifleSearchData();
			
			$this->display('html/rifle/search.tpl');
		}
		
		public function results() {
			$filter = array('filter' => ' where is_active_user = 1 and is_active_admin = 1 ', 'values' => array());
			
			$this->setRifleSearchData();
			
			if ($_SESSION['tmp_rifle_search']['start_price']) {
				$this->registry->smarty->assign('start_price_text', 'от ' . $_SESSION['tmp_rifle_search']['start_price']);
			} else {
				$this->registry->smarty->assign('start_price_text', '');
			}
			if ($_SESSION['tmp_rifle_search']['end_price']) {
				$this->registry->smarty->assign('end_price_text', 'до ' . $_SESSION['tmp_rifle_search']['end_price']);
			} else {
				if ($_SESSION['tmp_rifle_search']['start_price']) {
					$this->registry->smarty->assign('end_price_text', '');
				} else {
					$this->registry->smarty->assign('end_price_text', 'Без значение');
				}
			}
			
			
			if ((count($_SESSION['tmp_rifle_search']['is_old']) == 2) || (count($_SESSION['tmp_rifle_search']['is_old']) == 0)) {
				$this->registry->smarty->assign('is_old_text', 'Употребявани и Нови');
			} else {
				$filter['filter'] .= ' and is_old = :is_old';
				$filter['values']['is_old'] = $_SESSION['tmp_rifle_search']['is_old'][0];
				$this->registry->smarty->assign('is_old_text', $_SESSION['tmp_rifle_search']['is_old'][0]?'Употребявани':'Нови');
			}
			
			//Филтрите за типовете пистолети
			$tmp_filter = '';
			$type_id_text = '';
			foreach($_SESSION['tmp_rifle_search']['type_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':type_id_' . $key . ', ';
				$filter['values']['type_id_' . $key] = $value;
				$rifle_type = new RifleTypeModel($value);
				$rifle_type->fetch();
				$type_id_text .= $rifle_type->type . ', ';
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
			foreach($_SESSION['tmp_rifle_search']['mark_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':mark_id_' . $key . ', ';
				$filter['values']['mark_id_' . $key] = $value;
				$rifle_mark = new RifleMarkModel($value);
				$rifle_mark->fetch();
				$mark_id_text .= $rifle_mark->mark . ', ';
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
			foreach($_SESSION['tmp_rifle_search']['model_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':model_id_' . $key . ', ';
				$filter['values']['model_id_' . $key] = $value;
				$rifle_model = new RifleModelModel($value);
				$rifle_model->fetch();
				$model_id_text .= $rifle_model->model . ', ';
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
			$caliber_id_text = '';
			foreach($_SESSION['tmp_rifle_search']['caliber_id'] as $key=>$value) {
				if (empty($value)) continue;
				$tmp_filter .= ':caliber_id_' . $key . ', ';
				$filter['values']['caliber_id_' . $key] = $value;
				$rifle_caliber = new RifleCaliberModel($value);
				$rifle_caliber->fetch();
				$caliber_id_text .= $rifle_caliber->caliber . ', ';
			}
			if (!empty($caliber_id_text)) {
				$caliber_id_text = trim($caliber_id_text, ', ');
				$this->registry->smarty->assign('caliber_id_text', $caliber_id_text);
				
				$tmp_filter = trim($tmp_filter, ', ');
				$filter['filter'] .= ' and caliber_id in (' . $tmp_filter . ') ';
			} else {
				$this->registry->smarty->assign('caliber_id_text', 'Всички');
			}
			
			if (!empty($_SESSION['tmp_rifle_search']['city_id'])) {
				$tmp_filter = '';
				$city_id_text = '';
				foreach($_SESSION['tmp_rifle_search']['city_id'] as $key=>$value) {
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
			if ((!empty($_SESSION['tmp_rifle_search']['currency_id'])) && ($_SESSION['tmp_rifle_search']['currency_id'] == 2)) {
				$correction = COURSE_EUR;
			} else {
				$correction = 1;
			}
			if (!empty($_SESSION['tmp_rifle_search']['start_price'])) {
				$filter['filter'] .= ' and real_price >= :start_price ';
				$filter['values']['start_price'] = $_SESSION['tmp_rifle_search']['start_price'] * $correction;
			}
			if (!empty($_SESSION['tmp_rifle_search']['end_price'])) {
				$filter['filter'] .= ' and real_price <= :end_price ';
				$filter['values']['end_price'] = $_SESSION['tmp_rifle_search']['end_price'] * $correction;
			}
			
			print_r($filter);
			
			$results_per_page = 20;
			$page = empty($_POST['page'])?'1':$_POST['page'];
			$start_result = ($page - 1) * $results_per_page;
			
			$filter['filter'] .= " order by " . $_SESSION['tmp_rifle_search']['order_by'] . " limit " . $start_result . ", " . $results_per_page;
			
			$tmp_rifle = new RifleModel();
			$rifles = $tmp_rifle->fetchAll($filter);
			$this->registry->smarty->assign('rifles', $rifles);
			$all_result = $tmp_rifle->count($filter); 
			
			$end_result = count($rifles) + $start_result;
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
			
			$this->display('html/rifle/results.tpl');
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
			$tmp_marks = new RifleMarkModel();
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
		* Връща моделите на дадена марка пистолет в json формат
		* @return boolean
		*/
		function models() {
			$mark_id = $this->getValue('mark_id', false, '_GET');
			if (empty($mark_id)) {
				return false;
			}
				
			$return = array();
			$tmp_models = new RifleModelModel();
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
		
		function calibers() {
			$model_id = $this->getValue('model_id', false, '_GET');
			if (empty($model_id)) {
				return false;
			}
				
			$return = array();
			$tmp_caliber = new RifleCaliberModel();
			$calibers = $tmp_caliber->fetchAll(array('filter' => ' where model_id = :model_id', 'values' => array('model_id' => $model_id)));
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