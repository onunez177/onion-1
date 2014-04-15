<?php
namespace Services;
/**
 * File holds singleton for database connection
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Services
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Database
{
    /**
     * Singleton instance
     * @var \Services\Database
     */
    private static $instance;
    /**
     * Variable for mysql connection
     * @var connection
     */
    private $_connection;
    
    /**
     * Method initializes DB connection and sets names to UTF8 if SETDBENCODING
     * is set to true
     */
    private function __construct()
    {
    	global $db;
    	$logger = \Misc\Tools::initLogger();
    	$con = @mysql_connect($db['host'], $db['user'], $db['pass']);
    	@mysql_select_db($db['schema'], $con);
    	if (SETDBENCODING) {
    		@mysql_query('SET names UTF8', $con);
    	}
    	$this->_connection = $con;
    	
    	if (!is_resource($this->_connection)) {
    	    $logger->error('Database connection failed!');
    	    $logger->debug("Database connection failed with error: " . mysql_error());
    	}
    }

    /**
     * Method returns singleton instance
     * @return \Services\Database
     */
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

    /**
     * Method returns DB connection object from singleton
     * @return connection
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    public function __clone()
    {
        trigger_error('Cloning forbidden.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Deserialize forbidden.', E_USER_ERROR);
    }
}