<?php
namespace Forms;
/**
 * File holds class for transforming sample object into HTML POST array and vice 
 * versa
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Forms
 * @subpackage Sample
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Sample extends Form {
	/**
	 * Sample object instance
	 * @var \Entities\Sample
	 */
	protected $_object;

	/**
	 * Populate entity specific object!
	 * @see \Forms\Form::setObject()
	 */
	public function setObject() {
		$this->_object = new \Entities\Sample();
	}
}