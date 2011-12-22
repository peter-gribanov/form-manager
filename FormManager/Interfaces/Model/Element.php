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
 * Интерфейс модели элемента
 * 
 * @package FormManager\Interfaces\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Element extends IteratorAggregate, FormManager_Interfaces_Model {

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

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 */
	public function setName($name);

	/**
	 * TODO добавить описание
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * TODO добавить описание
	 * 
	 * @return array
	 */
	public function getNamesList();

	/**
	 * TODO добавить описание
	 * 
	 * @param string $comment
	 */
	public function setComment($comment);

	/**
	 * TODO добавить описание
	 * 
	 * @param string $title
	 */
	public function setTitle($title);

	/**
	 * Устанавливает флаг что есть поля обязательные для заполнения
	 */
	public function required();

	/**
	 * Проверяет есть ли поля обязательные для заполнения
	 * 
	 * @return boolean
	 */
	public function isRequired();

}