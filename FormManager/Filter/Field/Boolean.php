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
 * Фильтра проверки на Boolean
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Boolean extends FormManager_Filter_Field_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		if (!is_bool($this->field->getValue())
			&& (!is_numeric($this->field->getValue())
				|| ($this->field->getValue() != 0 && $this->field->getValue() != 1))) {

			$param = $this->field->getViewParams();

			if (!empty($this->options['value_no']) && !empty($this->options['value_yes'])) {
				$this->trigger('boolean', array('('.$this->options['value_no'].', '.$this->options['value_yes'].')'));
			} else {
				$this->trigger('boolean', array(''));
			}
		}
	}

}