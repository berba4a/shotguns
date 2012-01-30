<?php	
	class OpticImageModel extends BaseModel {
		function __construct($primary_key_value = false) {
			$this->table = 'optic_images';
			$this->columns = array ('id', 'optic_id', 'image');
			$this->required = array ('optic_id', 'image');
			parent::__construct($primary_key_value);
		}
	}
