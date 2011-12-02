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
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Field_Factory {

	/**
	 * Возвращает новый элимент формы
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Model_Field_Interface
	 */
	public function __call($field_name) {
		$obj = $this->get($field_name);
		// TODO реализовать добавление метода в класс
		return $obj;
	}

	/**
	 * Возвращает новый элимент формы
	 * 
	 * @throws FormManager_Model_Field_Exception
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Model_Field_Interface
	 */
	public static function get($field_name = 'Base'){
		$class_name = 'FormManager_Model_Field_'.$field_name;
		$obj = new $class_name();
		if (!($obj instanceof FormManager_Model_Field_Interface)) {
			throw new FormManager_Model_Field_Exception('', 1002);
		}
		return $obj;
	}

	/**
	 * Создает поле Base
	 * 
	 * @return FormManager_Model_Field_Base
	 */
	public function Base(){
		return new FormManager_Model_Field_Base();
	}

	/**
	 * Создает поле Hidden
	 * 
	 * @return FormManager_Model_Field_Hidden
	 */
	public function Hidden(){
		return new FormManager_Model_Field_Hidden();
	}

	/**
	 * Создает поле Radio
	 * 
	 * @return FormManager_Model_Field_Radio
	 */
	public function Radio(){
		return new FormManager_Model_Field_Radio();
	}

	/**
	 * Создает поле Select
	 * 
	 * @return FormManager_Model_Field_Select
	 */
	public function Select(){
		return new FormManager_Model_Field_Select();
	}

	/**
	 * Создает поле Text
	 * 
	 * @return FormManager_Model_Field_Text
	 */
	public function Text(){
		return new FormManager_Model_Field_Text();
	}

}