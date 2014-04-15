<?php
namespace Forms;
/**
 * File holds class for translating HTML POST array to object and vice versa.
 * This is an abstract class to extend by all elements that have a HTML input
 * output form.
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Forms
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
abstract class Form {
	/**
	 * Log4PHP object
	 * @var \Logger
	 */
	protected $_logger;
	
	/**
	 * This object is entity specific and is populated with setObject method
	 * @var \Entities\*
	 */
	protected $_object;
	
	public function __construct() {
		$this->_logger = \Misc\Tools::initLogger();
		$this->setObject();
	}
	
	/**
	 * Method creates empty HTML form
	 * @return var[] HTML POST array
	 */
	public function init() {
		return $this->objectToForm($this->_object);
	}
	
	/**
	 * Method to set entity specific object
	 */
	abstract function setObject();
	
	/**
	 * Method transforms HTML POST elements into specific object. Form object
	 * names must be the same as entity attribute names.
	 * @param var[] $form HTML POST array
	 * @return \Entities\* Specific entity object
	 */
	public function formToObject($form) {
		$this->_logger->debug("Transforming HTML form to " . $this->_object->getClassName() . " object");
		$obj = clone $this->_object;
		//read class attributes
		$props = $this->_object->getProps();
		//only keep attribute names
		$fields = array_keys($props);
		//loop through those names
		foreach($fields as $field) {
			//remove preceding underscore from attribute name
			$key = substr($field, 1);
			//check if theres a field in HTML POST
			if (in_array($key, array_keys($form))) {
				$setter = "set".ucfirst($key);
				//populate object
				$obj->$setter(\Misc\Tools::cleanInput($form[$key]));
			} else {
				$this->_logger->warn("HTML form had no element with key: " . $key);
			}
		}
		return $obj;
	}
	
	/**
	 * Method transforms object into key=>value array for HTML form
	 * @param \Entities\* $object Entity object to transform
	 * @return var[] key => value array derived from $object
	 */
	public function objectToForm($object) {
		$this->_logger->debug("Transforming object " . $object->getClassName() . " to HTML form");
		$out = array();
		$props = $object->getProps();
		$fields = array_keys($props);
		foreach($fields as $field) {
			$key = substr($field, 1);
			$out[$key] = \Misc\Tools::prepareOutput($props[$field]);
		}
		return $out;
	}
}