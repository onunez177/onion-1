<?php
require_once './app/env.php';
$out = "";
switch (@$_GET['op']) {
	//Read subtypes according to type
	case 'getSubTypes':
		$view = new Views\Product();
		$out = $view->getTypeSubTypesAsJson($_POST['typeId']);
		break;
	case 'getStores':
	    $view = new Views\Store();
	    $out = $view->defaultView();
	    break;
	case 'addStore':
	    $view = new Views\Store();
	    $out = $view->addAction($_POST);
	    break;
	case 'deleteStore':
	    $view = new Views\Store();
	    $out = $view->deleteAction($_POST);
	    break;
	default:
		break;
}

//output data to browser
echo $out;