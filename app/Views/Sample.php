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
class Sample extends BeerPlanet implements \Interfaces\Presentable {
	/**
	 * Initialize view specific service for other methods
	 * @see \Views\Page::_setService()
	 */
	protected function _setService() {
		$this->_service = new \Services\Sample();
	}

	/**
	 * Initialize view specific entity for other methods
	 * @see \Views\Page::_setEntity()
	 */
	protected function _setEntity() {
		$this->_entity = new \Entities\Sample();
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
	    $product = new \Entities\Product();
	    $product->setTypeId($this->_drinkType);
	    $productView = new \Views\Product();
	    $productView->loadFreshProductsToSmarty($product);
		$this->_content = $this->_smarty->fetch('welcome.tpl');
		$this->setMessage($message);
		$this->display();
	}
	
	public function chooseSideView() {
		//assign messages object to page
		$this->_smarty->assign('messages', $this->_messages);
		//assign content object to page
		$this->_smarty->assign('content', $this->_content);
		$this->_smarty->assign('openGraph', $this->_openGraph);
		//display index page
		$this->_smarty->display('chooseSide.tpl');
	}
	
	/**
	 * Method for showing entity adding form
	 * @param \Entities\Message $message Message to display
	 */
	public function addView($message = false) {
		
	}
	
	public function detailsView($id, $message = false) {
		
	}
	
	public function listView($message = false) {
		
	}
}