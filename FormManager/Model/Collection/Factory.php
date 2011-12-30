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
 * @package FormManager\Model\Collection
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Model_Collection_Factory extends FormManager_Loader {

	/**
	 * Конструктор
	 * 
	 * Устанавливающий адрес класса и коментарий для метода
	 */
	public function __construct() {
		$this->setClassFile(__FILE__);
		$this->setMethodComment('Возвращает коллекцию %s');
	}

	/**
	 * Возвращает новую коллекцию элиментов формы
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $type Тип коллекции
	 * 
	 * @return FormManager_Model_Collection_Interface
	 */
	public function get($type = 'Base'){
		$collection = parent::get('FormManager_Model_Collection_'.$type);
		if (!($collection instanceof $class_name)) {
			throw new FormManager_Exceptions_ObjectType('Не удалось найти указанный тип коллекции: '.$type, 1001);
		}
		return $collection;
	}

	/**
	 * Возвращает коллекцию Nested
	 * 
	 * @return FormManager_Model_Collection_Nested
	 */
	public function Nested(){
		return $this->get('Nested');
	}

	/**
	 * Возвращает коллекцию Fieldset
	 * 
	 * @return FormManager_Model_Collection_Fieldset
	 */
	public function Fieldset(){
		return $this->get('Fieldset');
	}

	/**
	 * Возвращает коллекцию Related
	 * 
	 * @return FormManager_Model_Collection_Related
	 */
	public function Related(){
		return $this->get('Related');
	}

}