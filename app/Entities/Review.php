<?php
namespace Entities;
/**
 * Review object
 *
 * CREATE TABLE IF NOT EXISTS `onion`.`review` (
 *   `id` INT NOT NULL AUTO_INCREMENT,
 *   `productId` INT NOT NULL,
 *   `color` VARCHAR(1000) NOT NULL DEFAULT '',
 *   `smell` VARCHAR(1000) NOT NULL DEFAULT '',
 *   `taste` VARCHAR(1000) NOT NULL DEFAULT '',
 *   `description` VARCHAR(1000) NOT NULL DEFAULT '',
 *   `rating` INT NOT NULL DEFAULT 0,
 *   `user` VARCHAR(45) NOT NULL DEFAULT 'anonymous',
 *   PRIMARY KEY (`id`),
 *   INDEX `fk_review_product_idx` (`productId` ASC),
 *   CONSTRAINT `fk_review_product`
 *     FOREIGN KEY (`productId`)
 *     REFERENCES `onion`.`product` (`id`)
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
class Review extends ORM implements \Interfaces\Transactional {
	/**
	 * Product ID that is being reviewd
	 * @var int
	 */
	protected $_productId;
	/**
	 * Description of the color of the product
	 * @var var
	 */
	protected $_color;
	/**
	 * General description of the product
	 * @var var
	 */
	protected $_description;
	/**
	 * Products smell
	 * @var var
	 */
	protected $_smell;
	/**
	 * Products taste
	 * @var var
	 */
	protected $_taste;
	/**
	 * Users rating to the product
	 * @var int
	 */
	protected $_rating;
	/**
	 * Reviewer name
	 * @var var
	 */
	protected $_user;

	public function getProductId(){
		return $this->_productId;
	}
	
	public function setProductId($productId){
		$this->_productId = $productId;
	}
	
	public function getColor(){
		return $this->_color;
	}
	
	public function setColor($color){
		$this->_color = $color;
	}
	
	public function getDescription(){
		return $this->_description;
	}
	
	public function setDescription($description){
		$this->_description = $description;
	}
	
	public function getSmell(){
		return $this->_smell;
	}
	
	public function setSmell($smell){
		$this->_smell = $smell;
	}
	
	public function getTaste(){
		return $this->_taste;
	}
	
	public function setTaste($taste){
		$this->_taste = $taste;
	}
	
	public function getRating(){
		return $this->_rating;
	}
	
	public function setRating($rating){
		$this->_rating = intval($rating);
	}

	public function getUser(){
		return $this->_user;
	}
	
	public function setUser($user){
		$this->_user = $user;
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