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
class FormManager_Filter_Field_Data extends FormManager_Filter_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		// @todo формат даты может измениться и это надо учитывать
		if ( $this->field->getValue() != '' && !preg_match('/^\d\d\.\d\d\.\d{4}$/', $this->field->getValue()) ) {
			$this->trigger('date');
		}
	}

}