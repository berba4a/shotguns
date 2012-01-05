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
		
		private function setGroupData() {
			$this->registry->smarty->assign('group_id', $this->getValue('group_id'));
			$this->registry->smarty->assign('name', $this->getValue('name'));
			$this->registry->smarty->assign('description', $this->getValue('description'));
		}
		
		function groups() {
			$this->setGroupData();
			
			$tmp_groups = new GroupModel();
			$groups = $tmp_groups->getParentGroups();
			$this->registry->smarty->assign('groups', $groups);
			
			$this->display('html/admin/groups.tpl');
		}
		
		function add_group() {
			$group = new GroupModel();
			$id = $group->insert($_POST);
			
			if (is_array($id)) {
				foreach ($id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('header_error_message', 'Не са попълнени всички задължителни полета!!!');
				}
			
				$this->groups();
				return false;
			}
			
			if (empty($id)) {
				$this->registry->smarty->assign('header_error_message', 'Грешка при добавяне на групата');
				$this->groups();
				return false;
			}
			
			$this->redirect(WWW . 'admin/groups');
		}
		
		private function setUserData() {
			$this->registry->smarty->assign('username', $this->getValue('username'));
			$this->registry->smarty->assign('password', $this->getValue('password'));
			$this->registry->smarty->assign('group_id', $this->getValue('group_id'));
			$this->registry->smarty->assign('real_name', $this->getValue('real_name'));
			$this->registry->smarty->assign('description', $this->getValue('description'));
		}
		
		function users() {
			$this->setUserData();
			
			$tmp_users = new UserModel();
			$users = $tmp_users->fetchAll();
			$this->registry->smarty->assign('users', $users);
			
			$tmp_groups = new GroupModel();
			$groups = $tmp_groups->getParentGroups();
			$this->registry->smarty->assign('groups', $groups);
			
			$this->display('html/admin/users.tpl');
		}
		
		function add_user() {
			$user = new UserModel();
			$id = $user->insert($_POST);
				
			if (is_array($id)) {
				foreach ($id as $column) {
					$this->registry->smarty->assign($column . '_error', 'Полето е задължително');
					$this->registry->smarty->assign('header_error_message', 'Не са попълнени всички задължителни полета!!!');
				}
					
				$this->users();
				return false;
			}
				
			if (empty($id)) {
				$this->registry->smarty->assign('header_error_message', 'Грешка при добавяне на групата');
				$this->users();
				return false;
			}
				
			$this->redirect(WWW . 'admin/users');
		}
	}