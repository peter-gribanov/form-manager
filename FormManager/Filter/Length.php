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
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Length extends FormManager_Filter_Abstract {

	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param FormManager_Model_Field_Interface $field   Объект поля
	 * @param array                             $options Параметры фильтра
	 */
	public function __construct(FormManager_Model_Field_Interface $field, array $options = array()) {
		parent::__construct($field, array_merge(
			array(
				'min' => 0,
				'max' => 0,
				'eq'  => 0
			),
			$options
		));
	}

	/**
	 * Проверяет поле
	 */
	public function check(){
		$len = strlen($this->field->getValue());

		if ($params['min'] && $params['max'] && $params['min'] == $params['max']) {
			$params['eq'] = $params['max'];
		}

		if ($params['eq'] && $len != $params['eq']) {
			$this->trigger('length.eq', array($params['eq']));

		} elseif ($params['min'] && $params['max'] && ($len < $params['min'] || $len > $params['max'])) {
			$this->trigger('length', array($params['min'], $params['max']));

		} elseif ($params['min'] && $len < $params['min']) {
			$this->trigger('length.min', array($params['min']));

		} elseif ($params['max'] && $len > $params['max']) {
			$this->trigger('length.max', array($params['max']));
		}
	}

}