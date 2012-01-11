<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 199 $
 * @since     $Date: 2012-01-11 23:12:13 +0400 (Wed, 11 Jan 2012) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Фильтра проверки на String
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_String extends FormManager_Filter_Field_Abstract {

	/**
	 * Проверяет елемент
	 */
	protected function check(){
		if (!is_string($this->element->getValue())) {
			$this->getMessage('string');
		}
	}

}