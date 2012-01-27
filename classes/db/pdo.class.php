<?
	class PDOdb {
		const STATUS_CONNECTED = 1;
		const STATUS_DISCONNECTED = 0;
		
		static private $instance;
		private $db = array();
		private $current = false;
		private $prepare = array();
		private $rouCount = false;
		/**
		 * 
		 * 
		 * @var Logger
		 */
		private $logger;

		private function __construct() {
			$this->logger = Logger::getInstance();
		}

		public static function getInstance() {
			if (!isset(self::$instance)) {
				self::$instance = new PDOdb();
			}
		
			return self::$instance;
		}

		public function connect($dsn, $username = false, $password = false, $driver_options = array()) {
			$md5 = false;
			try {
				$md5 = $dsn . '|' . ($username?$username:'') . '|' . ($password?$password:'') . '|' . ($driver_options?$driver_options:'');
				$md5 = md5($md5);
				
				if ((!isset($this->db[$md5]['status'])) || ($this->db[$md5]['status'] == false/*$this->STATUS_DISCONNECTED*/)) {
					$this->db[$md5]['db'] = new PDO($dsn, $username, $password, $driver_options);
					$this->db[$md5]['status'] = true; //$this->STATUS_CONNECTED;
					$this->current = $md5;
					$this->beginTransaction();
				}
			} catch  (PDOException $e) {
				$md5 = false;
				$this->db[$md5]['status'] = false; //$this->STATUS_DISCONNECTED;
				die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
			}
			
			return $md5;
		}

		public function connection($md5) {
			$this->current = $md5;
		}

		public function disconnect() {
			if ($this->db[$this->current]['status'] == true/*$this->STATUS_CONNECTED*/) {
				$this->db[$this->current]['db'] = null;
				$this->db[$this->current]['status'] = true;/*$this->STATUS_DISCONNECTED*/;
			}

			return $this->db[$this->current]['status'];
		}

		public function __destruct() {
			foreach($this->db as $md5 => $db) {
				$this->connection($md5);
				$this->disconnect();
			}
		}

		public function beginTransaction() {
			$this->db[$this->current]['db']->beginTransaction();
		}

		public function commit($begin_transaction = true) {
			$this->db[$this->current]['db']->commit();
			if ($begin_transaction)
				$this->beginTransaction();
		}
		
		public function rollBack($begin_transaction = true) {
			$this->db[$this->current]['db']->rollBack();
			if ($begin_transaction)
				$this->beginTransaction();
		}
		
		public function execute($query, $bind = array(), $fetch_class = true, $is_cuid = false) {
			$md5 = md5($query);
			if (!isset($this->prepare[$this->current][$md5])) {
				$md5 = 1;
				$this->prepare[$this->current][$md5] = $this->db[$this->current]['db']->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			}
			
		 	if (!$this->prepare[$this->current][$md5]->execute($bind)) {
				Logger::getInstance()->log($bind, "QUERY ERROR");
				ob_start();
				$this->prepare[$this->current][$md5]->debugDumpParams();
				$string = ob_get_contents();
				ob_end_clean();
				Logger::getInstance()->log($string, "QUERY ERROR");
				Logger::getInstance()->log($this->db[$this->current]['db']->errorInfo(), "QUERY ERROR");
				Logger::getInstance()->log($this->prepare[$this->current][$md5]->errorInfo(), "QUERY ERROR");
				Logger::getInstance()->log($this->createQuery($query, $bind), "QUERY ERROR");
				throw new Exception("Query execution error!!!");
			}
			   
			$this->rouCount = $this->prepare[$this->current][$md5]->rowCount();
			   
			if (LOGGING) {
				Logger::getInstance()->log($bind, "QUERY DATA");
				ob_start();
				$this->prepare[$this->current][$md5]->debugDumpParams();
				$string = ob_get_contents();
				ob_end_clean();
				Logger::getInstance()->log($string, "QUERY DUMP");
				Logger::getInstance()->log($this->prepare[$this->current][$md5]->errorInfo(), "QUERY RESULT");
			}
			
			if (!$is_cuid) {
				if ($fetch_class) {
					if ($fetch_class === true) {
						return $this->prepare[$this->current][$md5]->fetchAll(PDO::FETCH_CLASS, "stdClass");
					}
				} else {
					return $this->prepare[$this->current][$md5]->fetchAll();
				}
			} else {
				return $this->rouCount;
			}
		}
		
		public function fExecute($query, $bind = array(), $fetch_class = true) {
			$rows = $this->execute($query, $bind, $fetch_class);
			if (!empty($rows)) {
				return $rows[0];
			} else {
				return false;
			}
		}
		
		/**
		 * Връща масив от обекти с намерените резултати.
		 * 
		 * Ако се използва страницирането, задължително трябва да има колона с ID-то на резултатите,
		 * като колоната трябва да е описана по следния начин 
		 * columns_primary_key as ID
		 * 
		 * @example select
                                        [user].id as ID,
                                        [user].role_id as ROLE_ID,
                                        [user].username as USERNAME,
                                        [user].password as PASSWORD,
                                        [user].real_name as REAL_NAME,
                                        [user].is_active as IS_ACTIVE,
                                        [role].name as ROLE
                                        from [user]
                                        inner join [role] on [role].id = [user].role_id
		 * 
		 * @param array $filter
		 * @example $filter = array("filter" => "where column > ? and column < ?", "values" => array(1, 10));
		 */
		public function select($query, $filter = false, $rows = false, $page = false, $fetch_class = true) {
			$bind = array();
			if ($filter) {
				$query .= " " .  $filter['filter'];
				$bind = isset($filter['values'])?$filter['values']:array();
			}
			
			if (($rows !== false) && ($page !== false)) {
				//Вземаме ID-то в/у което ще се генерира row_number
				preg_match('/ ([^ ]*) as ID[ ,]?/is', $query, $match);
				
				//Добавяме колоната за row_number
				$query = str_ireplace('select' , 'select Row_Number() over (order by ' . $match[1] . ') as RowIndex, ', $query);
				
				$query = 'select * from (' . $query . ') as Sub Where Sub.RowIndex >= ? and Sub.RowIndex < ?'; 
				$bind[] = $rows*($page-1) + 1;
				$bind[] = $rows*$page +1;
			}
			
			return $this->execute($query, $bind);
		}
		
		/**
		 * 
		 * 
		 * @param array $filter
		 * @example $filter = array("filter" => "where column > ? and column < ?", "values" => array(1, 10));
		 */
		public function fastSelect($query, $filter = false, $fetch_class = true) {
			$bind = array();
			if ($filter) {
				$query .= " " .  $filter['filter'];
				$bind = isset($filter['values'])?$filter['values']:array();
			}
			if ($rows = $this->execute($query, $bind)) {
				return $rows[0];
			} else {
				return false;
			}
		}
		
		public function insert($query, $bind = array()) {
			$rows = $this->execute($query, $bind, true, true);
			
			return $this->lastInsertId();
		}
		
		public function update($query, $bind = array(), $filter = false) {
			if ($filter) {
				$query .= " " . $filter['filter'];
				$bind = array_merge($bind, $bind = (isset($filter['values'])?$filter['values']:array()));
			}
			return $this->execute($query, $bind, true, true);
		}
		
		public function delete($query, $filter = false) {
			$bind = array();
			if ($filter) {
				$query .= " " . $filter['filter'];
				$bind = array_merge($bind, $bind = (isset($filter['values'])?$filter['values']:array()));
			}
			return $this->execute($query, $bind, true, true);
		}
		
		public function rowCount() {
			return $this->rouCount;
		}
		
		public function lastInsertId() {
//			$this->logger->log($this->db[$this->current]['db']->lastInsertId());
			return $this->db[$this->current]['db']->lastInsertId();
		}
		
		public function createQuery($query, $data, $filter = false) {
			
			if ($filter) {
				$query .= " " . $filter['filter'];
				$data = array_merge($data, $data = (isset($filter['values'])?$filter['values']:array()));
			}
		
			$tmp_query = $query;
			foreach ($data as $key=>$value) {
				$tmp = $tmp_query;
				$tmp_query = str_replace(':' . $key . ',', "'" . $value . "',", $tmp_query);
				$tmp_query = str_replace(':' . $key . ')', "'" . $value . "')", $tmp_query);
				if ($tmp_query == $tmp) {
					Logger::getInstance()->log('Extra key: ' . $key, 'P QUERY');
				}
			}
			Logger::getInstance()->log($tmp_query, 'P QUERY');
		}
  }