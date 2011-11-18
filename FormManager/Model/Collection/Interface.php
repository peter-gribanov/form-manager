<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 41 $
 * @since     $Date: 2011-10-01 00:28:31 +0400 (Сб, 01 окт 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Интерфейс коллекции полей
 * 
 * @package FormManager\Model\Collection
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Model_Collection_Interface extends FormManager_Model_Interface {

	/**
	 * Устанавливает форму
	 * 
	 * Устанавливает объект формы к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManager_Form $form Объект формы
	 * 
	 * @return FormManager_Model_Collection_Interface Объект коллекции
	 */
	public function setForm(FormManager_Form $form);

	// TODO описать интерфейс

}