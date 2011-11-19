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
 * Интерфейс модели поля
 * 
 * @package FormManager\Model\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Model_Field_Interface extends FormManager_Model_Collection_Item_Interface {

	/**
	 * Устанавливает имя поля
	 * 
	 * @param string $name Имя
	 * 
	 * @return FormManager_Model_Field_Abstract Объект элемента
	 */
	public function setName($name);

	/**
	 * Возвращает имя поля
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * Устанавливает значение поля
	 * 
	 * @param string|integer|boolen $value
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setDefaultValue($value);

	/**
	 * Возвращает значение поля
	 * 
	 * @return string
	 */
	public function getDefaultValue();

	/**
	 * Возвращает значение поля
	 * 
	 * @return string
	 */
	public function getValue();

	/**
	 * Возвращает значение указанное пользователем
	 * 
	 * @return string
	 */
	public function &getSentValue();

	/**
	 * Устанавливает вид для поля
	 * 
	 * @param string $name
	 * @param array  $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setView($name, $params = null);

	/**
	 * Устанавливает параметры вывода
	 * 
	 * @param array $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setViewParams($params = array());

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @param string $name
	 * @param array  $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setFilter($name, $params = null);

	/**
	 * Устанавливает что поле является обязательным для заполнения
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function required();

	/**
	 * Проверяет является ли поле обязательным для заполнения
	 * 
	 * @return boolen
	 */
	public function isRequired();

}