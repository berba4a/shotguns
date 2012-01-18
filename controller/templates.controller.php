<?php
	require_once HTDOCS . '/model/group.model.php';
	require_once HTDOCS . '/model/user.model.php';
	
	class AdminController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
			if ($this->registry->user->group_id != 1) {
				$this->registry->smarty->assign('header_error_message', 'Нямате право за достъп до избраната страница !!!');
				$this->redirect(WWW . 'contract');
			}
		}
		
		function index() {
			parent::display('html/index/login.tpl');
		}
		
		function page1() {
			parent::display('html/templates/page1.tpl');
		}
		
		function page2() {
			parent::display('html/templates/page2.tpl');
		}
		
		function page3() {
			parent::display('html/templates/page3.tpl');
		}
		
		function page4() {
			parent::display('html/templates/page4.tpl');
		}
	}