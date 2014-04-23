<?php
namespace Entities;
/**
 * SubType object
 *
 * CREATE TABLE IF NOT EXISTS `onion`.`subtype` (
 *   `id` INT NOT NULL AUTO_INCREMENT,
 *   `typeId` INT NOT NULL,
 *   `name` VARCHAR(45) NOT NULL DEFAULT '',
 *   PRIMARY KEY (`id`),
 *   INDEX `fk_subtype_type_idx` (`typeId` ASC),
 *   CONSTRAINT `fk_subtype_type`
 *     FOREIGN KEY (`typeId`)
 *     REFERENCES `onion`.`type` (`id`)
 *     ON DELETE NO ACTION
 *     ON UPDATE NO ACTION)
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
class SubType extends ORM implements \Interfaces\Transactional {
	/**
	 * Name of the object
	 * @var var
	 */
	protected $_name;
	
	/**
	 * Parent type ID
	 * @var int
	 */
	protected $_typeId;

	public function getName(){
		return $this->_name;
	}
	
	public function setName($name){
		$this->_name = $name;
	}
	
	public function getTypeId(){
		return $this->_typeId;
	}
	
	public function setTypeId($typeId){
		$this->_typeId = $typeId;
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