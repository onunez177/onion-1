<?php
namespace Services;
/**
 * File holds class for object relational mapping. This has the main logic for
 * database query generation.
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

class ORM {
	/**
	 * Log4PHP object
	 * @var \Logger
	 */
	protected $_logger;
	
	public function __construct() {
		$this->_logger = \Misc\Tools::initLogger();
	}
	
	/**
	 * ORM method for object insertion to database
	 * @param Object $object
	 * @return int Insert ID when successful
	 * @throws Exception when problems inserting object
	 */
	public function insert($object) {
		$this->_logger->debug('Inserting ' . $object->getClassName());
		$retval = false;
		//read obj properties, 
		$props = $object->getProps();
		$dbKeys = array();
		$objValues = array();
		//get values from properties
		foreach (array_keys($props) as $prop) {
			if (!in_array($prop, $this->_getExcludes())) {
				//remove preceding underscore from attribute name
				$key = substr($prop, 1);
				$dbKeys[] = "`$key`";
				$getter = "get" . ucfirst($key);
				//do not try to send '' as ID
			    if ($object->$getter() === null) {
			        $objValues[] = "null";
			    } else {
			        $objValues[] = "'" . $object->$getter() . "'";
			    }
			}
		}
		//generate sql
		$sql = 'INSERT INTO `%s` (%s) VALUES (%s);';
		$preparedSql = sprintf(
            $sql, 
            $this->_getTableName($object), 
            implode(',', $dbKeys), 
            implode(',', $objValues)
        );
		$retval = $this->rawQuery($preparedSql, $object); 
		return $retval;
	}
	
	/**
	 * Method updates object by ID. All fields are updated
	 * @param Object $object
	 * @return boolean true on success, false on error
	 * @throws \Exception When problem occurred while updating or object does 
	 * not have an ID
	 */
	public function update($object) {
		$this->_logger->debug(
			'Updating ' . $object->getClassName() . ', ID: ' . $object->getId()
		);
		$retval = false;
		if ($object->getId() > 0) {
    		$sql = 'UPDATE `%s` SET %s WHERE `id` = %d';
    		$keyValues = $this->_getKeyEqualsValueFromObject($object);
    		$preparedSql = sprintf(
                $sql, 
                $this->_getTableName($object), 
                implode(', ', $keyValues), 
                $object->getId()
            );
    		$retval = $this->rawQuery($preparedSql, $object);
		} else {
			$this->_logger->error('Can not update without ID!');
			$this->_logger->debug("Faulty object: " . var_export($object));
		    throw new \Exception('Can not update without ID!');
		}
		return $retval;
	}
	
	/**
	 * Method selects object from database. Pre-set object values to use AND 
	 * comparisson between them.
	 * @param Object $object
	 * @return Object on success, false when not found
	 * @throws \Exception When problem selecting object
	 */
	public function select($object) {
		$arrayOfObjects = $this->selectMulti($object);
		$obj = false;
		if ($arrayOfObjects) {
			$obj = array_pop($arrayOfObjects);
		}
		return $obj; 
	}
	
	/**
	 * Method selects multiple rows. Useful when selecting by foreign key!
	 * @param Object $object
	 * @param var $orderField Field name to order by, default false (no order)
	 * @param \Enum\Order $orderDirection Direction to order, default false
	 * @return array Array of objects, false when nothing found
	 * @throws \Exception When problem selecting object
	 */
	public function selectMulti(
		$object, 
		$orderField = false, 
		$orderDirection = false
	) {
		$this->_logger->debug('Selecting ' . $object->getClassName());
		$sql = 'SELECT * FROM `%s` WHERE %s';
		//add ordering when nessessary
		if ($orderField && $orderDirection) {
			$sql .= sprintf(' ORDER BY `%s` %s', $orderField, $orderDirection);
		}
		$keyValues = $this->_getKeyEqualsValueFromObject($object);
		if (count($keyValues) == 0) {
			$keyValues[] = '1 = 1';
		}
		$preparedSql = sprintf(
            $sql, 
            $this->_getTableName($object), 
            implode(' AND ', $keyValues)
        );
		$out = $this->rawQuery($preparedSql, $object);
		return $out;
	}
	
	/**
	 * Method for selecting all $object from database (orderd descending by ID)
	 * @param \Entities\* $object Object to select
	 * @return array Array of objects, false when nothing found
	 */
	public function getAll($object) {
		return $this->selectMulti($object, 'id', \Enum\Order::Desc);
	}
	
	/**
	 * Method executes a prepared sql, no matter what it is creates an array
	 * of objects with the result
	 * @param var $preparedSql SQL statement
	 * @param Object $object Object type to use, clone
	 * @return array Array of $object found from database (select), true on 
	 * update/delete
	 * @throws \Exception
	 */
	public function rawQuery($preparedSql, $object) {
		$this->_logger->debug('Executing SQL: ' . $preparedSql);
		$db = \Services\Database::singleton()->getConnection();
		$out = false;
		if ($retval = @mysql_query($preparedSql, $db)) {
		    //continue if this is a select command
		    if (is_resource($retval)) {
    			while ($resultset = mysql_fetch_assoc($retval)) {
    				$o = clone $object;
    				foreach (array_keys($resultset) as $key) {
    					$setter = "set" . ucfirst($key);
    					$o->$setter($resultset[$key]);
    				}
    				$out[] = $o;
    			}
			//this is for update or delete
		    } else if ($retval) {
		    	//handle inserts
		    	if (substr($preparedSql, 0, 6) == 'INSERT') {
		    		$out = mysql_insert_id($db);
		    	} else {
		        	$out = true;
		    	}
		    }
		} else {
		    $this->_logger->error('Can\'t query object! ' . @mysql_error($db));
		    $this->_logger->debug("Failed SQL: " . $preparedSql);
		    throw new \Exception('Can\'t query object! ' . @mysql_error($db));
		}
		if ($out) {
			$this->_logger->debug("Query successful! Found matches");
		} else {
			$this->_logger->debug("Query successful! No matches found");
		}
		return $out;
	}
	
	/**
	 * Method deletes object from database.Pre-set object values to use AND 
	 * comparisson between them.
	 * @param Object $object
	 * @throws \Exception When delete fails
	 * @return boolean True on success, false on error
	 */
	public function delete($object) {
		$this->_logger->debug('Deleting object ' . $object->getClassName());
		$sql = 'DELETE FROM `%s` WHERE %s';
		$retval = false;
		$keyValues = $this->_getKeyEqualsValueFromObject($object);
		$preparedSql = sprintf(
            $sql, 
            $this->_getTableName($object), 
            implode(' AND ', $keyValues)
        );
        $retval = $this->rawQuery($preparedSql, $object);
		return $retval;
	}
	
	/**
	 * Method returns table name from classname
	 * @param Object $object
	 * @return var Table name
	 */
	private function _getTableName($object) {
		$table = explode('\\', get_class($object));
		return lcfirst($table[1]);
	}
	
	/**
	 * Method reads object properties that are not in the excludes list and 
	 * returns array like array(`column` = 'object value')
	 * @param Object $object
	 * @return array
	 */
	private function _getKeyEqualsValueFromObject($object) {
		$props = $object->getProps();
		$keyValues = array();
		foreach (array_keys($props) as $prop) {
			if (!in_array($prop, $this->_getExcludes())) {
				$key = substr($prop, 1);
				$getter = "get" . ucfirst($key);
				if ($object->$getter() != null) {
					$keyValues[] = "`$key` = '" . $object->$getter() . "'";
				}
			}
		}
		return $keyValues;
	}
	
	/**
	 * Method returns excludes fieldnames
	 * @return array
	 */ 
	private function _getExcludes() {
		return  array('_className');
	}
}