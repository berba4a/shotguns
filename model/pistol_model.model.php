<?php
	require_once 'pistol_mark.model.php';
	
	class PistolModelModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var PistolMarkModel
		 */
		public $mark;
		
		function __construct($primary_key_value = false) {
			$this->table = 'pistol_models';
			$this->columns = array ('id', 'mark_id', 'model');
			$this->required = array ('mark_id', 'model');
			parent::__construct($primary_key_value);
		}
		
		function getModel() {
			$this->mark = new PistolTypeModel($this->mark_id);
			$this->mark->fetch();
		}
	}
