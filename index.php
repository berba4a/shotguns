<?php	
	//Стартиране на сесията
	if (!session_id()) {
		session_start();
	}
	/*** include the init.php file ***/
	//require_once 'configs/init.php';
	
	require_once realpath(dirname(__FILE__)) . '/configs/config.php';
	
	require_once HTDOCS . '/classes/logger.class.php';
	
	/*** include the controller class ***/
	require_once HTDOCS . '/application/' . 'controller_base.class.php';
	
	/*** include the model class ***/
	require_once HTDOCS . '/application/' . 'model.class.php';

	/*** include the registry class ***/
	require_once HTDOCS . '/application/' . 'registry.class.php';
	
	/*** include the router class ***/
	require_once HTDOCS . '/application/' . 'router.class.php';
	
	/*** include the template class ***/
//	require_once HTDOCS . '/application/' . 'template.class.php';
	require_once HTDOCS . '/libs/' . 'Smarty.class.php';
	
	/*** include the database class ***/
	require_once HTDOCS . '/classes/db/' . 'pdo.class.php';
	require_once HTDOCS . '/classes/db/' . 'mssql.class.php';
	
	require_once HTDOCS . '/model/user.model.php';
	
	/**
	 * 
	 * Автоматично зарежда нужните класове
	 * @param $class_name
	 */
	function __autoload($class_name) {
		$filename = strtolower($class_name) . '.class.php';
		$file = HTDOCS . '/model/' . $filename;
		
		if (file_exists($file) == false) {
			return false;
		}
		
		require_once ($file);
	}

 	//Създава регистъра
 	/**
 	 * 
 	 * Обект за регистъра
 	 * @var Registry
 	 */
 	$registry = new Registry();
 	
 	$registry->logger = Logger::getInstance();

	/*** create the database registry object ***/
	$registry->db = PDOdb::getInstance();
	$registry->db->connect(DSN, USER, PASS);
	$registry->db->execute("set names utf8");
//	$registry->db = DBMSSQL::getInstance();
	
	/*** load the router ***/
	$registry->router = new router($registry);
	
	/*** set the controller path ***/
	$registry->router->setPath (HTDOCS . '/controller');
	
	/*** load up the template ***/
//	$registry->template = new template($registry);
	$registry->smarty = new Smarty();
 	
 	//Проверка за логнат потребител -- не е необходимо за други проекти
//  	if (empty($_SESSION['user_id'])) {
//  		if ($_SERVER["REQUEST_URI"] != WWW) {
//  			header('location: ' . DOMAIN . WWW);
//  		}
//  	} else {
//  		$user = new UserModel($_SESSION['user_id']);
//  		$user->fetch();
//  		$registry->user = $user;
//  		$registry->smarty->assign('user', $user);
//  	}
	
	/*** load the controller ***/
	$registry->router->execute();