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
		
		function page2() {
			parent::display('html/templates/page2.tpl');
		}
		
		function page3() {
			parent::display('html/templates/page3.tpl');
		}
		
		function page4() {
			parent::display('html/templates/page4.tpl');
		}
		
		function page5() {
			parent::display('html/templates/page5.tpl');
		}
	}