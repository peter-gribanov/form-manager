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
 * Интерфейс фильтра
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Filter_Interface extends FormManager_Interface {

	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param FormManager_Model_Field_Abstract $field Объект поля
	 */
	public function __construct(FormManager_Model_Field_Abstract $field);

	/**
	 * Проверяет поле
	 * 
	 * @throws FormManager_Filter_Exception
	 */
	public function valid();

}