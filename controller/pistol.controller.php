<?php
	require_once HTDOCS . '/model/pistol_type.model.php';
	require_once HTDOCS . '/model/pistol_mark.model.php';
	require_once HTDOCS . '/model/pistol_caliber.model.php';
	require_once HTDOCS . '/model/city.model.php';
	
	class PistolController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			parent::display('html/index/login.tpl');
		}
		
		/**
		 * 
		 * Добавяне на пистолет от не регистриран потребител
		 */
		function ur_add_pistol() {
			$tmp_pistol_type = new PistolTypeModel();
			$pistol_types = $tmp_pistol_type->fetchAll();
			$this->registry->smarty->assign('pistol_types', $pistol_types);
			
			$tmp_city = new CityModel();
			$cities = $tmp_city->fetchAll();
			$this->registry->smarty->assign('cities', $cities);
			
			$this->display('html/pistol/ur_add_pistol.tpl');
		}
		
		/**
		 * 
		 * Връяа марките на даден вид пистолет в json формат
		 * @return boolean
		 */
		function marks() {
			$type_id = $this->getValue('type_id', false, '_GET');
			if (empty($type_id)) {
				return false;
			}
			
			$return = array();
			$tmp_marks = new PistolMarkModel();
			$marks = $tmp_marks->fetchAll(array('filter' => ' where type_id = :type_id', 'values' => array('type_id' => $type_id)));
			foreach ($marks as $mark) {
				$tmp = new stdClass();
				$tmp->id = $mark->id;
				$tmp->mark = $mark->mark;
				$return[] = $tmp;
			}
			echo json_encode($return);
			
			return true;
		}
		
		function calibers() {
			$mark_id = $this->getValue('mark_id', false, '_GET');
			if (empty($mark_id)) {
				return false;
			}
				
			$return = array();
			$tmp_caliber = new PistolCaliberModel();
			$calibers = $tmp_caliber->fetchAll(array('filter' => ' where mark_id = :mark_id', 'values' => array('mark_id' => $mark_id)));
			foreach ($calibers as $caliber) {
				$tmp = new stdClass();
				$tmp->id = $caliber->id;
				$tmp->mark = $caliber->caliber;
				$return[] = $tmp;
			}
			echo json_encode($return);
				
			return true;
		}
	}