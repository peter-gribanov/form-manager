<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision$
 * @since     $Date$
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Валидатор даты
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Date extends FormManager_Filter_Abstract {

	/**
	 * Регулярка для разюора формата даты
	 * 
	 * Формат по умолчанию YYYY-MM-DD
	 * 
	 * @var integer
	 */
	private $format = '/^([1-2]\d{3})-([0-1]?\d)-([0-3]?\d)$/';

	/**
	 * Конструктор
	 * 
	 * @param string $format Формат даты
	 */
	public function __construct($format = 'YYYY-MM-DD') {
		if (!empty($format) && $format != 'YYYY-MM-DD'
			&& substr_count($format, 'DD') == 1 && substr_count($format, 'MM') == 1
			&& (substr_count($format, 'YY') == 1 || substr_count($format, 'YYYY') == 1)) {

			$format = preg_quote($format);
			$format = str_replace(array(
				'DD','MM','YYYY','YY'
			), array(
				'([0-3]?\d)',
				'([0-1]?\d)',
				'([1-2]\d{3})',
				'(\d{2})'
			), $format);
			$this->format = '/^'.$format.'$/';
		}
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
		if (!empty($value)) {
			if (!preg_match($this->format, $value, $matches)) {
					$this->addError('date');
			} else {
				if ($matches[2] > 12) {
					$this->addError('date');
				}
				if ($matches[3] > 31) {
					$this->addError('date');
				}
				if (!checkdate($matches[2], $matches[3], $matches[1])) {
					$this->addError('date');
				}
			}
		}
		return $value;
	}

}