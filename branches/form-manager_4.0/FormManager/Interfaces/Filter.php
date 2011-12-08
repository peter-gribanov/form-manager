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
 * @package FormManager\Interfaces
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Filter {

	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param FormManager_Interfaces_Model_Field $field   Объект поля
	 * @param array                              $options Параметры фильтра
	 */
	public function __construct(FormManager_Interfaces_Model_Field &$field, array $options = array());

	/**
	 * Возвращает список ошибок
	 * 
	 * @return array
	 */
	public function getErrors();

	/**
	 * Проверяет поле
	 * 
	 * @throws FormManager_Exceptions_Filter
	 */
	public function check();

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export();

}