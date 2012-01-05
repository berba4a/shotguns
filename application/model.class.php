<?php
	class BaseModel {
		/**
		 * 
		 * Enter description here ...
		 * @var PDOdb
		 */
		protected $db;
		protected $table;
		protected $columns = array();
		protected $required = array();
		protected $primary_key = 'id';
		protected $is_fetched = false;
		
		function __construct($primary_key_value = false) {
			$this->db = PDOdb::getInstance();

			if ($primary_key_value) {
				$this->setPrimaryValue($primary_key_value);
			}
		}

		function setPrimaryValue($primary_key_value) {
			$primary_key = $this->primary_key;
			$this->$primary_key = $primary_key_value;
			$this->is_fetched = false;
		}

		function generateSQL($columns = array('*')) {
			$sql = 'select ';
			foreach($columns as $column) {
				$sql .= $column . ', ';
			}
			$sql = trim($sql, ', ');
			$sql .= ' from ' . $this->table;

			return $sql;
		}

		function fetch() {
			if ($this->is_fetched) {
				return false;
			}

			$primary_key = $this->primary_key;
			$filter = array('filter' => ' where id = :id', 'values' => array('id' => $this->$primary_key));

			$row = $this->db->fastSelect($this->generateSQL($this->columns), $filter);

			foreach ($row as $column=>$value) {
				$this->$column = $value;
			}

			$this->is_fetched = true;

			return true;
		}

		function fetchAll($filter = false) {
			$class = get_class($this);
			$return = array();
			$rows = $this->db->select($this->generateSQL(array($this->primary_key)), $filter);
			$primary_key = $this->primary_key;

			foreach($rows as $row)  {
				$tmp_object = new $class($row->$primary_key);
				$tmp_object->fetch();
				$return[] = $tmp_object;
			}

			return $return;
		}

		function getPrimaryKeyValue() {
			$primary_key = $this->primary_key;
			if (empty($this->$primary_key)) {
				return false;
			} else {
				return $this->$primary_key;
			}
		}

		function insert($data) {
			$missing = array();
			//Проверка за задължителните полета
			foreach ($this->required as $column) {
				if (empty($data[$column])) {
					$missing[$column] = $column;
				}
			}
			
			//Ако има грешка за задължителни полета връщаме кои са те
			if (!empty($missing)) {
				return $missing;
			}
			
			//Взимаме само нужните данни за запис и сглобяваме заявката
			$cols = '';
			$vals = '';
			$insert_data = array();
			foreach($this->columns as $column) {
				if (!empty($data[$column])) {
					$insert_data[$column] = $data[$column];
					$cols .= $column . ', ';
					$vals .= ':' . $column . ', ';
				}
			}
			$cols = trim($cols, ', ');
			$vals = trim($vals, ', ');
			$sql = 'insert into ' . $this->table . ' (' . $cols . ' ) values (' . $vals . ')';

			$id = $this->db->insert($sql, $insert_data);
			if ($id) {
				$this->setPrimaryValue($id);
				$this->fetch();
			} else {
				//TODO: throw error
				echo "Save error!!!";
			}

			return $id;
		}
		
		function update($date) {
			$sql = 'update ' . $this->table . ' set ';
			$values = array();
			foreach ($date as $key=>$value) {
				$sql .= $key . ' = :' . $key . ', ';
				$values[$key] = $value;
			}
			
			$sql = trim($sql, ', ');
			$primary_key = $this->primary_key;
			
			return $this->db->update($sql, $values, array('filter' => ' where ' . $this->primary_key . ' = :id', 'values' => array('id' => $this->$primary_key)));
		}
		
		function setRequiredFields($required) {
			$this->required = $required;
			
			return true;
		}
		
		function getRequiredFields() {
			return $this->required;
		}
	}