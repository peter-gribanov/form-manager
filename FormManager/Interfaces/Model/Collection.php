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
 * @package FormManager\Interfaces\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Collection extends FormManager_Interfaces_Model_Collection_Item {

	/**
	 * Устанавливает название коллекции
	 * 
	 * @param string $name Название коллекции
	 * 
	 * @return FormManager_Interfaces_Model_Collection Объект коллекции
	 */
//	public function setName($name);

	/**
	 * Возвращает название коллекции
	 * 
	 * @return string
	 */
//	public function getName();

	/**
	 * Добавляет элемент
	 * 
	 * @param FormManager_Interfaces_Model_Collection_Item $item Объект элимента
	 * 
	 * @return FormManager_Interfaces_Model_Collection Объект коллекции
	 */
//	public function add(FormManager_Interfaces_Model_Collection_Item $item);

	/**
	 * Очищает список элементов
	 * 
	 * @return	FormManager_Interfaces_Model_Collection	Объект коллекции
	 */
//	public function clear();

	/**
	 * Проверяет пуста ли коллекция
	 * 
	 * @return	boolean	Результат проверки
	 */
//	public function isEmpty();

}