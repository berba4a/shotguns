<?php	
	class PistolImageModel extends BaseModel {
		function __construct($primary_key_value = false) {
			$this->table = 'pistol_images';
			$this->columns = array ('id', 'pistol_id', 'image');
			$this->required = array ('pistol_id', 'image');
			parent::__construct($primary_key_value);
		}
	}
