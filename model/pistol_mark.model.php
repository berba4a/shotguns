<?php
	require_once 'pistol_type.model.php';
	
	class PistolMarkModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var PistolTypeModel
		 */
		public $type;
		
		function __construct($primary_key_value = false) {
			$this->table = 'pistol_marks';
			$this->columns = array ('id', 'type_id', 'mark');
			$this->required = array ('type');
			parent::__construct($primary_key_value);
		}
		
		function getType() {
			$this->type = new PistolTypeModel($this->package_id);
			$this->type->fetch();
		}
	}
