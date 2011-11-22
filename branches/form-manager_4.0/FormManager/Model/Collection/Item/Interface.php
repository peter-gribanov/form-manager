<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision$
 * @since     $Date$
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Интерфейс элемента коллекции
 * 
 * @package FormManager\Model\Collection\Item
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Model_Collection_Item_Interface extends FormManager_Model_Interface {

	/**
	 * Устанавливает форму
	 * 
	 * Устанавливает объект формы к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManager_Model_Form $form Объект формы
	 * 
	 * @return FormManager_Model_Collection_Item_Interface Объект коллекции
	 */
	public function setForm(FormManager_Model_Form $form);

}