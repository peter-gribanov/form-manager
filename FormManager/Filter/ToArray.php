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
 * Фильтра массива
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_ToArray extends FormManager_Filter_Abstract {

	/**
	 * Фильтровать и проверить ненадёжные данные и возвращает результат
	 * 
	 * @param mixed                         $value   Проверяемые данные
	 * @param FormManager_Element_Interface $element Проверяемый елемент
	 * 
	 * @return mixed Отфильтрованное $value
	 */
	public function exec($value, FormManager_Element_Interface $element) {
		if (is_array($value)) {
			return $value;
		}
		return null;
	}

}