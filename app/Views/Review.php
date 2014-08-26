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
		$this->_getAddViewItems();
		
		$this->_content = $this->_smarty->fetch('ReviewAdd.tpl');
		$this->setMessage($message);
		$this->display();
	}
	
	/**
	 * Method to show view where user can add review 
     * under predefined product (product is already selected)
	 */
	public function addUnderView($productId) {
		$orm = new \Services\ORM();
		$product = new \Entities\Product();
		$product->setId($productId);
		$product = $orm->select($product);
		$this->_getAddViewItems();
		$this->_smarty->assign('product', $product);
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
				
				$this->_openGraph->setTitle($p->getManufactor() . ' \'' . $p->getName() . '\' (' . $review->getRating() . '/10)');
				$this->_openGraph->setDescription($review->getDescription());
				$this->_openGraph->setUrl(LIKEURL . '/review/details/' . $review->getId());
				$this->_openGraph->setImage(LIKEURL . '/uploads/' . $this->getImgName($p));
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
        $this->_getListViewItems(); 
		$this->_content = $this->_smarty->fetch('ReviewList.tpl');
		$this->setMessage($message);
		$this->display();
	}
	
	/**
	 * Method populates smarty elements: 
	 * fresh - new reviews
	 * products - products that have reviews
	 * images - product images
	 * entities - reviews
	 */
	private function _getListViewItems() {
	    $orm = new \Services\ORM();
	    
	    $entity = new \Entities\Product();
	    $entity->setTypeId($this->_drinkType);
	    $p = $orm->getAll($entity);
	    $entities = $this->_service->getReviewsByProducts($p, $this->_drinkType);
	    $fresh = array_slice($entities, 0, 4);
	    $imgnames = array();
	    foreach ($fresh as $k => $itm) {
	        $imgnames[$itm->getProductId()] = $this->getImgName($p[$itm->getProductId()]);
	    }

	    $this->_openGraph->setTitle($this->_translation['reviews']);
	    $this->_openGraph->setUrl(LIKEURL . '/review/list/');
	    $this->_openGraph->setImage(LIKEURL . '/uploads/noimage.png');
	    
	    $this->_smarty->assign('fresh', $fresh);
	    $this->_smarty->assign('products', $p);
	    $this->_smarty->assign('images', $imgnames);
	    $this->_smarty->assign('entities', $entities);
	}
	
	/**
	 * Method populates smarty elements
	 * @see _getListViewItems
	 * tasteHW - taste hotwords
	 * appearanceHW - appearance hotwords
	 * aromaHW - aroma hotwords
	 */
	private function _getAddViewItems() {
	    $this->_getListViewItems();
	    $this->_smarty->assign('tasteHW', $this->_getTasteHotwords());
	    $this->_smarty->assign('appearanceHW', $this->_getAppearanceHotwords());
	    $this->_smarty->assign('aromaHW', $this->_getAromaHotwords());
	    
	    $this->_openGraph->setTitle($this->_translation['newreview']);
	    $this->_openGraph->setUrl(LIKEURL . '/review/add');
	    $this->_openGraph->setImage(LIKEURL . '/uploads/noimage.png');
	    
	}
	
	/**
	 * Parse review checkboxes before generic addaction is initiated
	 * (non-PHPdoc)
	 * @see \Views\Page::addAction()
	 */
	public function addAction($post) {
		$post = $this->_parseCheckboxes('taste', $post);
		$post = $this->_parseCheckboxes('smell', $post);
		$post = $this->_parseCheckboxes('color', $post);
		parent::addAction($post);
	}
	
	/**
	 * Method reads checkbox values, glues them together with , and then replaces the
	 * textarea element with the result. After this checkbox element is unset
	 * @param var $type Type to check: color, taste, smell
	 * @param var[] $post HTTP POST array
	 * @return var[] 
	 */
	private function _parseCheckboxes($type, $post) {
		//determine if checkboxes are used
		if(array_key_exists($type . '_cb', $post)) {
			//replace original contents with selection
			$post[$type] = join(', ', $post[$type . '_cb']);
			//unset checkbox array element, since it is not needed!
			unset($post[$type . '_cb']);
		}
		return $post;
	}
	
	private function _getAppearanceHotwords() {
	    return array('light', 'red', 'dark', 'golden', 'clear', 'hazy', 'foamy', 'lessFoamy', 'tightFoam', 'cafe', 'chocolate', 'spicy', 'greenBottle');
	}

	private function _getAromaHotwords() {
	    return array('weak', 'strong', 'hopy', 'sweet', 'sour', 'caramel', 'orange');
	}
	
	private function _getTasteHotwords() {
	    return array('bitter', 'acrid', 'lightTaste', 'mellow', 'tasteful', 'sweet', 'refreshing', 'lastingTaste', 'dry', 'wellBalanced', 'wheaty', 'caramel', 'heat', 'versatile', 'watery', 'hopy', 'smoky');
	}
}