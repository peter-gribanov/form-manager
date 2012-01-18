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
	 * Собирает результаты проверки
	 */
	public function assemble(){
		if (!is_bool($this->element->getValue())
			&& (!is_numeric($this->element->getValue())
				|| ($this->element->getValue() != 0 && $this->element->getValue() != 1))) {

			// FIXME метод FormManager_Element_Interface::setValue отсутствует. необходимо подумать над реализацией фильтрации
			// приведение типов
			$this->element->setValue((bool)$this->element->getValue());

			if (!empty($this->options['value_no']) && !empty($this->options['value_yes'])) {
				$this->addNotice('boolean-values', array(
					$this->options['value_no'],
					$this->options['value_yes']
				));
			} else {
				$this->addNotice('boolean');
			}
		}
		parent::assemble();
	}

}