<?php
namespace Views;
/**
 * File holds Review view class
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
class Review extends BeerPlanet implements \Interfaces\Presentable {
	/**
	 * Initialize view specific service for other methods
	 * @see \Views\Page::_setService()
	 */
	protected function _setService() {
		$this->_service = new \Services\Review();
	}
	
	/**
	 * Initialize view specific entity for other methods
	 * @see \Views\Page::_setEntity()
	 */
	protected function _setEntity() {
		$this->_entity = new \Entities\Review();
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
		$this->addView($message);
	}
	
	/**
	 * Method that shows Review adding form
	 * @param string $message
	 */
	public function addView($message = false) {
		$orm = new \Services\ORM();
		$entity = new \Entities\Product();
		$entity->setTypeId($this->_drinkType);
		$products = $orm->getAll($entity);
		
		$reviews = $this->_getReviewsByProducts($products);
		$this->_smarty->assign('products', $products);
		$this->_smarty->assign('entities', $reviews);
		$this->_content = $this->_smarty->fetch('ReviewAdd.tpl');
		$this->setMessage($message);
		$this->display();
	}
	
	/**
	 * Method to add review for predefined product
	 */
	public function addUnderView($productId) {
		$orm = new \Services\ORM();
		$product = new \Entities\Product();
		$product->setId($productId);
		$product = $orm->select($product);
		$reviews = $this->_service->getAll($this->_entity);
		$this->_smarty->assign('product', $product);
		$this->_smarty->assign('products', $products);
		$this->_smarty->assign('entities', $reviews);
		$this->_content = $this->_smarty->fetch('ReviewAdd.tpl');
		$this->setMessage($message);
		$this->display();
	}
	
	/**
	 * Method shows single element from database. When object is requested, it
	 * is turned into array form and passed to template as 'form' element
	 * @param int $id Object ID
	 * @param string $message
	 */
	public function detailsView($id, $message = false) {
		if ($id > 0) {
			$this->_entity->setId($id);
			$review = $this->_service->select($this->_entity);
			if (!$review) {
				$this->setMessage(
					new \Entities\Message(
						\Enum\MessageType::Error, 
						$this->_translation['notFound']
					));
			} else {
				$form = new \Forms\Form($this->_entity);
				$array = $form->objectToForm($review);
				//read real product name and manufactor for showing in HTML
				$orm = new \Services\ORM();
				$product = new \Entities\Product();
				$product->setId($review->getProductId());
				$p = $orm->select($product);
				//override form, add manufactor and name element
				$array['manufactor'] = $p->getManufactor();
				$this->_smarty->assign('encodedName', $this->getImgName($p));
				$array['name'] = $p->getName();
				$this->_smarty->assign('form', $array);
				$this->_content = $this->_smarty->fetch('ReviewView.tpl');
			}
		} else {
			$this->setMessage(
				new \Entities\Message(
					\Enum\MessageType::Error, 
					$this->_translation['invalidInput']
				));
		}
		$this->setMessage($message);
		$this->display();
	}
	
	/**
	 * Method overrides default list view implemented in Page class. This is 
	 * done so, that extra information could be passed to specific view. Once
	 * this is done, the original method is called
	 * @see \Views\Page::listView()
	 */
	public function listView($message = false) {
		$orm = new \Services\ORM();
		
		$entity = new \Entities\Product();
		$entity->setTypeId($this->_drinkType);
		$p = $orm->getAll($entity);
		$this->_smarty->assign('products', $p);
		$this->_smarty->assign('entities', $this->_getReviewsByProducts($p));
		$this->_content = $this->_smarty->fetch('ReviewList.tpl');
		$this->setMessage($message);
		$this->display();
	}
	
	/**
	 * Method returns all reviews by product type. 
	 * @param unknown $products
	 * @return multitype:unknown
	 */
	private function _getReviewsByProducts($products) {
		$orm = new \Services\ORM();
		$entity = new \Entities\Product();
		$entity->setTypeId($this->_drinkType);
		$entities = $this->_service->getAll($this->_entity);
		$out = array();
		//make sure that entities are only those reviews that review the desired
		//type kind of products
		
		foreach ($entities as $review) {
			$entity->setId($review->getProductId());
			if ($orm->select($entity)) {
				$out[$review->getId()] = $review;
			}
		}
		return $out;
	}
}