<?php

class Template {

	/**
	 * 
	 * Registry обектът, който съхранява всички променливи
	 * нужни да бъдат достъпвани
	 * @var Registry
	 */
	private $registry;

	/**
	 * 
	 * Съдържа всички променливи нужни за генерирането на темплейта
	 * @var array
	 */
	private $vars = array();


	/**
	 * 
	 * Създава обект от типа Template
	 * @param Registry $registry
	 */
	function __construct($registry) {
		$this->registry = $registry;
	}


	/**
	 * 
	 * Добавя променлива която трябва да е достъпна
	 * за темплейта
	 * @param string $index
	 * @param mixed $value
	 */
	public function __set($index, $value) {
		$this->vars[$index] = $value;
	}


	/**
	 * 
	 * Показва избрания темплейт
	 * @param string $name
	 * @throws Exception
	 */
	function show($name) {
		$path = HTDOCS . '/views' . '/' . $name . '.php';
		
		if (file_exists($path) == false) {
			throw new Exception('Template not found in '. $path);
			return false;
		}
		
		// Load variables
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}
		
		require ($path);               
	}
}