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
 * Валидатор длинны значения
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Length extends FormManager_Filter_Abstract {

	/**
	 * Минимальная длинна
	 *
	 * @var integer
	 */
	private $min = 0;

	/**
	 * Максимальная длинна
	 * 
	 * @var integer
	 */
	private $max = 0;


	/**
	 * Конструктор
	 * 
	 * @param integer $min Минимальная длинна
	 * @param integer $max Максимальная длинна
	 */
	public function __construct($min = 0, $max = 0) {
		if ($min > $max) {
			trigger_error('Filter "Length" config errorr: Min > Max', E_USER_ERROR);
		}
		$this->min = $min;
		$this->max = $max;
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
		$length = strlen($value);
		if ($this->min && $this->max && $this->min == $this->max && $length != $this->max) {
			$this->addError('length_equal', array('value' => $value, 'equal' => $this->max));

		} elseif ($this->min && $this->max && ($length < $this->min || $length > $this->max)) {
			$this->trigger('length', array('value' => $value, 'min' => $this->min, 'max' => $this->max));

		} elseif ($length < $this->min) {
			$this->addError('length_min', array('value' => $value, 'min' => $this->min));

		} elseif ($this->max && $length > $this->max) {
			$this->addError('length_max', array('value' => $value, 'max' => $this->max));
		}
		return $value;
	}

	/**
	 * Собирает результаты проверки
	 * 
	 * @see FormManager_Filter_Abstract::assemble
	 * 
	 * @return array {errors:[],notices:[],min:integer,max:integer}
	 */
	public function assemble(){
		return array_merge(
			parent::assemble(),
			array(
				'min'   => $this->min,
				'max'   => $this->max
			)
		);
	}

}