<?php
	function createFilter($values, $keys = array()) {
		$filter = ' where 1 = 1 ';
		$filter_vals = array();
		if (empty($keys)) {
			foreach($values as $key=>$value) {
				$filter_vals[$key] = $value;
				$filter .= ' and ' . $key . ' = :' . $key;
			}
		} else {
			foreach($keys as $key) {
				if (!empty($values[$key])) {
					$filter_vals[$key] = $values[$key];
					$filter .= ' and ' . $key . ' = :' . $key;
				}
			}
		}
		
		return array('filter' => $filter, 'values' => $filter_vals);
	}