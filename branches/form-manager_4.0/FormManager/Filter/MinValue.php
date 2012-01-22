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
 * Валидатор минимального значения
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_MinValue extends FormManager_Filter_Abstract {

	/**
	 * Минимальное значение
	 * 
	 * @var integer
	 */
	private $min = 0;

	/**
	 * Конструктор
	 *
	 * @param integer $min Минимальное значение
	 */
	public function __construct($min) {
		$this->min = $min;
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
		if (!empty($value) && $value < $this->min) {
			$this->addError('beyond_min', array('min' => $this->min));
		}
		return $value;
	}

}