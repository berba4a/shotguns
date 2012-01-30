<?php
	require_once 'optic_model.model.php';
	
	class OpticSizeModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var OpticModelModel
		 */
		public $model;
		
		function __construct($primary_key_value = false) {
			$this->table = 'optic_sizes';
			$this->columns = array ('id', 'model_id', 'size');
			$this->required = array ('model_id', 'size');
			parent::__construct($primary_key_value);
		}
		
		function getModel() {
			$this->model = new OpticModelModel($this->model_id);
			$this->model->fetch();
		}
	}
