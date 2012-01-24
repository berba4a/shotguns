<?php
	require_once HTDOCS . '/model/user.model.php';
	
	class ContactsController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
			
			$this->registry->smarty->assign('controller', 'shotgun');
			$this->registry->smarty->assign('action', 'index');
		}
		
		function index() {
			parent::display('html/contacts/index.tpl');
		}
		
		function suggestion() {
			parent::display('html/contacts/suggestion.tpl');
		}
	}