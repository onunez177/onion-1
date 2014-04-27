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
		$type = (int)$_SESSION['type'];
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

	public function getImgName($product) {
		//FIXME: some special chars do not show pictures correctly
		return urlencode(
				$product->getManufactor()
				. '_' . $product->getName() . '.png'
		);
	}
}