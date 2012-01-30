<?php
	require_once 'optic_type.model.php';
	
	class OpticMarkModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var OpticTypeModel
		 */
		public $type;
		
		function __construct($primary_key_value = false) {
			$this->table = 'optic_marks';
			$this->columns = array ('id', 'type_id', 'mark');
			$this->required = array ('type_id', 'mark');
			parent::__construct($primary_key_value);
		}
		
		function getType() {
			$this->type = new OpticTypeModel($this->type_id);
			$this->type->fetch();
		}
	}
