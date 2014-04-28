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
class Product extends ORM {

	/**
	 * Method returns product reviews by product ID
	 * @param int $productId
	 * @return Ambigous <multitype:, boolean, number, Object>
	 */
	public function getProductReviews($productId) {
		$review = new \Entities\Review();
		$review->setProductId($productId);
		return $this->selectMulti($review, 'id', \Enum\Order::Desc);
	}

	/**
	 * Method calculates the average score for given reviews
	 * @param \Entities\Review[] $reviews
	 * @return float
	 */
	public function calculateAverageScore($reviews) {
		$score = 0;
		$counter = 0;
		if($reviews != false && count($reviews) > 0) {
			foreach ($reviews as $review) {
				$score += $review->getRating();
				$counter++;
			}
			$retval = $score / $counter;
		} else {
			$retval = 0;
		}
		return $retval;
	}
	
	/**
	 * Method calculates average score for all products and returns them as
	 * associative array productId -> average score
	 * @param \Entities\Product[] $products
	 * @return float[]
	 */
	public function getAveragesForProducts($products) {
		$ratings = array();
		foreach ($products as $product) {
			$reviews = $this->getProductReviews($product->getId());
			$average = $this->calculateAverageScore($reviews);
			$ratings[$product->getId()] = $average;
		}
		return $ratings;
	}
	

	/**
	 * Method retrieves type subtypes
	 * @param int $typeId
	 * @return Ambigous <multitype:, boolean, number, Object>
	 */
	public function getTypeSubTypes($typeId) {
		$type = new \Entities\SubType();
		$type->setTypeId($typeId);
		$t = $this->selectMulti($type, 'id', \Enum\Order::Asc);
		return $t;
	}
}