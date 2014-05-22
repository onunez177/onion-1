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
class Product extends BeerPlanet implements \Interfaces\Presentable {
	/**
	 * Product image thumbnail width
	 * @var int
	 */
	const IMG_X = 75;
	/**
	 * Product image thumbnail height
	 * @var int
	 */
	const IMG_Y = 150;
	
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
		$type = new \Entities\Type();
		
		//get only type that user has selected
		$type->setId($this->_drinkType);
		//get only products that are the type that user selected
		$this->_entity->setTypeId($this->_drinkType);
		
		$products = $this->_service->getAll($this->_entity);
		$types = $orm->getAll($type);
		//read all subtypes for productList
		$subTypes = $orm->getAll(new \Entities\SubType());
		$this->_smarty->assign('types', $types);
		//get only the subtypes of first type, do this after types array is
		//assigned to smarty, because array_shift removes the first element 
		$typeSubTypes = $this->_service->getTypeSubTypes(array_shift($types)->getId());
		$this->_smarty->assign('typeSubtypes', $typeSubTypes);
		$this->_smarty->assign('subtypes', $subTypes);
		$this->_smarty->assign('ratings', $this->_service->getAveragesForProducts($products));
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
				$reviews = $this->_service->getProductReviews($id);
				//add average to product
				$this->_smarty->assign(
					'average', 
					$this->_service->calculateAverageScore($reviews)
				);
				$imgName = $this->getImgName($product);
				$this->_smarty->assign('reviews', $reviews);
				$this->_smarty->assign('form', $array);
				$this->_smarty->assign('encodedName', $imgName);
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
	 * Method overrides default list view implemented in Page class. This is
	 * done so, that extra information could be passed to specific view. Also
	 * top fresh 4 beverages are shown before list
	 */
	public function listView($message = false) {
		$orm = new \Services\ORM();
		$t = $orm->getAll(new \Entities\Type());
		$st = $orm->getAll(new \Entities\SubType());
		$this->_smarty->assign('types', $t);
		$this->_smarty->assign('subtypes', $st);
		$this->_entity->setTypeId($this->_drinkType);
		$entities = $this->_service->getAll($this->_entity);
		$fresh = array_slice($entities, 0, 4);
		$imgnames = array();
		foreach ($fresh as $k => $itm) {
			$imgnames[$itm->getId()] = $this->getImgName($itm);
		}
		$this->_smarty->assign('fresh', $fresh);
		$this->_smarty->assign('images', $imgnames);
		$products = $this->_service->getAll($this->_entity);
		$ratings = $this->_service->getAveragesForProducts($products);
		$this->_smarty->assign('ratings', $ratings);
		$this->_smarty->assign('entities', $products);
		$this->setMessage($message);
		
		$this->_content = $this->_smarty->fetch('ProductList.tpl');
		$this->display();
	}

	/**
	 * Method outputs desired type subtypes as JSON. Type names are translated
	 * Method is to be called by ajax functions for subtype select
	 * @param int $typeId
	 * @return string
	 */
	public function getTypeSubTypesAsJson($typeId) {
		$subtypes = $this->_service->getTypeSubTypes($typeId);
		$out = array();
		foreach ($subtypes as $subtype) {
			//create key->val array with ID and translated name
			$out[$subtype->getId()] = $this->_translation[$subtype->getName()];
		}
		return json_encode($out);
	}
	
	/**
	 * Method to wrap parent class add action and add Image to server after 
	 * product is added to database
	 * @param unknown $post
	 */
	public function addAction($post) {
		$post['alc'] = str_replace(',', '.', $post['alc']);
		parent::addAction($post);
		$filename = $this->_createName($post['manufactor'], $post['name']);
		//upload image to server
		\Misc\Image::uploadImage($_FILES, $filename);
		//create thumbnail on the fly
		\Misc\Image::createCroppedThumbnail(
			APPPATH . 'uploads/',
			$filename,
			self::IMG_X,
			self::IMG_Y,
			'thumb'
		);
	}
}