<?php
	require_once 'rifle_type.model.php';
	require_once 'rifle_mark.model.php';
	require_once 'rifle_model.model.php';
	require_once 'rifle_caliber.model.php';
	require_once 'rifle_image.model.php';
	require_once 'user.model.php';
	require_once 'currency.model.php';
	
	class RifleModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var RifleTypeModel
		 */
		public $type;
		/**
		 * 
		 * Enter description here ...
		 * @var RifleMarkModel
		 */
		public $mark;
		/**
		 * 
		 * Enter description here ...
		 * @var RifleModelModel
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
		 * @var RifleCaliberModel
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
		 * @var Array<RifleImage>
		 */
		public $images;
		
		function __construct($primary_key_value = false) {
			$this->table = 'rifles';
			$this->columns = array ('id', 'user_id', 'is_old', 'type_id', 'mark_id', 'model_id', 'caliber_id', 'city_id', 'price', 'real_price', 'currency_id', 'description', 'is_active_user', 'is_active_admin', 'created');
			$this->required = array ('user_id', 'type_id', 'mark_id', 'model_id', 'caliber_id', 'city_id', 'price', 'real_price', 'currency_id');
			parent::__construct($primary_key_value);
		}
		
		function getType() {
			$this->type = new RifleTypeModel($this->type_id);
			$this->type->fetch();
		}
		
		function getMark() {
			$this->mark = new RifleMarkModel($this->mark_id);
			$this->mark->fetch();
		}
		
		function getModel() {
			$this->model = new RifleModelModel($this->model_id);
			$this->model->fetch();
		}
		
		function getCaliber() {
			$this->caliber = new RifleCaliberModel($this->caliber_id);
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
			$tmp_image = new RifleImageModel();
			$this->images = $tmp_image->fetchAll(array('filter' => ' where rifle_id = :rifle_id', 'values' => array('rifle_id' => $this->id)));
			while (count($this->images) < 10) {
				$tmp_image = new stdClass();
				$tmp_image->image = 'templates/images/testLogo.jpg';
				$this->images[] = $tmp_image;
			}
		}
		
		function urAcativate($username, $password) {
			$query = "
				update rifles set is_active_user = 1 where user_id = (select id from users u where u.username = :username and u.password = :password limit 1);
			";
			
			return $this->db->execute($query, array('username' => $username, 'password' => $password), true, true);
		}
		
		function urFetch($username, $password) {
			$user = new UserModel();
			$user = $user->getByUserAndPass($username, $password);
			if (empty($user))
				return false;
			
			$rifles = $this->fetchAll(array('filter' => ' where user_id = :user_id', 'values' => array('user_id' => $user->id)));
			if (empty($rifles))
				return false;
			
			return $rifles[0];
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
				$filter = array('filter' => ' where rifle_id = :rifle_id', 'values' => array('rifle_id' => $this->id));
			}
			
			$this->db->delete('delete from rifle_images', $filter);
		}
		
		function count($filter = false) {
			$query = "select count(0) as cnt from rifles";
			
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
