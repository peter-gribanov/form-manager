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
final class FormManager_Model_Collection_Factory {

	/**
	 * Возвращает новую коллекцию элиментов формы
	 * 
	 * @param string $method Вызываемый метод
	 * @param array  $args   Параметры метода
	 * 
	 * @return FormManager_Interfaces_Model_Collection
	 */
	public function __call($method, $args) {
		$obj = $this->get($method);
		// TODO реализовать добавление метода в класс
		// TODO проверять имя на ключевые слова http://www.php.net/manual/en/reserved.keywords.php
		//trigger_error('Call to undefined method '.__CLASS__.'::'.$method.'()', E_USER_ERROR);
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
		try {
			$collection = new $class_name();
		} catch (Cms_AutoLoad_Exception $exeption) {
			$collection = null;
		}
		if (!(($collection instanceof $class_name) || ($collection instanceof FormManager_Model_Element))) {
			throw new FormManager_Exceptions_Filter('Не удалось найти указанный тип коллекции: '.$type, 1001);
		}
		return $collection;
	}

	/**
	 * Создает коллекцию Nested
	 * 
	 * @return FormManager_Model_Collection_Nested
	 */
	public function Nested(){
		return $this->get('Nested');
	}

	/**
	 * Создает коллекцию Fieldset
	 * 
	 * @return FormManager_Model_Collection_Fieldset
	 */
	public function Fieldset(){
		return $this->get('Fieldset');
	}

	/**
	 * Создает коллекцию Related
	 * 
	 * @return FormManager_Model_Collection_Related
	 */
	public function Related(){
		return $this->get('Related');
	}

}