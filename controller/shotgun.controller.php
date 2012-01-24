<?php
	require_once HTDOCS . '/model/user.model.php';
	
	class ShotgunController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			parent::display('html/shotgun/index.tpl');
		}
	}