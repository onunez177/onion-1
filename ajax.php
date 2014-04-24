<?php
require_once './app/env.php';
$out = "";
switch (@$_GET['op']) {
	//Read subtypes according to type
	case 'getSubTypes':
		$view = new Views\Product();
		$out = $view->getTypeSubTypesAsJson($_POST['typeId']);
		break;
	default:
		break;
}

//output data to browser
echo $out;