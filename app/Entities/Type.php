<?php
namespace Entities;
/**
 * Type object
 *
 * CREATE TABLE IF NOT EXISTS `onion`.`type` (
 *   `id` INT NOT NULL AUTO_INCREMENT,
 *   `name` VARCHAR(45) NOT NULL DEFAULT '',
 *   PRIMARY KEY (`id`))
 * ENGINE = InnoDB;
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Entities
 * @subpackage Model
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Type extends ORM implements \Interfaces\Transactional {
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