<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 143 $
 * @since     $Date: 2011-12-17 23:49:21 +0400 (Sat, 17 Dec 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Валидатор времени
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Time extends FormManager_Filter_Abstract {

	/**
	 * Регулярка для разюора формата даты
	 * 
	 * Формат по умолчанию HH:MM
	 * 
	 * @var integer
	 */
	private $format = '/^([0-2]?\d):([0-5]?\d)$/';

	/**
	 * Конструктор
	 * 
	 * @param string $format Формат даты
	 */
	public function __construct($format = 'HH:MM') {
		if (!empty($format) && $format != 'HH:MM'
			&& substr_count($format, 'HH') == 1 && substr_count($format, 'MM') == 1) {

			$format = preg_quote($format);
			$format = str_replace(array(
				'HH','MM'
			), array(
				'([0-2]?\d)',
				'([0-5]?\d)'
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
				$this->addError('time');
			} else {
				if ($matches[1] > 23) {
					$this->addError('time');
				}
				if ($matches[2] > 59) {
					$this->addError('time');
				}
			}
		}
		return $value;
	}

}