<?php
class Logger {
	static private $instance;
	
	private function __construct() {
		
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new Logger();
		}
		
		return self::$instance;
	}
	
	public function log($message, $type = 'default', $file = LOG_LOCATION) {
		if (LOGGING) {
			$logger = @fopen($file, 'a')  or die("Can not open destination file " . $file);
			if ((is_array($message)) || (is_object($message))) {
				$message = $this->getAsString($message);
			}
		    fwrite($logger, '[' . date('Y-m-d H:i:s') . '] [' . $type . ']' . $message . "\n");
		    fclose($logger);
		}
	}
	
	/**
	 * 
	 * Конвертира подадената променлива в string.
	 * @param mix $var
	 * @return string
	 */
	public function getAsString($var) {
		ob_start();
		print_r($var);
		$string = ob_get_contents();
		ob_end_clean();
		
		return $string;
	}
}