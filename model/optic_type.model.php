<?php	
	class OpticTypeModel extends BaseModel {
		function __construct($primary_key_value = false) {
			$this->table = 'optic_types';
			$this->columns = array ('id', 'type');
			$this->required = array ('type');
			parent::__construct($primary_key_value);
		}
	}
