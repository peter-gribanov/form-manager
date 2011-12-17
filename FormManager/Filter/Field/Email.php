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
 * Фильтра проверки формата e-mail адреса
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Email extends FormManager_Filter_Field_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		// Check for @ symbol
		if (substr_count($this->element->getValue(), '@') != 1) {
			$this->trigger('email');
		// Check Filter
		} elseif (function_exists('filter_var') && !filter_var($this->element->getValue(), FILTER_VALIDATE_EMAIL)) {
			$this->trigger('email');
		// Check RegExp
		} elseif (!preg_match('/^(?:[-a-z0-9])+@(?:[-a-z0-9]{2,}\.)+(?:[a-z]{2,4}|[0-9]{1,4})$/i', $this->element->getValue())) {
			$this->trigger('email');
		}
	}

}