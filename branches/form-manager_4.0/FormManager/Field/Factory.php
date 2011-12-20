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
 * @package FormManager\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Field_Factory {

	/**
	 * Возвращает новый элимент формы
	 * 
	 * @param string $method Вызываемый метод
	 * @param array  $args   Параметры метода
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
	public function __call($method, $args) {
		$obj = $this->get($method);
		// TODO реализовать добавление метода в класс
		// TODO проверять имя на ключевые слова http://www.php.net/manual/en/reserved.keywords.php
		//trigger_error('Call to undefined method '.__CLASS__.'::'.$method.'()', E_USER_ERROR);
		return $obj;
	}

	/**
	 * Возвращает новый элимент формы
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param string $type Тип поля
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
	public static function get($type = 'Text'){
		$class_name = 'FormManager_Model_Field_'.$type;
		try {
			$field = new $class_name();
		} catch (Cms_AutoLoad_Exception $exeption) {
			$field = null;
		}

		if (!(($field instanceof $class_name) || ($field instanceof FormManager_Interfaces_Model_Field))) {
			throw new FormManager_Exceptions_Model_Field('Не удалось найти указанный тип поля: '.$type, 1002);
		}

		return $field;
	}

	/**
	 * Создает поле Hidden
	 * 
	 * @return FormManager_Model_Field_Hidden
	 */
	public function Hidden(){
		return $this->get('Hidden');
	}

	/**
	 * Создает поле Radio
	 * 
	 * @return FormManager_Model_Field_Radio
	 */
	public function Radio(){
		return $this->get('Radio');
	}

	/**
	 * Создает поле Select
	 * 
	 * @return FormManager_Model_Field_Select
	 */
	public function Select(){
		return $this->get('Select');
	}

	/**
	 * Создает поле Text
	 * 
	 * @return FormManager_Model_Field_Text
	 */
	public function Text(){
		return $this->get('Text');
	}

}