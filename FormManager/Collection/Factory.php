<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 98 $
 * @since     $Date: 2011-11-22 23:49:26 +0400 (Вт., 22 нояб. 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Фабрика формы
 * 
 * @package FormManager\Collection
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Collection_Factory {

	/**
	 * Возвращает новую коллекцию элиментов формы
	 * 
	 * @param string $method Вызываемый метод
	 * 
	 * @return FormManager_Interfaces_Model_Collection
	 */
	public function __call($method) {
		$obj = $this->get($method);
		// TODO реализовать добавление метода в класс
		return $obj;
	}

	/**
	 * Возвращает новую коллекцию элиментов формы
	 * 
	 * @throws FormManager_Model_Collection_Exception
	 * 
	 * @param string $type Тип коллекции
	 * 
	 * @return FormManager_Interfaces_Model_Collection
	 */
	public function get($type = 'Base'){
		$class_name = 'FormManager_Model_Collection_'.$type;
		$obj = new $class_name();
		if (!($obj instanceof FormManager_Interfaces_Model_Collection)) {
			throw new FormManager_Model_Collection_Exception('', 1001);
		}
		return $obj;
	}

	/**
	 * Создает коллекцию Base
	 * 
	 * @return FormManager_Model_Collection_Base
	 */
	public function Base(){
		return new FormManager_Model_Collection_Base();
	}

	/**
	 * Создает коллекцию Nested
	 * 
	 * @return FormManager_Model_Collection_Nested
	 */
	public function Nested(){
		return new FormManager_Model_Collection_Nested();
	}

	/**
	 * Создает коллекцию Primary
	 * 
	 * @return FormManager_Model_Collection_Primary
	 */
	public function Primary(){
		return new FormManager_Model_Collection_Primary();
	}

}