<?php
	
	class TemplatesController Extends BaseController {
		
		function __construct($registry) {
			parent::__construct($registry);
		}
		
		function index() {
			parent::display('html/index/login.tpl');
		}
		
		
		function home_pistols() {
			parent::display('html/templates/home_pistols.tpl');
		}
		function home_optics() {
			parent::display('html/templates/home_optics.tpl');
		}
		
		function results_optics() {
			parent::display('html/templates/results_optics.tpl');
		}
		
		function add_optics() {
			parent::display('html/templates/add_optics.tpl');
		}
		
		function search_optics() {
			parent::display('html/templates/search_optics.tpl');
		}
		
		function preview_optics() {
			parent::display('html/templates/preview_optics.tpl');
		}
	}