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
	 * Инициализированные модели
	 *
	 * @var array
	 */
//	private $models = array();

	/**
	 * Возвращает новый элимент формы
	 * 
	 * @param string $method Вызываемый метод
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
	public function __call($method) {
		$obj = $this->get($method);
		// TODO реализовать добавление метода в класс
		return $obj;
	}
/*
	protected function getCachedModel($name) {
		return (isset($this->models[$name]) ? $this->models[$name] : null);
	}*/

	/**
	 * Возвращает новый элимент формы
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param string $type Тип поля
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
	public static function get($type = 'Base'){
		$class_name = 'FormManager_Model_Field_'.$type;
		/*
		try {
			$model = new $class($db, $this, $this->factory->getEventDispatcher(), $this->cache);
			$this->models[$name] = $model;
		} catch (Cms_AutoLoad_Exception $exeption) {
			try {
				$model = new $classBase($db, $this, $this->factory->getEventDispatcher(), $this->cache);
				$this->models[$name] = $model;
			} catch (Cms_AutoLoad_Exception $exeption) {
				$model=null;
			}
		}

		if (! ( ($model instanceof $class) || ($model instanceof $classBase) ) ) {
			throw new Cms_Model_Exception("Не удалось найти указанную модель: '$name'.");
		}*/
		$obj = new $class_name();
		if (!($obj instanceof FormManager_Interfaces_Model_Field)) {
			throw new FormManager_Exceptions_Model_Field('', 1002);
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