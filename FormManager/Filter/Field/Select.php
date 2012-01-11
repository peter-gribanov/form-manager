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
 * Фильтра проверки на длинну строки
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Length extends FormManager_Filter_Field_Abstract {

	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param array $options Параметры фильтра
	 */
	public function __construct(array $options = array()) {
		parent::__construct(array_merge(
			array(
				'use_key'	=> false,
				'options'	=> array(),
				'multiple'	=> false,
			),
			$options
		));
	}

	/**
	 * Проверяет поле
	 */
	public function check(){
		if ($this->options['use_key']) {
			$values = array_keys($this->options['options']);
		} else {
			$values = array_values($this->options['options']);
		}

		if ($this->options['multiple']) {
			foreach ($this->element->getValue() as $value) {
				if (!in_array($value, $values)) {
					$this->trigger('select');
				}
			}

		} elseif (!in_array($this->element->getValue(), $values)) {
			$this->trigger('select');
		}
	}

}