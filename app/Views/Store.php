<?php
namespace Views;

/**
 * File holds Store view class
 * PHP version 5.3.5
 * 
 * @category Onion
 * @package Views
 * @subpackage Sommelier
 * @author markus karileet <markuskarileet@hotmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link -
 */
class Store extends BeerPlanet {

    /**
     * Initialize view specific service for other methods
     * 
     * @see \Views\Page::_setService()
     */
    protected function _setService() {
        $this->_service = new \Services\Store();
    }

    /**
     * Initialize view specific entity for other methods
     * 
     * @see \Views\Page::_setEntity()
     */
    protected function _setEntity() {
        $this->_entity = new \Entities\Store();
    }

    public function defaultView($message = false) {
        $productService = new \Services\Product();
        $stores = $this->_service->getStoresByName($_GET['q']);
        return $productService->objectsToJson($stores);
    }

    public function detailsView($id, $message = false) {}

    /**
     * Method overrides default list view implemented in Page class.
     * This is
     * done so, that extra information could be passed to specific view. Once
     * this is done, the original method is called
     * 
     * @see \Views\Page::listView()
     */
    public function listView($message = false) {}

    /**
     * Add store to product
     * @param unknown $post
     */
    public function addAction($post) {
        $name = strip_tags(addslashes($post['name']));
        $object = new \Entities\Store();
        $object->setName($name);
        $id = $this->_service->insert($object);
        $mapping = new \Entities\ProductStore();
        $mapping->setStoreId($id);
        $mapping->setProductId($post['product']);
        $this->_service->insert($mapping);
    }
    
    /**
     * Delete store from product
     * @param unknown $post
     */
    public function deleteAction($post) {
        $name = strip_tags(addslashes($post['name']));
        $object = new \Entities\Store();
        $object->setName($name);
        $store = $this->_service->select($object);
        $mapping = new \Entities\ProductStore();
        $mapping->setStoreId($store->getId());
        $mapping->setProductId($post['product']);
        $this->_service->delete($mapping);
    }
}