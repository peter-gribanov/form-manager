<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 109 $
 * @since     $Date: 2011-12-08 13:02:59 +0300 (Thu, 08 Dec 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Класс описывает элемент ввода Kcaptcha
 * 
 * @package FormManager\Model\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Field_Kcaptcha extends FormManager_Model_Field_Abstract {

	/**
	 * Длинна кода строки
	 * 
	 * @var integer
	 */
	const STRING_LENGTH = 6;

	/**
	 * Конструктор
	 */
	public function __construct() {
		// FIXME не все методы еще реализованы
		//$this->setView('kcaptcha');
		$this->setComment(sprintf(FormManager_Language::getMessage('kcaptcha-length'), $length));
		//$this->setFilter('empty');
		//$this->setFilter('length', array('min' => self::STRING_LENGTH, 'max' => self::STRING_LENGTH));
		//$this->setFilter('kcaptcha');
	}

}