<?php

class Router {
	/**
	 * 
	 * Registry обектът, който съхранява всички променливи
	 * нужни да бъдат достъпвани
	 * @var Registry
	 */
	private $registry;

	/**
	 * 
	 * Съдържа пътя до контролера
	 * @var string
	 */
	 private $path;
	 
	/**
	 * 
	 * Аргументите, който ще се подават на извиквания метод
	 * @var array
	 */
	private $args = array();

	/**
	 * 
	 * Пътят и файлът, в който се намира контролера
	 * @var string
	 */
	public $file;
	
	/**
	 * 
	 * Съдържа името на контролера, който ще се извиква
	 * @var string
	 */
	public $controller;
	
	/**
	 * 
	 * Действието, кото ще се изпълнява.
	 * По подразбиране това е index
	 * @var string
	 */
	public $action;

	/**
	 * 
	 * Създава обект от типа Router
	 * @param Registry $registry
	 */
	function __construct($registry) {
		$this->registry = $registry;
	}
 
	 /**
	  * 
	  * Задава пътя до контролерите
	  * @param string $path
	  * @throws Exception
	  */
	function setPath($path) {
		//Проверка дали е директория
		if (is_dir($path) == false) {
			throw new Exception ('Invalid controller path: `' . $path . '`');
		}
		$this->path = $path;
	}

	/**
	 * 
	 * Изпълнява избраното действие на избрания контролер
	 */
	public function execute() {
		$this->getController();
		
		//Проверка дали контролера съществува
		if (is_readable($this->file) == false) {
			echo "File not readable: " . $this->file . "<br>\n";
			$this->file = $this->path.'/error404.php';
			$this->controller = 'error404';
		}
		
		//Зареждане на контролера
		require_once ($this->file);
		
		//Създаване на обект за контролера
		$class = ucfirst(strtolower($this->controller)) . 'Controller';
		$controller = new $class($this->registry);
		
		//Проверка дали действието може да се изпълни
		if (is_callable(array($controller, $this->action)) == false) {
			//Ако действеито не може да се изпълни се изпълнява подразбиращото се дейсврие
			$action = 'index';
		} else {
			$action = $this->action;
		}
		
		//Изпълнение на дествието
		$controller->$action();
	}

	/**
	 * 
	 * Генерира пътя и файла в който се намира контролера,
	 * т.е. задава $this->file
	 */
	private function getController() {
		//Взема рутинга от линка
		$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
		
		if (empty($route)) {
			$route = 'index';
		} else {
			//Разделя рутера на компоненти, за да генерира контролера и действието
			$parts = explode('/', $route);
			$this->controller = strtolower($parts[0]);
			if(isset($parts[1])) {
				$this->action = strtolower($parts[1]);
			}
		}
		
		if (empty($this->controller)) {
			$this->controller = 'shotgun';
		}
		
		if (empty($this->action)) {
			$this->action = 'index';
		}
		
		//Не е нужно
		$this->registry->smarty->assign('controller', $this->controller);
		$this->registry->smarty->assign('action', $this->action);
		
		$this->file = $this->path .'/'. $this->controller . '.controller.php';
	}
}