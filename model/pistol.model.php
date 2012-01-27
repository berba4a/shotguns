<?php
	require_once 'pistol_type.model.php';
	require_once 'pistol_mark.model.php';
	require_once 'pistol_model.model.php';
	require_once 'pistol_caliber.model.php';
	require_once 'pistol_image.model.php';
	require_once 'user.model.php';
	require_once 'currency.model.php';
	
	class PistolModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var PistolTypeModel
		 */
		public $type;
		/**
		 * 
		 * Enter description here ...
		 * @var PistolMarkModel
		 */
		public $mark;
		/**
		 * 
		 * Enter description here ...
		 * @var PistolModelModel
		 */
		public $model;
		/**
		 * 
		 * Enter description here ...
		 * @var CityModel
		 */
		public $city;
		/**
		 * 
		 * Enter description here ...
		 * @var PistolCaliberModel
		 */
		public $caliber;
		/**
		 * 
		 * Enter description here ...
		 * @var UserModel
		 */
		public $user;
		/**
		 * 
		 * Enter description here ...
		 * @var CurrencyModel
		 */
		public $currency;
		/**
		 * 
		 * Enter description here ...
		 * @var Array<PistolImage>
		 */
		public $images;
		
		function __construct($primary_key_value = false) {
			$this->table = 'pistols';
			$this->columns = array ('id', 'user_id', 'is_old', 'type_id', 'mark_id', 'model_id', 'caliber_id', 'city_id', 'price', 'real_price', 'currency_id', 'description', 'is_active_user', 'is_active_admin', 'created');
			$this->required = array ('user_id', 'type_id', 'mark_id', 'model_id', 'caliber_id', 'city_id', 'price', 'real_price', 'currency_id');
			parent::__construct($primary_key_value);
		}
		
		function getType() {
			$this->type = new PistolTypeModel($this->type_id);
			$this->type->fetch();
		}
		
		function getMark() {
			$this->mark = new PistolMarkModel($this->mark_id);
			$this->mark->fetch();
		}
		
		function getModel() {
			$this->model = new PistolModelModel($this->model_id);
			$this->model->fetch();
		}
		
		function getCaliber() {
			$this->caliber = new PistolCaliberModel($this->caliber_id);
			$this->caliber->fetch();
		}
		
		function getCity() {
			$this->city = new CityModel($this->city_id);
			$this->city->fetch();
		}
		
		function getUser() {
			$this->user = new UserModel($this->user_id);
			$this->user->fetch();
		}
		
		function getCurrency() {
			$this->currency = new CurrencyModel($this->currency_id);
			$this->currency->fetch();
		}
		
		function getImages() {
			$tmp_image = new PistolImageModel();
			$this->images = $tmp_image->fetchAll(array('filter' => ' where pistol_id = :pistol_id', 'values' => array('pistol_id' => $this->id)));
			while (count($this->images) < 10) {
				$tmp_image = new stdClass();
				$tmp_image->image = 'templates/images/testLogo.jpg';
				$this->images[] = $tmp_image;
			}
		}
		
		function urAcativate($username, $password) {
			$query = "
				update pistols set is_active_user = 1 where user_id = (select id from users u where u.username = :username and u.password = :password limit 1);
			";
			
			return $this->db->execute($query, array('username' => $username, 'password' => $password), true, true);
		}
		
		function urFetch($username, $password) {
			$user = new UserModel();
			$user = $user->getByUserAndPass($username, $password);
			if (empty($user))
				return false;
			
			$pistols = $this->fetchAll(array('filter' => ' where user_id = :user_id', 'values' => array('user_id' => $user->id)));
			if (empty($pistols))
				return false;
			
			return $pistols[0];
		}
		
		function fetch() {
			parent::fetch();
			$this->getType();
			$this->getMark();
			$this->getModel();
			$this->getCaliber();
			$this->getCity();
			$this->getUser();
			$this->getCurrency();
			$this->getImages();
		}
		
		function deleteImages($filter = false) {
			if (!$filter) {
				$filter = array('filter' => ' where pistol_id = :pistol_id', 'values' => array('pistol_id' => $this->id));
			}
			
			$this->db->delete('delete from pistol_images', $filter);
		}
		
		function count($filter = false) {
			$query = "select count(0) as cnt from pistols";
			
			$row = $this->db->fastSelect($query, $filter);
			return $row->cnt;
		}
		
		function insert($data) {
			//Слагаме ралната цена в левове
			if ($data['currency_id'] == 1) {
				$data['real_price'] = $data['price'];
			} else {
				$data['real_price'] = $data['price'] * COURSE_EUR;
			}
			
			return parent::insert($data);
		}
	}
