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
 * Фабрика фильтров
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Filter_Factory {

	/**
	 * Возвращает новый фильтр
	 * 
	 * @param string $method Вызываемый метод
	 * 
	 * @return FormManager_Interfaces_Filter
	 */
	public function __call($method) {
		$obj = $this->get($method);
		// TODO реализовать добавление метода в класс
		return $obj;
	}

	/**
	 * Возвращает новый фильтр
	 * 
	 * @throws FormManager_Exceptions_Filter
	 * 
	 * @param string $type Тип поля
	 * 
	 * @return FormManager_Interfaces_Filter
	 */
	public function get($type = 'Base'){
		$class_name = 'FormManager_Filter_'.$type;
		$obj = new $class_name();
		if (!($obj instanceof FormManager_Interfaces_Filter)) {
			throw new FormManager_Exceptions_Filter('', 302);
		}
		return $obj;
	}

}