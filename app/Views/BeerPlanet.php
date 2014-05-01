<?php
namespace Views;
/**
 * File holds class for product specific Page object. 
 * It has site specific general functions that need to be on every view page
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Views
 * @subpackage Sommelier
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
abstract class BeerPlanet extends Page {
	/**
	 * Variable to store drink type user chose on the first page
	 * @var int
	 */
	protected $_drinkType;
	
	protected function _setUp() {
		$this->_setDrinkType();
		parent::_setUp();
	}
	
	/**
	 * Method parses $_SESSION['type'] variable and assignes it to _drinkType 
	 * variable. When unknown value is passed to function, then Beer will be set
	 * as drink type
	 * @see $_SESSION['type'] Drink type ID
	 */
	private function _setDrinkType() {
		$type = (int)@$_SESSION['type'];
		//set drink type variable. If not set, then Beer is used!
		switch ($type) {
			case \Enum\DrinkType::Beer:
				$this->_drinkType = \Enum\DrinkType::Beer;
				break;
			case \Enum\DrinkType::Wine:
				$this->_drinkType = \Enum\DrinkType::Wine;
				break;
			default:
				$this->_drinkType = \Enum\DrinkType::Beer;
				break;
		}
	}

	/**
	 * Method returns the image name. If image is not found, default image
	 * name is returned
	 * @param \Entities\Product $product
	 * @return string File name with .png appended
	 */
	public function getImgName($product) {
		$name = $this->_createName($product->getManufactor(), $product->getName());
		
		if (!file_exists(IMGUPLOAD . $name)) {
			$name = NOIMAGE;
		}
		return $name;
	}
	
	/**
	 * Methos appends a and b and replaces all non-word characters
	 * @param var $a manufactor
	 * @param var $b name
	 * @return string File name with .png appended
	 */
	protected function _createName($a, $b) {
		$name = preg_replace("/\W/", "", $a . '_' . $b) . '.png';
		return $name;
	}
	
	/**
	 * Method checks if image exists on server or not
	 * @param \Entities\Product $product
	 * @return boolean
	 */
	public function imageExists($product) {
		return !file_exists($this->getImgName($product));
	}
}
