<?php
namespace Entities;
/**
 * File holds class for message object. Used to send messages from view layer to
 * HTML layer and then display to user
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
class Message {
	
	/**
	 * Type of the message
	 * @var \Enum\MessageType
	 */
	private $_type;
	
	/**
	 * Message content
	 * @var var
	 */
	private $_message;
	
	public function __construct($type, $message) {
		$this->_type = $type;
		$this->_message = $message;
	}
	
	public function getType(){
		return $this->_type;
	}
	
	public function setType($type){
		$this->_type = $type;
	}
	
	public function getMessage() {
		return $this->_message;
	}
	
	public function setMessage($message) {
		$this->_message = $message;
	}
}