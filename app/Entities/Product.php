<?php
namespace Entities;
/**
 * Product object
 *
 * CREATE TABLE IF NOT EXISTS `onion`.`product` (
 *   `id` INT NOT NULL AUTO_INCREMENT,
 *   `typeId` INT NOT NULL DEFAULT 0,
 *   `subTypeId` INT NOT NULL DEFAULT 0,
 *   `name` VARCHAR(45) NOT NULL DEFAULT '',
 *   `manufactor` VARCHAR(45) NOT NULL DEFAULT '',
 *   `year` INT NOT NULL DEFAULT 0,
 *   `alc` FLOAT NOT NULL DEFAULT 0,
 *   `origin` VARCHAR(45) NOT NULL DEFAULT '',
 *   PRIMARY KEY (`id`),
 *   INDEX `fk_product_type_idx` (`typeId` ASC),
 *   INDEX `fk_product_subtype_idx` (`subTypeId` ASC),
 *   CONSTRAINT `fk_product_type`
 *     FOREIGN KEY (`typeId`)
 *     REFERENCES `onion`.`type` (`id`)
 *     ON DELETE NO ACTION
 *     ON UPDATE NO ACTION,
 *   CONSTRAINT `fk_product_subtype`
 *     FOREIGN KEY (`subTypeId`)
 *     REFERENCES `onion`.`subtype` (`id`)
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
class Product extends ORM implements \Interfaces\Transactional {
	/**
	 * Name of the object
	 * @var var
	 */
	protected $_name;
	
	/**
	 * Product type ID
	 * @var int
	 */
	protected $_typeId;
	
	/**
	 * Product subtype ID
	 * @var int
	 */
	protected $_subTypeId;
	
	/**
	 * Name of the manufactor
	 * @var var
	 */
	protected $_manufactor;
	
	/**
	 * Product manufactoring year
	 * @var int
	 */
	protected $_year;
	
	/**
	 * Volume of alcohol in product
	 * @var float
	 */
	protected $_alc;
	
	/**
	 * Origin country
	 * @var var
	 */
	protected $_origin;

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
	
	public function getSubTypeId(){
		return $this->_subTypeId;
	}
	
	public function setSubTypeId($subTypeId){
		$this->_subTypeId = $subTypeId;
	}
	
	public function getManufactor(){
		return $this->_manufactor;
	}
	
	public function setManufactor($manufactor){
		$this->_manufactor = $manufactor;
	}
	
	public function getYear(){
		return $this->_year;
	}
	
	public function setYear($year){
		$this->_year = intval($year);
	}
	
	public function getAlc(){
		return $this->_alc;
	}
	
	public function setAlc($alc){
		$this->_alc = floatval($alc);
	}
	
	public function getOrigin(){
		return $this->_origin;
	}
	
	public function setOrigin($origin){
		$this->_origin = $origin;
	}
	
	/**
	 * This method has to be in every entity class for ORM to determine which
	 * table to use for database transactions!
	 * @see \Interfaces\Transactional::getClassName()
	 */
	public function getClassName() {
		return get_class();
	}
	
	public function __toString() {
		return $this->_manufactor . ' ' . $this->_name;
	}
}