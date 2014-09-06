<?php
namespace Services;
use Entities\ProductStore;
use Entities\Store as StoreObj;

/**
 * File is class for data manipulation.
 * When entity specific querys have to be
 * made, then they need to be added here. The method ORM->rawQuery() gives You
 * the possibility to use any kind of querys. Note that the output sould be
 * translatable to current entity. If this is not possible, You can implement
 * Your own querys here also by invoking database connection with
 * $link = \Services\Database::singleton()->getConnection(); commmand
 * PHP version 5.3.5
 * 
 * @category Onion
 * @package Framework
 * @subpackage Sommelier
 * @author markus karileet <markuskarileet@hotmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link -
 */
class Store extends ORM {

    /**
     * Find all store entrys mapped with project
     * 
     * @param int $id            
     * @return \Entities\Store[]
     */
    public function getStoresByProductId($id) {
        $storeIds = $this->getAllStoreIdsAssociatedWithProductId($id);
        // when no answer from database, just look for 0 ids :)
        if (count($storeIds) > 0 && $storeIds) {
            $csvListOfStoreIds = implode(',', $storeIds);
        } else {
            $csvListOfStoreIds = '0';
        }
        $sql = sprintf('SELECT * FROM `store` WHERE `id` IN (%s)', 
                $csvListOfStoreIds);
        return $this->rawQuery($sql, new StoreObj());
    }

    /**
     * Get Store IDs from many-to-many relationship!
     * 
     * @param int $id            
     * @return int[]
     */
    private function getAllStoreIdsAssociatedWithProductId($id) {
        $productStore = new ProductStore();
        $productStore->setProductId($id);
        $productStores = $this->selectMulti($productStore);
        $storeIds = array();
        if (is_array($productStores) && $productStores) {
            foreach ($productStores as $shop) {
                $storeIds[] = $shop->getStoreId();
            }
        }
        return $storeIds;
    }

    public function getStoresByName($name) {
        $sql = sprintf("SELECT * FROM `store` WHERE `name` LIKE '%%%s%%'", 
                strip_tags(addslashes($name)));
        return $this->rawQuery($sql, new StoreObj());
    }
}