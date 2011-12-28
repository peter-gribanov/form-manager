<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 100 $
 * @since     $Date: 2011-12-02 20:45:59 +0300 (Fri, 02 Dec 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Коллекция элиментов формы связанных с полем
 * 
 * @package FormManager\Model\Collection
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Collection_Related extends FormManager_Model_Element {

	/**
	 * Связанный элемент
	 * 
	 * @var FormManager_Model_Field_Abstract|null
	 */
	private $related = null;

	/**
	 * Сравниваемое значение
	 * 
	 * @var string|integer|floot|boolean
	 */
	private $expected = '';


	/**
	 * Добавляет связь
	 * 
	 * @param FormManager_Model_Field_Abstract $field
	 * @param mixid                            $expected
	 */
	public function setRelated(FormManager_Model_Field_Abstract $field, $expected) {
		$this->related = $field;
		$this->expected = $expected;
	}

	// TODO требуется реализация связи
}