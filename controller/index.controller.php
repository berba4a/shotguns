<?php
	require_once HTDOCS . '/model/user.model.php';
	
	class IndexController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			parent::display('html/index/login.tpl');
		}
		
		function login() {
			$username = $this->getValue('username');
			$password = $this->getValue('password');
			
			$user = new UserModel();
			if ($_SESSION['user_id'] = $user->login($username, $password)) {
				$this->registry->smarty->assign('user', $user);
				echo "redirect";
				$this->redirect(WWW . 'contract');
			} else {
				$this->registry->smarty->assign('error_message', 'Грешно потребителско име или парола!!!');
				parent::display('html/index/login.tpl');
			}
		}
		
		function logout() {
			unset($_SESSION['user_id']);
			$this->redirect(WWW);
		}
	}