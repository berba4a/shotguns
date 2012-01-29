<?php
	require_once HTDOCS . '/model/group.model.php';
	require_once HTDOCS . '/model/user.model.php';
	
	class OpticController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
			if ($this->registry->user->group_id != 1) {
				$this->registry->smarty->assign('header_error_message', 'Нямате право за достъп до избраната страница !!!');
				$this->redirect(WWW . 'contract');
			}
		}
		
		function index() {
			echo "Да се направи";
			parent::display(('html/templates/home_pistols.tpl');
		}
		
		function ur_add() {
			
		}
	}