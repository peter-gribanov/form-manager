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
	 * @param array  $args   Параметры метода
	 * 
	 * @return FormManager_Interfaces_Filter
	 */
	public function __call($method, $args) {
		$obj = $this->get($method);
		// TODO реализовать добавление метода в класс
		// TODO проверять имя на ключевые слова http://www.php.net/manual/en/reserved.keywords.php
		//trigger_error('Call to undefined method '.__CLASS__.'::'.$method.'()', E_USER_ERROR);
		return $obj;
	}

	/**
	 * Возвращает новый фильтр
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $type Тип поля
	 * 
	 * @return FormManager_Interfaces_Filter
	 */
	public function get($type){
		$class_name = 'FormManager_Filter_'.$type;
		try {
			$filter = new $class_name();
		} catch (Cms_AutoLoad_Exception $exeption) {
			$filter = null;
		}
		if (!(($filter instanceof $class_name) || ($filter instanceof FormManager_Interfaces_Filter))) {
			throw new FormManager_Exceptions_ObjectType('Не удалось найти указанный тип фильтра: '.$type, 302);
		}
		return $filter;
	}

	/**
	 * Создает поле Referer
	 * 
	 * @return FormManager_Filter_Referer
	 */
	public function Referer(){
		return $this->get('Referer');
	}

	/**
	 * Создает поле Bool
	 * 
	 * @return FormManager_Filter_Bool
	 */
	public function Bool(){
		return $this->get('Bool');
	}

	/**
	 * Создает поле Boolean
	 * 
	 * @return FormManager_Filter_Boolean
	 */
	public function Boolean(){
		return $this->get('Boolean');
	}

	/**
	 * Создает поле Date
	 * 
	 * @return FormManager_Filter_Date
	 */
	public function Date(){
		return $this->get('Date');
	}

	/**
	 * Создает поле Email
	 * 
	 * @return FormManager_Filter_Email
	 */
	public function Email(){
		return $this->get('Email');
	}

	/**
	 * Создает поле Empty
	 * 
	 * TODO недопустимое имя фильтра
	 * 
	 * @return FormManager_Filter_Empty
	 */
	public function _Empty(){
		return $this->get('Empty');
	}

	/**
	 * Создает поле Float
	 * 
	 * @return FormManager_Filter_Float
	 */
	public function Float(){
		return $this->get('Float');
	}

	/**
	 * Создает поле Int
	 * 
	 * @return FormManager_Filter_Int
	 */
	public function Int(){
		return $this->get('Int');
	}

	/**
	 * Создает поле Integer
	 * 
	 * @return FormManager_Filter_Integer
	 */
	public function Integer(){
		return $this->get('Integer');
	}

	/**
	 * Создает поле Length
	 * 
	 * @return FormManager_Filter_Length
	 */
	public function Length(){
		return $this->get('Length');
	}

	/**
	 * Создает поле Null
	 * 
	 * TODO недопустимое имя фильтра
	 * 
	 * @return FormManager_Filter_Null
	 */
	public function _Null(){
		return $this->get('Null');
	}

	/**
	 * Создает поле Select
	 * 
	 * @return FormManager_Filter_Select
	 */
	public function Select(){
		return $this->get('Select');
	}

}