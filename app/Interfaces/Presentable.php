<?php
namespace Interfaces;
/**
 * Interface describes methods for presenting a single entity or list of them.
 * Also a proxy method defaultView is described that needs to be implemented.
 * All View classes should implement this interface.
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Interfaces
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
interface Presentable {
	/**
	 * View that shows list of specific entities.
	 * @param \Entities\Message $message Message object, when necessary
	 */
	public function listView($message = false);
	/**
	 * View that shows details of entity by ID
	 * @param int $id ID of the entity to show
	 * @param \Entities\Message $message Message object, when necessary
	 */
	public function detailsView($id, $message = false);
	/**
	 * View that is shown by default. This is a proxy method.
	 * @param \Entities\Message $message Message object, when necessary
	 */
	public function defaultView($message = false);
	/**
	 * View that enables user to add a new entity to database
	 * @param \Entities\Message $message Message object, when necessary
	 */
	public function addView($message = false);
}