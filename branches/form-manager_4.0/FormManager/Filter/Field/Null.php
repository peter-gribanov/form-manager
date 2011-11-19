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
 * Фильтра проверки на Null
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Null extends FormManager_Filter_Field_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		// FIXME поле options отсюда недоступно  
		if (!is_bool($this->field->options['default']) && $this->field->getSentValue() === null ) {
			$this->trigger('null);
		}
	}

}