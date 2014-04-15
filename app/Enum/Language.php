<?php
namespace Enum;
/**
 * ENUM class for Language identifiers. To use translations, a constant must be
 * declared here, a translation file needs to be present in i18n\ folder and
 * \Views\Page::_loadLanguage() method must be updated to include specific 
 * language file
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Entities
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Language {
	/**
	 * Constant for English language
	 * @var var
	 */
	const Eng = 'en';
	
	/**
	 * Constant for fallback language
	 * @var var
	 */
	const Fallback = self::Eng;
}