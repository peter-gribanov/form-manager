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
final class FormManager_Filter_Factory extends FormManager_Loader {

	/**
	 * Конструктор
	 * 
	 * Устанавливающий адрес класса и коментарий для метода
	 */
	public function __construct() {
		$this->setClassFile(__FILE__);
		$this->setMethodComment('Возвращает фильтр %s');
	}

	/**
	 * Возвращает новый фильтр
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $type Тип поля
	 * 
	 * @return FormManager_Filter_Interface
	 */
	public function get($type){
		$filter = parent::get('FormManager_Filter_'.$type);
		if (!($filter instanceof FormManager_Filter_Interface)) {
			throw new FormManager_Exceptions_ObjectType('Не удалось найти указанный тип фильтра: '.$type, 302);
		}
		return $filter;
	}

}