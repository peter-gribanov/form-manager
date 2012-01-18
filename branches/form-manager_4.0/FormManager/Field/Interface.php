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
 * @package FormManager\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Field_Interface extends FormManager_Element_Interface {

	/**
	 * Устанавливает значение поля
	 * 
	 * @param mixid $value
	 * 
	 * @return FormManager_Field_Interface
	 */
	public function setDefaultValue($value);

	/**
	 * Возвращает значение поля
	 * 
	 * @return mixid
	 */
	public function getDefaultValue();

	/**
	 * Возвращает значение поля
	 * 
	 * @return mixid
	 */
	public function getValue();

	/**
	 * Устанавливает значение поля
	 * 
	 * @param mixid $value
	 */
	public function setValue($value);

}