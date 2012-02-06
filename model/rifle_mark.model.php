<?php
	require_once 'rifle_type.model.php';
	
	class RifleMarkModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var RifleTypeModel
		 */
		public $type;
		
		function __construct($primary_key_value = false) {
			$this->table = 'rifle_marks';
			$this->columns = array ('id', 'type_id', 'mark');
			$this->required = array ('type_id', 'mark');
			parent::__construct($primary_key_value);
		}
		
		function getType() {
			$this->type = new RifleTypeModel($this->type_id);
			$this->type->fetch();
		}
	}
