<?php
	require_once 'rifle_mark.model.php';
	
	class RifleModelModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var RifleMarkModel
		 */
		public $mark;
		
		function __construct($primary_key_value = false) {
			$this->table = 'rifle_models';
			$this->columns = array ('id', 'mark_id', 'model');
			$this->required = array ('mark_id', 'model');
			parent::__construct($primary_key_value);
		}
		
		function getModel() {
			$this->mark = new RifleTypeModel($this->mark_id);
			$this->mark->fetch();
		}
	}
