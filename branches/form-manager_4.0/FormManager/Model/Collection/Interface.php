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
 * Интерфейс коллекции полей
 * 
 * @package FormManager\Model\Collection
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Model_Collection_Interface extends FormManager_Model_Collection_Item_Interface {

	/**
	 * Устанавливает название коллекции
	 * 
	 * @throws FormManager_Model_Collection_Exception
	 * 
	 * @param string $name Название коллекции
	 * 
	 * @return FormManager_Model_Collection_Primary Объект коллекции
	 */
	public function setName($name);

	/**
	 * Возвращает название коллекции
	 * 
	 * @return	string
	 */
	public function getName();

	/**
	 * Добавляет элемент
	 * 
	 * @param FormManager_Model_Collection_Item_Interface $item Объект элимента
	 * 
	 * @return FormManager_Model_Collection_Primary Объект коллекции
	 */
	public function add(FormManager_Model_Collection_Item_Interface $item);

	/**
	 * Очищает список элементов
	 * 
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function clear();

	/**
	 * Проверяет пуста ли коллекция
	 * 
	 * @return	boolean	Результат проверки
	 */
	public function isEmpty();

}