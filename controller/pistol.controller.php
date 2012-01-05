<?php
	require_once HTDOCS . '/model/pistol_type.model.php';
	class PistolController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			parent::display('html/index/login.tpl');
		}
		
		function ur_add_pistol() {
			$tmp_pistol_type = new PistolTypeModel();
			$pistol_types = $tmp_pistol_type->fetchAll();
			$this->registry->smarty->assign('pistol_types', $pistol_types);
			
			$this->display('html/pistol/ur_add_pistol.tpl');
		}
	}