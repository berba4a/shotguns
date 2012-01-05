<?php
	require_once 'pistol_type.model.php';
	require_once 'pistol_mark.model.php';
	
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
		 * @var CityModel
		 */
		public $city;
		
		function __construct($primary_key_value = false) {
			$this->table = 'pistols';
			$this->columns = array ('id', 'user_id', 'is_old', 'type_id', 'mark_id', 'caliber', 'city_id', 'price', 'description', 'is_active_user', 'is_active_admin');
			$this->required = array ('user_id', 'is_old', 'type_id', 'mark_id', 'caliber', 'city_id', 'price');
			parent::__construct($primary_key_value);
		}
		
		function getType() {
			$this->type = new PistolTypeModel($this->package_id);
			$this->type->fetch();
		}
		
		function getOption() {
			$this->mark = new PistolMarkModel($this->option_id);
			$this->mark->fetch();
		}
		
		function getCity() {
			$this->city = new CityModel($this->city_id);
			$this->city->fetch();
		}
	}
