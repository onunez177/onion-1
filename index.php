<?php
/**
 * Controller for app
 */
require_once 'app/env.php';
//show submit form, or do feedback saving
if (isset($_GET['action'])) {
	switch($_GET['action']) {
		/**
		 * Action tries to enter sample object to database
		 */
		case 'samplePost':
			$view = new Views\Sample();
			$view->addAction($_POST);
			break;
		default:
			break;
	}
	
} else {
	switch (@$_GET['page']) {
		/**
		 * Page shows Sample adding form
		 */
		case 'sampleAdd':
			$view = new Views\Sample();
			$view->addView();
			break;    	
    	/**
    	 * Page shows main page
    	 */
		default:
			$view = new Views\Sample();
			$view->defaultView();
		    break;
		break;
	}
	
}
