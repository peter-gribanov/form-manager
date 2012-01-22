<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 207 $
 * @since     $Date: 2012-01-12 02:17:09 +0400 (Thu, 12 Jan 2012) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Валидатор диапазона
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_RangeValue extends FormManager_Filter_Abstract {

	/**
	 * Начальная позиция
	 * 
	 * @var integer
	 */
	private $from = 0;

	/**
	 * Конечная позиция
	 * 
	 * @var integer
	 */
	private $to = 0;


	/**
	 * Конструктор
	 *
	 * @param integer $from Начальная позиция
	 * @param integer $to   Конечная позиция
	 */
	public function __construct($from, $to) {
		$this->from = $from;
		$this->to = $to;
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
		if (!empty($value) && is_numeric($value) && ($value < $this->from || $value > $this->to)) {
			$this->addError('invalid_range', array('from' => $this->from, 'to' => $this->to));
		}
		return $value;
	}

}