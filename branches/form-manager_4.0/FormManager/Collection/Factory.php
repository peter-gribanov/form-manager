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
 * Фабрика коллекций
 * 
 * @package FormManager\Collection
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Collection_Factory {

	/**
	 * Возвращает новую коллекцию элиментов формы
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $type Тип коллекции
	 * 
	 * @return FormManager_Collection_Interface
	 */
	public function get($type = 'Base'){
		$collection = parent::get('FormManager_Collection_'.$type);
		if (!($collection instanceof $class_name)) {
			throw new FormManager_Exceptions_ObjectType('Не удалось найти указанный тип коллекции: '.$type, 1001);
		}
		return $collection;
	}

}