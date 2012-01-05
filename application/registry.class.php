<?php
/**
 * 
 * Клас Registry
 * 
 * Отговорен е за съхраненитео на всички променливи,
 * които трябва да са достъпни в цялата система
 * @author botzko
 *
 */
class Registry {
	/**
	 * 
	 * Съдържа всички регистрирани променливи
	 * @var array
	 */
	private $vars = array();
	/**
	 * 
	 * Съдържа обект за темплейта
	 * @var Smarty
	 */
	public $smarty;
	/**
	 * 
	 * Връзка с базата данни
	 * @var PDOdb
	 */
	public $db;
	/**
	 * 
	 * 
	 * @var Logger
	 */
	public $logger;

	/**
	 * 
	 * Добавя променлива която трябва да е достъпна
	 * за цялата система
	 * @param string $index
	 * @param mixed $value
	 */
	public function __set($index, $value) {
		$this->vars[$index] = $value;
	}
	
	/**
	 * 
	 * Връща стойността на дадена променлива
	 * @param string $index
	 */
	public function __get($index) {
		return $this->vars[$index];
	}
	
	function __construct() {
	}
}