<?php	
	class CityModel extends BaseModel {
		function __construct($primary_key_value = false) {
			$this->table = 'cities';
			$this->columns = array ('id', 'city');
			$this->required = array ('city');
			parent::__construct($primary_key_value);
		}
	}
