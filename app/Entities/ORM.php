<?php
namespace Entities;
/**
 * File holds class with ORM helper methods for entities 
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Entities
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class ORM {
	/**
	 * Unique identificator in database
	 * @var int
	 */
	protected $_id;
	/**
	 * Variable to determine entitys name (\Services\ORM needs this!)
	 * @var var
	 */
	protected $_className;
	
	public function getId() {
		return $this->_id;
	}
	
	public function setId($id) {
		$this->_id = $id;
	}
	
	/**
	 * Method for returning all current class properties so that \Services\ORM
	 * knows which fields to check and insert (or select) from database)
	 * @return multitype:
	 */
	public function getProps() {
		return get_class_vars($this->getClassName());
	}
}