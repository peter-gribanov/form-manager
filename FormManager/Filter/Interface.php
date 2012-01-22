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
interface FormManager_Filter_Interface extends Serializable {

	/**
	 * Возвращает список ошибок
	 * 
	 * @return array
	 */
	public function getErrors();

	/**
	 * Возвращает список уведомлений
	 * 
	 * @return array
	 */
	public function getNotices();

	/**
	 * Фильтровать и проверить ненадёжные данные и возвращает результат
	 * 
	 * @param mixed                         $value   Проверяемые данные
	 * @param FormManager_Element_Interface $element Проверяемый елемент
	 * 
	 * @return mixed Отфильтрованное $value
	 */
	public function exec($value, FormManager_Element_Interface $element);

	/**
	 * Собирает елемент
	 * 
	 * @return array
	 */
	public function assemble();

	/**
	 * Очистить состояние фильтра
	 */
	public function reset();

}