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
interface FormManager_Filter_Interface {

	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param FormManager_Model_Field_Interface $field   Объект поля
	 * @param array                             $options Параметры фильтра
	 */
	public function __construct(FormManager_Model_Field_Interface &$field, array $options = array());

	/**
	 * Возвращает список ошибок
	 * 
	 * @return array
	 */
	public function getErrors();

	/**
	 * Проверяет поле
	 */
	public function check();

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export();

}