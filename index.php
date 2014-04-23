<?php
/**
 * Controller for app
 */
require_once 'app/env.php';
//show submit form, or do feedback saving
if (isset($_GET['action'])) {
	switch($_GET['action']) {
		/**
		 * Action tries to enter product to database
		 */
		case 'productAdd':
			$view = new Views\Product();
			$view->addAction($_POST);
			break;
			
		/**
		 * Action tries to enter review to database
		 */
		case 'reviewAdd':
			$view = new Views\Review();
			$view->addAction($_POST);
			break;			
		default:
			break;
	}
	
} else {
	/**
	 * Controller engine: check .htaccess for GET variable reference.
	 * When called object and method exist, run them
	 */
	if(isset($_GET['object'])) {
		$viewName = Misc\Tools::getValidView($_GET['object']);
		$view = new $viewName();
		if (isset($_GET['method'])) {
			$method = $_GET['method'] . 'View';
			if(method_exists($view, $method)) {
				if (isset($_GET['id'])) {
					$view->$method($_GET['id']);
				} else {
					$view->$method();
				}
			} else {
				$view->defaultView();
			}
		} else {
			$view->defaultView();
		}
	} else {
		$view = new Views\Sample();
		$view->defaultView();
	}
}
