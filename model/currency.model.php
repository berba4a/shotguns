<?php
	
	class CurrencyModel extends BaseModel {
		function __construct($primary_key_value = false) {
			$this->table = 'currency';
			$this->columns = array ('id', 'currency');
			$this->required = array ('currency');
			parent::__construct($primary_key_value);
		}
	}
