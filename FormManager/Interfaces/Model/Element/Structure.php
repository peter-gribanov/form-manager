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
 * Интерфейс модели элемента формулирующая композиционную структуру
 * 
 * @package FormManager\Interfaces\Element
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Element_Structure extends IteratorAggregate {

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Interfaces_Model_Element $element
	 * 
	 * @return FormManager_Interfaces_Model_Element
	 */
	public function add(FormManager_Interfaces_Model_Element $element);

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 * 
	 * @param string $query
	 */
	public function addByQuery($query);

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Interfaces_Model_Element $element
	 */
	public function setParent(FormManager_Interfaces_Model_Element $element);

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Interfaces_Model_Element
	 */
	public function getParent();

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Interfaces_Model_Element $element
	 */
	public function setRoot(FormManager_Interfaces_Model_Element $element);

	/**
	 * TODO добавить описание
	 * 
	 * @return array
	 */
	public function getChilds();

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return FormManager_Interfaces_Model_Element|boolean
	 */
	public function getChild($name);

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function isAdded($name);

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function remove($name);

	/**
	 * Очищает список элементов
	 */
	public function clear();

	/**
	 * Проверяет пуста ли коллекция
	 * 
	 * @return boolean
	 */
	public function isEmpty();

}