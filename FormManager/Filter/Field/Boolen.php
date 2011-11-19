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
 * Фильтра проверки на Boolen
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Boolen extends FormManager_Filter_Field_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		if (!is_bool($this->field->getValue())
			&& (!is_numeric($this->field->getValue())
				|| ($field->getValue() != 0 && $this->getValue() != 1))) {

			$param = $this->field->getViewParams();

			if ( !empty($param['value_no']) && !empty($param['value_yes']) ) {
				$this->trigger('boolen', array('('.$param['value_no'].', '.$param['value_yes'].')'));
			} else {
				$this->trigger('boolen', array(''));
			}
		}
	}

}