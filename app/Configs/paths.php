<?php
/**
 * Configuration file for different paths. Usually You only need to modify the
 * WEBROOT constant to match your webroot (usually / or /<projectname>)
 */

/**
 * Path for web items such as css and images
 * @var var
 */
define('WEBROOT', '/onionFramework');

/**
 * Define root path
 */
if(!defined('APPPATH')) {
	define('APPPATH', UNITTEST.dirname(realpath('index.php')).'/');
}

/**
 * Define root path for namespaces (for autoloader)
 * @var var
 */
define('CLASSPATH', APPPATH . 'app/');

/**
 * Define path for Smarty template engine
 * @var var
 */
define('SMARTYDIR', APPPATH . 'lib/Smarty-3.1.18/libs/');

/**
 * Define path for log4php extension
 * @var var
 */
define('LOGGERDIR', APPPATH . 'lib/apache-log4php-2.3.0/');

/**
 * Define path for Smarty template files
 * @var unknown_type
 */
define('TEMPLATES', APPPATH . 'tmpl/');