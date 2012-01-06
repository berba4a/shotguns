<?php
	require_once 'pistol_type.model.php';
	
	class PistolCaliberModel extends BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var PistolTypeModel
		 */
		public $type;
		
		function __construct($primary_key_value = false) {
			$this->table = 'pistol_calibers';
			$this->columns = array ('id', 'mark_id', 'caliber');
			$this->required = array ('mark_id', 'caliber');
			parent::__construct($primary_key_value);
		}
	}
