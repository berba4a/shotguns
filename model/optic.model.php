<?php
	require_once 'optic_type.model.php';
	require_once 'optic_mark.model.php';
	require_once 'optic_model.model.php';
	require_once 'optic_size.model.php';
	require_once 'optic_image.model.php';
	require_once 'user.model.php';
	require_once 'currency.model.php';
	
	class OpticModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var OpticTypeModel
		 */
		public $type;
		/**
		 * 
		 * Enter description here ...
		 * @var OpticMarkModel
		 */
		public $mark;
		/**
		 * 
		 * Enter description here ...
		 * @var OpticModelModel
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
		 * @var OpticSizeModel
		 */
		public $size;
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
		 * @var Array<OpticImage>
		 */
		public $images;
		
		function __construct($primary_key_value = false) {
			$this->table = 'optics';
			$this->columns = array ('id', 'user_id', 'is_old', 'type_id', 'mark_id', 'model_id', 'size_id', 'city_id', 'price', 'real_price', 'currency_id', 'description', 'is_active_user', 'is_active_admin', 'created');
			$this->required = array ('user_id', 'type_id', 'mark_id', 'model_id', 'size_id', 'city_id', 'price', 'real_price', 'currency_id');
			parent::__construct($primary_key_value);
		}
		
		function getType() {
			$this->type = new OpticTypeModel($this->type_id);
			$this->type->fetch();
		}
		
		function getMark() {
			$this->mark = new OpticMarkModel($this->mark_id);
			$this->mark->fetch();
		}
		
		function getModel() {
			$this->model = new OpticModelModel($this->model_id);
			$this->model->fetch();
		}
		
		function getSize() {
			$this->size = new OpticSizeModel($this->size_id);
			$this->size->fetch();
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
			$tmp_image = new OpticImageModel();
			$this->images = $tmp_image->fetchAll(array('filter' => ' where optic_id = :optic_id', 'values' => array('optic_id' => $this->id)));
			while (count($this->images) < 10) {
				$tmp_image = new stdClass();
				$tmp_image->image = 'templates/images/testLogo.jpg';
				$this->images[] = $tmp_image;
			}
		}
		
		function urAcativate($username, $password) {
			$query = "
				update optics set is_active_user = 1 where user_id = (select id from users u where u.username = :username and u.password = :password limit 1);
			";
			
			return $this->db->execute($query, array('username' => $username, 'password' => $password), true, true);
		}
		
		function urFetch($username, $password) {
			$user = new UserModel();
			$user = $user->getByUserAndPass($username, $password);
			if (empty($user))
				return false;
			
			$optics = $this->fetchAll(array('filter' => ' where user_id = :user_id', 'values' => array('user_id' => $user->id)));
			if (empty($optics))
				return false;
			
			return $optics[0];
		}
		
		function fetch() {
			parent::fetch();
			$this->getType();
			$this->getMark();
			$this->getModel();
			$this->getSize();
			$this->getCity();
			$this->getUser();
			$this->getCurrency();
			$this->getImages();
		}
		
		function deleteImages($filter = false) {
			if (!$filter) {
				$filter = array('filter' => ' where optic_id = :optic_id', 'values' => array('optic_id' => $this->id));
			}
			
			$this->db->delete('delete from optic_images', $filter);
		}
		
		function count($filter = false) {
			$query = "select count(0) as cnt from optics";
			
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
