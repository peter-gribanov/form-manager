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
	 * Фабрика
	 * 
	 * @var FormManager_Filter_Factory|null
	 */
	private static $instance = null;


	/**
	 * Возвращает экзкмпляр фабрики
	 * 
	 * @return FormManager_Filter_Factory
	 */
	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Фильтер строки
	 * 
	 * @return FormManager_Filter_ToString
	 */
	public function ToString() {
		return new FormManager_Filter_ToString();
	}

	/**
	 * Фильтра проверки на Null
	 * 
	 * @return FormManager_Filter_NotNull
	 */
	public function NotNull() {
		return new FormManager_Filter_NotNull();
	}

	/**
	 * Фильтра проверки на длинну строки
	 * 
	 * @param array $values Список значений
	 * 
	 * @return FormManager_Filter_InArray
	 */
	public function InArray(array $values = array()) {
		return new FormManager_Filter_InArray($values);
	}

	/**
	 * Фильтер для очистки строки
	 * 
	 * @param string $charlist Дополнительные параметры очистки
	 * 
	 * @return FormManager_Filter_String_Trim
	 */
	public function String_Trim($charlist = '') {
		return new FormManager_Filter_String_Trim($charlist);
	}

	/**
	 * Валидатор длинны значения
	 * 
	 * @param integer $min Минимальная длинна
	 * @param integer $max Максимальная длинна
	 * 
	 * @return FormManager_Filter_Length
	 */
	public function Length($min = 0, $max = 0) {
		return new FormManager_Filter_Length($min, $max);
	}

}