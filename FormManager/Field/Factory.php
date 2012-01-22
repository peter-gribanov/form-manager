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
final class FormManager_Field_Factory extends FormManager_Loader {

	/**
	 * Конструктор
	 * 
	 * Устанавливающий адрес класса и коментарий для метода
	 */
	public function __construct() {
		$this->setClassFile(__FILE__);
		$this->setMethodComment('Возвращает поле %s');
	}

	/**
	 * Возвращает новый элимент формы
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $type Тип поля
	 * 
	 * @return FormManager_Field_Interface
	 */
	public function get($type = 'Text'){
		$field = parent::get('FormManager_Field_'.$type);
		if (!($field instanceof FormManager_Field_Interface)) {
			throw new FormManager_Exceptions_ObjectType('Не удалось найти указанный тип поля: '.$type, 1002);
		}
		return $field;
	}

}