<?php
namespace Views;
/**
 * File holds class for product specific Page object. 
 * It has site specific general functions that need to be on every view page
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
abstract class BeerPlanet extends Page {
    
	/**
	 * Variable to store drink type user chose on the first page
	 * @var int
	 */
	protected $_drinkType;

	/**
	 * Open graph data for page
	 * @var \Entities\OpenGraph
	 */
	protected $_openGraph;
	
	protected function _setUp() {
		$this->_setDrinkType();
		parent::_setUp();
		$this->_openGraph = new \Entities\OpenGraph();
		$this->_openGraph->setType('drink');
		$this->_openGraph->setDescription($this->_translation['introtext']);
		$key = 'drinkType' . $this->_drinkType;
		$this->_openGraph->setSiteName($this->_translation[$key] . 'Planet');
		$this->_openGraph->setUrl(LIKEURL);
		$this->_openGraph->setTitle($this->_translation[$key] . 'Planet');
		$this->_openGraph->setImage(LIKEURL . '/lib/design/images/logo.jpg');
	}
	
	/**
	 * Method parses $_SESSION['type'] variable and assignes it to _drinkType 
	 * variable. When unknown value is passed to function, then Beer will be set
	 * as drink type
	 * @see $_SESSION['type'] Drink type ID
	 */
	private function _setDrinkType() {
		$type = (int)@$_SESSION['type'];
		//set drink type variable. If not set, then Beer is used!
		switch ($type) {
			case \Enum\DrinkType::Beer:
				$this->_drinkType = \Enum\DrinkType::Beer;
				break;
			case \Enum\DrinkType::Wine:
				$this->_drinkType = \Enum\DrinkType::Wine;
				break;
			default:
				$this->_drinkType = \Enum\DrinkType::Beer;
				break;
		}
	}

	/**
	 * Method returns the image name. If image is not found, default image
	 * name is returned
	 * @param \Entities\Product $product
	 * @return string File name with .png appended
	 */
	public function getImgName($product) {
		$name = $this->_createName($product->getManufactor(), $product->getName());
		
		if (!file_exists(IMGUPLOAD . $name)) {
			$name = NOIMAGE;
		}
		return $name;
	}
	
	/**
	 * Methos appends a and b and replaces all non-word characters
	 * @param var $a manufactor
	 * @param var $b name
	 * @return string File name with .png appended
	 */
	protected function _createName($a, $b) {
		$name = preg_replace("/\W/", "", $a . '_' . $b) . '.png';
		return $name;
	}
	
	/**
	 * Method checks if image exists on server or not
	 * @param \Entities\Product $product
	 * @return boolean
	 */
	public function imageExists($product) {
		return !file_exists($this->getImgName($product));
	}
	
	public function display() {
	    //add opengraph to page for facebook statistics
	    $this->_smarty->assign('openGraph', $this->_openGraph);
	    parent::display();
	}
	
	abstract function detailsView($id, $message = false);
	
	/**
	 * Method for storing user input from HTML form. After insert, user is
	 * returned to detailsView() with appropriate message about insertion
	 * @param var[] $post HTTP POST
	 */
	public function addAction($post) {
	    $form = new \Forms\Form($this->_entity);
	    $obj = $form->formToObject($post);
	    $id = 0;
	    try {
	        if ($id = $this->_service->insert($obj)) {
	            $message = new \Entities\Message(
	                    \Enum\MessageType::Success,
	                    $this->_translation['insertSuccess']
	            );
	        } else {
	            $message = new \Entities\Message(
	                    \Enum\MessageType::Warning,
	                    $this->_translation['insertFail']
	            );
	        }
	    } catch (\Exception $e) {
	        $message = new \Entities\Message(
	                \Enum\MessageType::Error,
	                $this->_translation['internalError']
	        );
	    }
	    $this->detailsView($id, $message);
	}
}