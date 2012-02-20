<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 120 $
 * @since     $Date: 2011-12-15 08:31:54 +0400 (Thu, 15 Dec 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Интерфейс модели коллекции элиментов
 * 
 * @package FormManager\Collection
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Collection_Interface extends FormManager_Element_Interface, Countable, IteratorAggregate {

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Element_Interface $element
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function addChild(FormManager_Element_Interface $element);

	/**
	 * Добавляет в коллекцию список элементов
	 * 
	 * @param array $childs Список элементов
	 * 
	 * @return FormManager_Element_Factory
	 */
	public function addChilds(array $childs = array());

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return FormManager_Element_Interface|boolean
	 */
	public function getChild($name);

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function remove($name);

	/**
	 * Волшебная функция для реализации $obj->value
	 * 
	 * @param string $name TODO добавить описание параметра
	 * 
	 * @return FormManager_Element_Interface|null
	 */
	public function __get($name);

	/**
	 * Изменение данных
	 * 
	 * @param string                        $name    TODO добавить описание параметра
	 * @param FormManager_Element_Interface $element TODO добавить описание параметра
	 */
	public function __set($name, FormManager_Element_Interface $element);

	/**
	 * Поддержка isset()
	 * 
	 * @param string $name TODO добавить описание параметра
	 * 
	 * @return boolean
	 */
	public function __isset($name);

}