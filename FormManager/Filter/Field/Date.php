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
 * Фильтра проверки формата даты
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Data extends FormManager_Filter_Field_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		if (isset($this->options['format']) && trim($this->options['format'])) {
			$format = trim($this->options['format']);
			if (substr_count($format, 'DD') == 1 && substr_count($format, 'MM')
				&& (substr_count($format, 'YY') == 1 || substr_count($format, 'YYYY'))) {

				$format = str_replace(array('DD','MM','YY'), '\d\d', $format);
				$format = str_replace('.', '\.', $format);
				$format = '/^'.$format.'$/';
			}
		} else {
			$format = '/^\d\d\.\d\d\.\d{4}$/'; // DD.MM.YYYY
		}
		if ($this->element->getValue() != '' && !preg_match($format, $this->element->getValue())) {
			$this->trigger('date');
		}
	}

}