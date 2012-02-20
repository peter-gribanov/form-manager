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
 * @package FormManager\Element
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Element_Interface extends Serializable {

	/**
	 * Получить значение элемента.
	 * 
	 * @return mixed
	 */
	public function getValue();

	/**
	 * Установить значение элемента.
	 *
	 * @param mixed $value TODO добавить описание параметра
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function setValue($value);

	/**
	 * Получить значение элемента по умолчанию
	 *
	 * @param boolean $filtred TODO добавить описание параметра
	 *
	 * @return mixed
	 */
	public function getDefaultValue($filtred = true);

	/**
	 * Установить значение по умолчанию
	 *
	 * @param mixed $value TODO добавить описание параметра
	 *
	 * @return FormManager_Element_Interface
	 */
	public function setDefaultValue($value);

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Collection_Interface $parent TODO добавить описание параметра
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function setParent(FormManager_Collection_Interface $parent);

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Collection_Interface
	 */
	public function getParent();

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Collection_Interface
	 */
	public function getRoot();

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @param FormManager_Filter_Interface $filter Объект фильтра
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function addFilter(FormManager_Filter_Interface $filter);

	/**
	 * Устанавливает фильтры для поля
	 * 
	 * @param array $filters Список фильтров
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function addFilters(array $filters = array());

	/**
	 * Добавляет декоратор
	 * 
	 * @param string $name  Название
	 * @param mixid  $value Значение
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function addDecorator($name, $value);

	/**
	 * Возвращает декоратор для указанного названия
	 * 
	 * @param string $name Название
	 * 
	 * @return string
	 */
	public function getDecorator($name);

	/**
	 * Проверяет на валидность элемент
	 * 
	 * @return boolean
	 */
	public function isValid();

	/**
	 * Определяет изменено ли поле
	 * 
	 * @return boolean
	 */
	public function isChanged();

	/**
	 * Получить сообщения об ошибках
	 *
	 * @return array
	 */
	public function getErrors();

	/**
	 * Получить сообщения об замечаниях
	 *
	 * @return array
	 */
	public function getNotices();

	/**
	 * Устанавливает имя элемента
	 * 
	 * @param string $name Имя элемента
	 */
	public function setName($name);

	/**
	 * Возвращает имя элемента
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * Получить полное имя элемента
	 *
	 * Полное имя элемента которое будет использоваться на форме,
	 * оно строиться на основе имен предков
	 * 
	 * @return string
	 */
	public function getFormName();

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function assemble();

}