<?php
/**
 * File holds default set up for web page, such as configs, includes, 
 * language etc. Do not touch this file unless You know what You are doing!
 */
//unit test bootstrap prefix. 
if (!defined('UNITTEST')) {
    define('UNITTEST', '');
}

require_once UNITTEST.'app/Configs/paths.php';
require_once UNITTEST.'app/Configs/database.php';
require_once UNITTEST.'app/Configs/misc.php';
require_once CLASSPATH . 'Misc/Tools.php';

spl_autoload_register('Misc\Tools::autoload');

//initiate global variable for templates
$smarty = Misc\Tools::initSmarty();

session_start();

//set user language to session. Views\Page::setUp method depends on this var
if (!isset($_GET['L'])) {
	if (!isset($_SESSION['L'])) {
		$_SESSION['L'] = \Enum\Language::Fallback;
	}
} else {
	$_SESSION['L'] = $_GET['L'];
}