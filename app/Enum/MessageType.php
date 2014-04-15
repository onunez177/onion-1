<?php
namespace Enum;
/**
 * ENUM class for message types. Create CSS classes with the same name as 
 * message type values!
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Entities
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class MessageType {
	/**
	 * Constant for error message
	 * @var var
	 */
	const Error = 'error';
	
	/**
	 * Constant for success message
	 * @var var
	 */
	const Success = 'success';
	
	/**
	 * Constant for info message
	 * @var var
	 */
	const Info = 'info';
	
	/**
	 * Constant for warning message
	 * @var var
	 */
	const Warning = 'warning';
}