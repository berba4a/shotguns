<?php
	require_once 'optic_mark.model.php';
	
	class OpticModelModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var OpticMarkModel
		 */
		public $mark;
		
		function __construct($primary_key_value = false) {
			$this->table = 'optic_models';
			$this->columns = array ('id', 'mark_id', 'model');
			$this->required = array ('mark_id', 'model');
			parent::__construct($primary_key_value);
		}
		
		function getModel() {
			$this->mark = new OpticTypeModel($this->mark_id);
			$this->mark->fetch();
		}
	}
