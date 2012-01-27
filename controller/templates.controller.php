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
			parent::display('html/templates/optics/home_optics.tpl');
		}
		
		function results_optics() {
			parent::display('html/templates/optics/results_optics.tpl');
		}
		
		function add_optics() {
			parent::display('html/templates/optics/add_optics.tpl');
		}
		
		function search_optics() {
			parent::display('html/templates/optics/search_optics.tpl');
		}
		
		function preview_optics() {
			parent::display('html/templates/optics/preview_optics.tpl');
		}
		
		function add_bullets() {
			parent::display('html/templates/bullets/add_bullets.tpl');
		}
		
		function home_bullets() {
			parent::display('html/templates/bullets/home_bullets.tpl');
		}
		
		function search_bullets() {
			parent::display('html/templates/bullets/search_bullets.tpl');
		}
		
		function preview_bullets() {
			parent::display('html/templates/bullets/preview_bullets.tpl');
		}
		
		function results_bullets() {
			parent::display('html/templates/bullets/results_bullets.tpl');
		}
		
		function add_rifles() {
			parent::display('html/templates/bullets/add_rifles.tpl');
		}
		
		function home_rifles() {
			parent::display('html/templates/bullets/home_rifles.tpl');
		}
		
		function search_rifles() {
			parent::display('html/templates/bullets/search_rifles.tpl');
		}
		
		function preview_rifles() {
			parent::display('html/templates/bullets/preview_rifles.tpl');
		}
		
		function results_rifles() {
			parent::display('html/templates/bullets/results_rifles.tpl');
		}
		
		
		function search_select_category() {
			parent::display('html/templates/search_select_category.tpl');
		}
		
	}