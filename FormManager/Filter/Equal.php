<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 144 $
 * @since     $Date: 2011-12-17 23:55:27 +0400 (Sat, 17 Dec 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Валидатор не соответствие заданной строке
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Equal extends FormManager_Filter_Abstract {

	/**
	 * Ожидаемое значение
	 * 
	 * @var array|null
	 */
	private $equal_value = null;

	/**
	 * Возвращать к исходному значению в случае ошибки
	 *
	 * @var boolean
	 */
	private $on_error_reset = false;

	/**
	 * Конструктор
	 * 
	 * @param unknown_type $equal_value    Ожидаемое значение
	 * @param boolean      $on_error_reset Очищать при ошибке
	 */
	public function __construct($equal_value, $on_error_reset = false) {
		$this->equal_value = $equal_value;
		$this->on_error_reset = $on_error_reset;
	}

	/**
	 * Фильтровать и проверить ненадёжные данные и возвращает результат
	 * 
	 * @param mixed                         $value   Проверяемые данные
	 * @param FormManager_Element_Interface $element Проверяемый елемент
	 * 
	 * @return mixed Отфильтрованное $value
	 */
	public function exec($value, FormManager_Element_Interface $element) {
		if ($value === null) {
			return $value;
		}
		if ($value !== $this->equal_value) {
			$this->addError('not_equal');
			if ($this->on_error_reset) {
				$def_value = $element->getDefaultValue(false);
				$element->setValue($def_value);
				return $def_value;
			}
		}
		return $value;
	}

}