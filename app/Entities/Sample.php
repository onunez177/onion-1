<?php
namespace Entities;
/**
 * File is simple value object. You must also create a database table with the
 * same fields as this class has (without underscores). The table name must 
 * match the class name in lowercase letters. Do not forget the ID field that
 * is used in ORM class!
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Entities
 * @subpackage Sample
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Sample extends ORM implements \Interfaces\Transactional {
	/**
	 * Name of the object
	 * @var var
	 */
	protected $_name;

	public function getName(){
		return $this->_name;
	}
	
	public function setName($name){
		$this->_name = $name;
	}
	
	/**
	 * This method has to be in every entity class for ORM to determine which
	 * table to use for database transactions!
	 * @see \Interfaces\Transactional::getClassName()
	 */
	public function getClassName() {
		return get_class();
	}
}