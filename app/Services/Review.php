<?php
namespace Services;
/**
 * File is class for data manipulation. When entity specific querys have to be
 * made, then they need to be added here. The method ORM->rawQuery() gives You
 * the possibility to use any kind of querys. Note that the output sould be
 * translatable to current entity. If this is not possible, You can implement 
 * Your own querys here also by invoking database connection with 
 * $link = \Services\Database::singleton()->getConnection(); commmand
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Framework
 * @subpackage Sommelier
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Review extends ORM {
	/**
	 * Method returns all reviews by product type. This method is nessessary
	 * because product has the type identifier, review does not.
	 * //TODO: create a special SQL method here
	 * @param \Entities\Product[] $products Array of products to filter from
	 * @return \Entities\Review[] Array of reviews on success, false otherwise
	 */
	public function getReviewsByProducts($products, $type) {
		$product = new \Entities\Product();
		$product->setTypeId($type);
		$reviews = $this->getAll(new \Entities\Review());
		$out = array();
		//make sure that entities are only those reviews that review the 
		//desired type kind of products
	
		foreach ($reviews as $review) {
			$product->setId($review->getProductId());
			if ($this->select($product)) {
				$out[$review->getId()] = $review;
			}
		}
		return $out;
	}
}