<?

class DBMSSQL {
	/**
	 * Store the connection to the DB.
	 */
	private $conn;
	/**
	 * Hostname of the DB
	 *
	 * @var string
	 */
	private $hostname;
	/**
	 * User to connect
	 *
	 * @var string
	 */
	private $username;
	/**
	 * Passwor for user
	 *
	 * @var string
	 */
	private $password;
	/**
	 * Database to use 
	 *
	 * @var string
	 */
	private $dbname;
	/**
	 * Type of DB
	 *
	 * @var int
	 */
	public $type;
	static private $instance;
	
	/**
	 * Open SQL server connection.
	 * 
	 * @param string $hostname	 
	 * @param string $username
	 * @param string $password
	 * @param string $dbname
	 */
	private function __construct($hostname, $username, $password, $dbname) {		
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
		
		
		if (!$this->conn = mssql_connect($hostname, $username, $password, true)) {
			//TODO: error page
			echo "No connection"; exit();
			//throw new NewException("Unable to connect to MSSQL server!!!", iException::EX_SQL_CONNECTION_FAILED);
		}
		if (!mssql_select_db($dbname, $this->conn)) {
			//TODO: error page
			echo "No db"; exit();
			//throw new NewException("Unable to select database!!!", iException::EX_SQL_CONNECTION_FAILED);
		}
		$this->query('begin transaction'); // If we want to rollback or commit we have to start transaction, because MSSQL automaticaly commit after each query
		
	}
	
	public static function getInstance($hostname = SERVER, $username = USER, $password = PASS, $dbname = SCHEMA) {
			if (!isset(self::$instance)) {
//				self::$instance = new PDOdb($dsn, $username, $password, $driver_options);
				self::$instance = new DBMSSQL($hostname, $username, $password, $dbname);
			}
		
			return self::$instance;
		}
	
	/**
	 * Close SQL Server connection.
	 */
	function __destruct() {
		if ($this->conn) {
			//$this->rollback();
			mssql_close($this->conn);
		}
	}
	
	/**
	 * Send SQL query.
	 * 
	 * @param string $query	
	 * @param boolean $start
	 * @param boolean $end
	 * 
	 * @return resource
	 */
	function query($query) {
		Logger::getInstance()->log($query);
		if (!$stmt = mssql_query($query, $this->conn)) {
			$error_msg = $this->error($stmt);
			$this->rollback();
			//TODO error page
			Logger::getInstance()->log("ERROR EXECUTING QUERY [" . $query . "]: " . $error_msg);
			echo "sql error"; exit();
			//throw new NewException("ERROR EXECUTING QUERY [" . $query . "]: " . $error_msg, iException::EX_SQL_PARSE_ERROR);
		}
		
		return $stmt;
		
	}
	
	function fetchAll($query, $asObject = true) {
		$stmt = $this->query($query);
		$result = array();
		if ($asObject) {
			while ($row = $this->fetchObject($stmt)) {
				$result[] = $row;
			}
		} else {
			while ($row = $this->fetchArray($stmt)) {
				$result[] = $row;
			}
		}
		
		return $result;
	}
	
	/**
	 * Fetch row as object.
	 * 
	 * @param resource $stmt
	 * 
	 * @return object 
	 */
	function fetchObject($stmt) {
		return mssql_fetch_object($stmt);		
	}
	
	/**
	 * Fetch a result row as an array.
	 * 
	 * @param resource $stmt
	 * 
	 * @return array 
	 */
	function fetchArray($stmt) {
		if ($row = mssql_fetch_array($stmt)) {
			$odd = 0;
			foreach ($row as $key=>$value) {
				if ($odd) {
					$returned_row[$key] = $value;					
				}
				$odd = 1 - $odd;
			}			
			return $returned_row;
		} else {
			return false;
		}
	}
	
	/**
	 * Commit transactions.
	 * 	 
	 * @return boolean
	 */
	function commit() {
		if ($this->query('commit')) {
			$this->query('begin transaction'); // Transaction is closed after commit or rollback so we open it again
			return true;
		} else {
			return false;
		}		
	}
	
	/**
	 * Rollback transactions.
	 * 	 
	 * @return boolean
	 */
	function rollback() {
		if ($this->query('rollback')) {
			$this->query('begin transaction'); // Transaction is closed after commit or rollback so we open it again
			return true;
		} else {
			return false;
		}		
	}
	
	/**
	 * Returns the number of records affected by the query.
	 * 	 
	 * @return int
	 */
	function numRows() {
		return mssql_rows_affected($this->conn);
	}
	
	/**
	 * Returns the last message from the server.
	 * 
	 * @param resource $stmt
	 * 
	 * @return string
	 */
	function error($stmt) {
		return mssql_get_last_message();
	}
	
	/**
	 * Invoked upon deserialization to restore the connection.
	 *
	 */
	function __wakeup() {
		if (!$this->conn = mssql_connect($this->hostname, $this->username, $this->password, true)) {
			//throw new NewException("Unable to connect to MSSQL server!!!", iException::EX_SQL_CONNECTION_FAILED);
		}
		if (!mssql_select_db($this->dbname, $this->conn)) {			
			//throw new NewException("Unable to select database!!!", iException::EX_SQL_CONNECTION_FAILED);
		}
		$this->query('begin transaction'); // Connect to the DB afain and start new transaction. SEE __construct();
	}	

	/**
	 * Makes a fast query assumed it must return a signe row as an object
	 * 
	 * @return object
	 */
	function fquery($query) {
		$stmt = $this->query($query);
		return $this->fetchObject($stmt);
	}
	/**
	 * Get last inserted id
	 * 
	 * ����� �������� ���������� ID ���� �������� SCOPE_IDENTITY().
	 * ���� ������� ���� �� ����� ���� ��� �� �������� ����������. 
	 *
	 * @return int
	 */
	function getLastInsertedId() {
		$query = "SELECT SCOPE_IDENTITY() AS ID";
		$row = $this->fquery($query);
		return $row->ID;
	}
	
	/**
	 * ����� ���� �� ����������� ������ �� ������������
	 * �� INSERT, DELETE � ����� �������.
	 * 
	 * @return int
	 */
	function getAffectedRows() {
		return mssql_rows_affected($this->conn);
	}
	
}
?>