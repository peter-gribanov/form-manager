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
 * Интерфейс модели поля
 * 
 * @package FormManager\Interfaces\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Field extends FormManager_Interfaces_Model_Element {

	/**
	 * Устанавливает значение поля
	 * 
	 * @param string|integer|boolean $value
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
	public function setDefaultValue($value);

	/**
	 * Возвращает значение поля
	 * 
	 * @return string
	 */
	public function getDefaultValue();

	/**
	 * Возвращает значение поля
	 * 
	 * @return string
	 */
	public function getValue();

	/**
	 * Устанавливает значение поля
	 * 
	 * @param string|integer|boolean $value
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
//	public function setValue();

	/**
	 * Возвращает значение указанное пользователем
	 * 
	 * @return string
	 */
	public function &getSentValue();

	/**
	 * Определяет изменено ли поле
	 * 
	 * @return boolean
	 */
	public function isChanged();

}