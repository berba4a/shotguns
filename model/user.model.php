<?php
	class UserModel extends BaseModel {
		
		/**
		 * 
		 * Enter description here ...
		 * @var CityModel
		 */
		public $city;
		
		function __construct($primary_key_value = false) {
			$this->table = 'users';
			$this->columns = array ('id', 'real_name', 'phone', 'email', 'city_id', 'website', 'username', 'password', 'is_real_email', 'is_active', 'is_dealer');
			$this->required = array('real_name', 'phone', 'email', 'city_id');
			parent::__construct($primary_key_value);
		}
		
		function getCity() {
			$this->city = new CityModel($this->city_id);
			$this->city->fetch();
		}
		
		function getByUserAndPass($username, $password) {
			$users = $this->fetchAll(array('filter' => ' where username = :username and password = :password', 'values' => array('username' => $username, 'password' => $password)));
			if (empty($users)) {
				return false;
			} else {
				return $users[0];
			}
		}
	}