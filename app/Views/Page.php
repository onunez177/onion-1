<?php
namespace Views;
/**
 * File holds class for Page object. It has general methods useful for all pages. 
 * Here menus and translations are loaded, messages are stored and general 
 * view is put together. 
 * 
 * When extensions to this pages are needed, Extend this class but keep this 
 * one unaltered for further versions!
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Views
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
abstract class Page {
	
	/**
	 * Array of translations
	 * @var array
	 */
	protected $_translation;
	
	/**
	 * Smarty template engine object
	 * @var \Smarty
	 */
	protected $_smarty;
	
	/**
	 * Array of messages to display to user 
	 * @var \Entities\Message[]
	 */
	protected $_messages;
	
	/**
	 * Variable holds page content, this is injected into index.tpl content 
	 * section
	 * @var var
	 */
	protected $_content;
	
	/**
	 * Constructor for standalone pages. Constructor initializes _setUp() and 
	 * _setService() methods 
	 */
	public function __construct() {
	    $this->_setUp();
	    $this->_setService();
	}
	
	/**
	 * Method sets up basic stuff like translations and smarty object
	 * @global $_SESSION['L'] Language identifier
	 */
	protected function _setUp() {
		$this->_loadLanguage($_SESSION['L']);
		$this->_loadSmarty();
		$this->_smarty->assign('lang', $this->_translation);
	}
	
	/**
	 * Method loads translation file into class property
	 * @param var $language Language identifier
	 */
	private function _loadLanguage($language) {
		switch ($language) {
			case \Enum\Language::Eng:
				include 'i18n/en.php';
				break;
			default:
				include 'i18n/en.php';
				break;
		}
		$this->_translation = $lang;		
	}
	
	/**
	 * Method loads smarty object into class attribute
	 */
	private function _loadSmarty() {
		global $smarty;
		$this->_smarty = $smarty;
	}
	
	/**
	 * Method presents index.tpl with set content and messages
	 */
	public function display() {
	    //assign messages object to page
		$this->_smarty->assign('messages', $this->_messages);
		//assign content object to page
		$this->_smarty->assign('content', $this->_content);
		//display index page
		$this->_smarty->display('index.tpl');
	}
	
	/**
	 * Method allows passing messages to another page views
	 * @param array $message Message to pass
	 * @param bool $reset Flag, whether to reset previous messages
	 */
	public function setMessage($message, $reset = false) {
		$valueSet = false;
		if (($reset || $this->_messages == false) && $message != false) {
			$this->_messages = array();
			$valueSet = true;
		}
		
		if ($this->_messages != null || $valueSet) {
			array_push($this->_messages, $message);
		} else {
			$this->_messages = false;
		}
	}
	
	/**
	 * Method for setting page specific service
	 */
	abstract protected function _setService();
	
	/**
	 * Method for basic view (set content, messages etc) 
	 */
	abstract function defaultView($message = false);
}