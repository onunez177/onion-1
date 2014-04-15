<?php
namespace Views;
/**
 * File holds Sample class for translating services to templates and vice versa.
 * All controller calls come through classes in \Views package. Shown methods
 * are a must for this framework to work
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Views
 * @subpackage Sample
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Sample extends Page {
	
    /**
     * Service object associated with this view. Scope is private to overload
     * parent class service object. Must be set in _setService() method, since
     * it is abstract and called in parent class setUp() method
     * @var \Services\Sample
     */
	private $_service;
	
	/**
	 * Initialize view specific service for other methods
	 * @see \Views\Page::_setService()
	 */
	protected function _setService() {
		$this->_service = new \Services\Sample();
	}
	
	/**
	 * This is a mandatory method for all view pages. This initializes the 
	 * default view associated with view-specific Entity (usually a list of
	 * all elements etc). Basic structure of this method is to populate 
	 * _content variable, that is injected into index.tpl main section. Usually
	 * this is a HTML fragment that displays a list of Entitys in database.
	 * To show a specific message to user, setMessage() method can be called 
	 * here. Finally, display() must be called to render the entire page
	 * @see \Views\Page::defaultView()
	 */
	public function defaultView($message = false) {
		$this->_content = "hello world!";
		$this->setMessage($message);
		$this->display();
	}
	
	/**
	 * Method for showing entity adding form
	 * @param \Entities\Message $message Message to display
	 */
	public function addView($message = false) {
		$form = new \Forms\Sample();
		$this->_smarty->assign('form', $form->init());
		$this->_content = $this->_smarty->fetch('sampleAdd.tpl');
		$this->display($message);
	}
	
	/**
	 * Method for storing user input from HTML form. After insert, user is 
	 * returned to defaultView() with appropriate message about insertion
	 * @param var[] $post HTTP POST
	 */
	public function addAction($post) {
		$form = new \Forms\Sample();
		$obj = $form->formToObject($post);
		try {
			if ($id = $this->_service->insert($obj)) {
				$this->defaultView(new \Entities\Message(\Enum\MessageType::Success, "Successfully inserted: " . $id));
			} else {
				$this->defaultView(new \Entities\Message(\Enum\MessageType::Warning, "Insert failed"));
			}
			
		} catch (\Exception $e) {
			$this->defaultView(new \Entities\Message(\Enum\MessageType::Error, "Cant insert!"));
		}
	}
}