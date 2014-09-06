<?php
namespace Entities;
/**
 * Many to many reference between product and store
 *
 * CREATE TABLE IF NOT EXISTS `onion`.`productStore` (
 *  `id` INT NOT NULL AUTO_INCREMENT,
 *  `productId` INT NOT NULL DEFAULT 0,
 *  `storeId` INT NOT NULL DEFAULT 0,
 *  PRIMARY KEY (`id`),
 *  INDEX `fk_product_store_product_idx` (`productId` ASC),
 *  INDEX `fk_product_store_store_idx` (`storeId` ASC),
 *  CONSTRAINT `fk_product_store_product`
 *    FOREIGN KEY (`productId`)
 *    REFERENCES `onion`.`product` (`id`)
 *    ON DELETE NO ACTION
 *    ON UPDATE NO ACTION,
 *  CONSTRAINT `fk_product_store_store`
 *    FOREIGN KEY (`storeId`)
 *    REFERENCES `onion`.`store` (`id`)
 *    ON DELETE NO ACTION
 *    ON UPDATE NO ACTION)
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
class ProductStore extends ORM implements \Interfaces\Transactional {
	/**
	 * Product id
	 * @var int
	 */
	protected $_productId;

	/**
	 * Store id
	 * @var int
	 */
	protected $_storeId;

	public function getProductId(){
		return $this->_productId;
	}
	
	public function setProductId($productId){
		$this->_productId = $productId;
	}
	
	public function getStoreId(){
		return $this->_storeId;
	}
	
	public function setStoreId($storeId){
		$this->_storeId = $storeId;
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