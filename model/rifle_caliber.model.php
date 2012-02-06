<?php
	require_once 'rifle_model.model.php';
	
	class RifleCaliberModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var RifleModelModel
		 */
		public $model;
		
		function __construct($primary_key_value = false) {
			$this->table = 'rifle_calibers';
			$this->columns = array ('id', 'model_id', 'caliber');
			$this->required = array ('model_id', 'caliber');
			parent::__construct($primary_key_value);
		}
		
		function getModel() {
			$this->model = new RifleModelModel($this->model_id);
			$this->model->fetch();
		}
	}
