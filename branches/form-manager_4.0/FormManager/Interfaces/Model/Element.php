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
 * @package FormManager\Interfaces
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Element extends FormManager_Interfaces_Model, IteratorAggregate {

	/**
	 * TODO добавить описание
	 * 
	 * @return Iterator
	 */
	public function getIterator();

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Model_Element $element
	 * 
	 * @return FormManager_Model_Element
	 */
	public function add(FormManager_Model_Element $element);

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 *
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $query
	 */
	public function addByQuery($query);

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param FormManager_Model_Element $element
	 */
	public function setParent(FormManager_Model_Element $element);

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Model_Element
	 */
	public function getParent();

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param FormManager_Model_Element $element
	 */
	public function setRoot(FormManager_Model_Element $element);

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
	 * @return FormManager_Model_Element|boolean
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
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
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
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $comment
	 */
	public function setComment($comment);

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $title
	 */
	public function setTitle($title);

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
	 * Устанавливает флаг что есть поля обязательные для заполнения
	 */
	public function required();

	/**
	 * Проверяет есть ли поля обязательные для заполнения
	 * 
	 * @return boolean
	 */
	public function isRequired();

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param string $name
	 * @param array  $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setFilter($name, $params = null);

	/**
	 * Метод для сериализации класса
	 * 
	 * @return string Сериализованная коллекция
	 */
	public function serialize();

	/**
	 * Метод для десериализации класса
	 * 
	 * @param string $data Сериализованная коллекция
	 */
	public function unserialize($data);

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export();

}