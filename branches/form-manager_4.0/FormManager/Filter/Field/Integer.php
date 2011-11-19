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
 * Фильтра проверки на Integer
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Integer extends FormManager_Filter_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		if (!is_numeric($this->field->getValue()) || (int)$this->field->getValue() != $this->field->getValue()) {
			$this->trigger('integer');
		}
	}

}