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
 * Интерфейс модели элемента формулирующая функциональную часть элементов
 * 
 * @package FormManager\Interfaces\Model\Element
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Element_Functional extends FormManager_Interfaces_Model {

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @param FormManager_Interfaces_Filter $filter Объект фильтра
	 */
	public function setFilter(FormManager_Interfaces_Filter $filter);

	/**
	 * Добавляет декоратор
	 * 
	 * @param string $name  Название декораторв
	 * @param string $value Значение декоратора
	 */
//	public function setDecorator($name, $value = null);

	/**
	 * Возвращает декоратор для указанного названия
	 * 
	 * @param string $name
	 * 
	 * @return string
	 */
//	public function getDecorator($name);

	/**
	 * Проверяет на валидность элемент
	 * 
	 * @return boolean
	 */
//	public function isValid();

}