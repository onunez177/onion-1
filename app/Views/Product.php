<?php
namespace Views;
/**
 * File holds Product view class
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
class Product extends Page implements \Interfaces\Presentable {
	/**
	 * Initialize view specific service for other methods
	 * @see \Views\Page::_setService()
	 */
	protected function _setService() {
		$this->_service = new \Services\Product();
	}
	
	/**
	 * Initialize view specific entity for other methods
	 * @see \Views\Page::_setEntity()
	 */
	protected function _setEntity() {
		$this->_entity = new \Entities\Product();
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
	 * Method that shows Product adding form
	 * @param string $message
	 */
	public function addView($message = false) {
		$orm = new \Services\ORM();
		
		$products = $this->_service->getAll($this->_entity);
		$types = $orm->getAll(new \Entities\Type());
		//read all subtypes for productList
		$subTypes = $orm->getAll(new \Entities\SubType());
		$this->_smarty->assign('types', $types);
		//get only the subtypes of first type
		$typeSubTypes = $this->_getTypeSubTypes(array_shift($types)->getId());
		$this->_smarty->assign('typeSubtypes', $typeSubTypes);
		$this->_smarty->assign('subtypes', $subTypes);
		$this->_smarty->assign('entities', $products);
		$this->_content = $this->_smarty->fetch('ProductAdd.tpl');
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
			$product = $this->_service->select($this->_entity);
			if (!$product) {
				$this->setMessage(
						new \Entities\Message(
								\Enum\MessageType::Error,
								$this->_translation['notFound']
						));
			} else {
				$form = new \Forms\Form($this->_entity);
				$array = $form->objectToForm($product);
				$orm = new \Services\ORM();
				$type = new \Entities\Type();
				$type->setId($product->getTypeId());
				$t = $orm->select($type);
				//override default typeId
				$array['typeId'] = $this->_translation[$t->getName()];
				
				$subtype = new \Entities\SubType();
				$subtype->setId($product->getSubTypeId());
				$st = $orm->select($subtype);
				//override default subTypeId
				$array['subTypeId'] = $this->_translation[$st->getName()];
				//add reviews to product
				$reviews = $this->_getProductReviews($id);
				//add average to product
				$this->_smarty->assign('average', $this->_calculateAverageScore($reviews));
				$this->_smarty->assign('reviews', $reviews);
				$this->_smarty->assign('form', $array);
				$this->_content = $this->_smarty->fetch('ProductView.tpl');
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
	 * Method returns product reviews by product ID
	 * @param int $productId
	 * @return Ambigous <multitype:, boolean, number, Object>
	 */
	private function _getProductReviews($productId) {
		$orm = new \Services\ORM();
		$review = new \Entities\Review();
		$review->setProductId($productId);
		return $orm->selectMulti($review, 'id', \Enum\Order::Desc);
	}
	
	/**
	 * Method overrides default list view implemented in Page class. This is
	 * done so, that extra information could be passed to specific view. Once
	 * this is done, the original method is called
	 * @see \Views\Page::listView()
	 */
	public function listView($message = false) {
		$orm = new \Services\ORM();
		$t = $orm->getAll(new \Entities\Type());
		$st = $orm->getAll(new \Entities\SubType());
		$this->_smarty->assign('types', $t);
		$this->_smarty->assign('subtypes', $st);
		parent::listView($message);
	}
	
	/**
	 * Method calculates the average score for given reviews
	 * @param \Entities\Review[] $reviews
	 * @return float 
	 */
	private function _calculateAverageScore($reviews) {
		$score = 0;
		$counter = 0;
		foreach ($reviews as $review) {
			$score += $review->getRating();
			$counter++;
		}
		return $score / $counter;
	}

	/**
	 * Method outputs desired type subtypes as JSON
	 * @param int $typeId
	 * @return string
	 */
	public function getTypeSubTypesAsJson($typeId) {
		$subtypes = $this->_getTypeSubTypes($typeId);
		$out = array();
		foreach ($subtypes as $subtype) {
			//create key->val array with ID and translated name
			$out[$subtype->getId()] = $this->_translation[$subtype->getName()];
		}
		return json_encode($out);
	}

	/**
	 * Method retrieves type subtypes
	 * @param int $typeId
	 * @return Ambigous <multitype:, boolean, number, Object>
	 */
	private function _getTypeSubTypes($typeId) {
		$orm = new \Services\ORM();
		$type = new \Entities\SubType();
		$type->setTypeId($typeId);
		$t = $orm->selectMulti($type, 'id', \Enum\Order::Asc);
		return $t;
	}
}