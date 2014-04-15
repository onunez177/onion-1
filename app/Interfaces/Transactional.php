<?php
namespace Interfaces;
/**
 * File holds interface for ORM entities. This interface has to be implemented
 * by entities that will be stored to database. ID getters and setters do not
 * need to be implemented, since ORM entitys have to extend \Entities\ORM class,
 * that already has those methods implemented  
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Interfaces
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
interface Transactional {
	/**
	 * Method returns current class name for ORM to identify table name
	 */
	function getClassName();
	/**
	 * Unique identifier getter
	 */
	function getId();
	/**
	 * Unique identifier setter
	 */
	function setId($id);
	/**
	 * Method to retrieve object properties. They must be 'protected' not private
	 */
	function getProps();
}