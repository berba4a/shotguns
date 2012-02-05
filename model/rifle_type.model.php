<?php	
	class RifleTypeModel extends BaseModel {
		function __construct($primary_key_value = false) {
			$this->table = 'rifle_types';
			$this->columns = array ('id', 'type');
			$this->required = array ('type');
			parent::__construct($primary_key_value);
		}
	}
