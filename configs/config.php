<?php
	define('DEBUG', true);
	
	//Домейна на системата
	define('DOMAIN', 'http://localhost');
	
	//Къде се намира началната страница
	define('WWW', '/shotguns/');

	define('DSN', 'mysql:dbname=shotguns;host=localhost');
	define('USER', 'root');
	define('PASS', '');

	//Главния път на системата
	$site_path = realpath(dirname(__FILE__)) . '/..';
	define('HTDOCS', $site_path);
	
	define('MASTER_PAGE', '/html/master.tpl');
	
	//Лог файла по подразбиране
	$log_location = HTDOCS . '/logs/system.log';
	define('LOG_LOCATION', $log_location);
	define('LOGGING', true);
	
	//Заглавието на системата
	define('TITLE', 'Оръжия');
	
	//Емаил от който се изпращат писмата
	define('EMAIL_SERVER', 'mail.kontrax.bg');
	define('EMAIL_SENDER', 'mpavlov@kontrax.bg');
	
//Не променяй от тук надолу	
	if (DEBUG) {
		/*** error reporting on ***/
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	} else {
		/*** error reporting off ***/
		ini_set('display_errors', 0);
		error_reporting(0);
	}