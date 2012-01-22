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
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Email extends FormManager_Filter_Abstract {

	/**
	 * Фильтровать и проверить ненадёжные данные и влзвращает результат
	 * 
	 * @param mixed                         $value   Проверяемые данные
	 * @param FormManager_Element_Interface $element Проверяемый елемент
	 * 
	 * @return mixed Отфильтрованное $value
	 */
	public function exec($value, FormManager_Element_Interface $element){
		if (empty($value)) {
			$this->addError('is_empty');
		// Check for @ symbol
		} elseif (substr_count($value, '@') != 1) {
			$this->addError('invalid_email');
		// Check Filter
		} elseif (function_exists('filter_var') && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$this->addError('invalid_email');
		// Check RegExp
		} elseif (!preg_match('/^(?:[-a-z0-9])+@(?:[-a-z0-9]{2,}\.)+(?:[a-z]{2,4}|[0-9]{1,4})$/i', $value)) {
			$this->addError('invalid_email');
		}
		return $value;
	}

}