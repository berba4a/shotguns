<?php	
	class RifleImageModel extends BaseModel {
		function __construct($primary_key_value = false) {
			$this->table = 'rifle_images';
			$this->columns = array ('id', 'rifle_id', 'image');
			$this->required = array ('rifle_id', 'image');
			parent::__construct($primary_key_value);
		}
	}
