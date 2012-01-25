<?php
	require_once 'pistol_model.model.php';
	
	class PistolCaliberModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var PistolModelModel
		 */
		public $model;
		
		function __construct($primary_key_value = false) {
			$this->table = 'pistol_calibers';
			$this->columns = array ('id', 'model_id', 'caliber');
			$this->required = array ('model_id', 'caliber');
			parent::__construct($primary_key_value);
		}
		
		function getModel() {
			$this->model = new PistolModelModel($this->model_id);
			$this->model->fetch();
		}
	}
