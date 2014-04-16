<?php
namespace Forms;
/**
 * File holds class for translating HTML POST array to object and vice versa.
 * 
 * To transfer data from entity to form, You need to create new Form object
 * with entity that You want to send to the form. Then execute objectToForm()
 * method and use the resulting key->value array in Your template
 * 
 * To transfer HTML form to entity, initialize Form with desired entity that
 * will be populated by the class and then call formToObject($_POST) method
 * 
 * If you want to use empty values in your form (e.g. add and edit pages both
 * use same base template) then use init() method. This creates empty array
 * based on entity fields
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
class Form {
	/**
	 * Log4PHP object
	 * @var \Logger
	 */
	private $_logger;
	
	/**
	 * This object is entity specific. Initialized on instance creation
	 * @var \Entities\*
	 */
	private $_object;
	
	public function __construct($object) {
		$this->_logger = \Misc\Tools::initLogger();
		$this->_object = $object;
	}
	
	/**
	 * Method creates empty HTML form
	 * @return var[] HTML POST array
	 */
	public function init() {
		return $this->objectToForm($this->_object);
	}
	
	/**
	 * Method transforms HTML POST elements into specific object. Form object
	 * names must be the same as entity attribute names.
	 * @param var[] $form HTML POST array
	 * @return \Entities\* Specific entity object
	 */
	public function formToObject($form) {
		$this->_logger->debug(
			"HTML form to " . $this->_object->getClassName() . " object"
		);
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
				$setter = "set" . ucfirst($key);
				//populate object
				$obj->$setter(\Misc\Tools::cleanInput($form[$key]));
			} else {
				$this->_logger->warn(
					"HTML form had no element with key: " . $key
				);
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
		$this->_logger->debug(
			"Object " . $object->getClassName() . " to HTML form"
		);
		$out = array();
		$props = $object->getProps();
		$fields = array_keys($props);
		foreach($fields as $field) {
			$getter = "get" . ucfirst($key);
			$out[$key] = \Misc\Tools::prepareOutput($object->$getter());
		}
		return $out;
	}
}