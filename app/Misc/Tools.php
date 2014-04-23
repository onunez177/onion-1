<?php
namespace Misc;
/**
 * File holds class for misc methods (tools) used in application
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Misc
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Tools {
	/**
	 * Method tries to autoload called class
	 * @param var $classname
	 */
	public static function autoload($classname)
	{
		//autoload application classes
		if (strstr($classname, '\\')) {
			$file = CLASSPATH . str_replace('\\', '/', $classname) . '.php';
			if (file_exists($file)) {
				require_once  $file;
			}
		} else {
			$file = CLASSPATH . $classname . '.php';
			if (file_exists($file)) {
				require_once  $file;
			//try logger classes
			} else {
				$file = LOGGERDIR . $classname . '.php';
				if (file_exists($file)) {
					require_once  $file;
				}
			}
		}
	}
	
	/**
	 * Method requires and initiates smarty
	 * @return Smarty Template object
	 */
	public static function initSmarty()
	{
		require_once  SMARTYDIR . 'Smarty.class.php';
		$smarty = new \Smarty();
		$smarty->template_dir = TEMPLATES.'templates';
		$smarty->compile_dir = TEMPLATES.'templates_c';
		$smarty->cache_dir = TEMPLATES.'cache';
		$smarty->config_dir = TEMPLATES.'configs';
		return $smarty;
	}

	/**
	 * Method initiates log4php class. Configuration is included when found in
	 * configs
	 */
	public static function initLogger() {
		//configure only when file is found
		$file = CLASSPATH . 'Configs/dailyfile.properties';
		if (file_exists($file)) {
			\Logger::configure($file);
		}
		return \Logger::getLogger('Sommelier');
	}
	
	/**
	 * Method removes tags, escapes quotes and removes whitespace
	 * @param var $str unescaped string
	 * @return var Escaped string
	 */
	public static function cleanInput($str) {
		$out = strip_tags($str);
		$out = addslashes($out);
		$out = trim($out);
		return $out;
	}
	
	/**
	 * Method un-escapes quotes. Meant to be used in combination with cleanInput
	 * when showing data from database to user
	 * @param var $str Escaped string from database
	 * @return var Unescaped string
	 */
	public static function prepareOutput($str) {
		return stripslashes($str);
	}
	
	public static function getValidView($object) {
		return 'Views\\'.ucfirst($object);
	}
}