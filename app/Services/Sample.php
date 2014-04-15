<?php
namespace Services;
/**
 * File is class for data manipulation. When entity specific querys have to be
 * made, then they need to be added here. The method ORM->rawQuery() gives You
 * the possibility to use any kind of querys. Note that the output sould be
 * translatable to current entity. If this is not possible, You can implement 
 * Your own querys here also by invoking database connection with 
 * $link = \Services\Database::singleton()->getConnection(); commmand
 *
 * PHP version 5.3.5
 *
 * @category   CM
 * @package    Framework
 * @subpackage Sample
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Sample extends ORM {
	/**
	 * Method returns all objects from database on success, false otherwise
	 * @return \Entities\Sample[]
	 */	
	public function getAll() {
		return $this->selectMulti(new \Entities\Sample());
	}
}