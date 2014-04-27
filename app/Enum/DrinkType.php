<?php
namespace Enum;
/**
 * ENUM class for Drink type identifier. This is chosen by user when first 
 * entering the site: whether it's beer or wine planet
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Entities
 * @subpackage Sommelier
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class DrinkType {
	/**
	 * Constant for drink type beer
	 * @var int
	 */
	const Beer = 1;
	
	/**
	 * Constant for drink type wine
	 * @var int
	 */
	const Wine = 2;
}