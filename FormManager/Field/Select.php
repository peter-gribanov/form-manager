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
 * Класс описывает элемент ввода формы
 * 
 * @package FormManager\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Field_Select extends FormManager_Field_Abstract {

	/**
	 * Конструктор
	 */
	public function __construct() {
		parent::__construct();
		// TODO реализовать базовую инициализацию элемента
	}

	/**
	 * Устанавливает параметры вывода
	 * 
	 * @throws FormManager_Exceptions_Field
	 * 
	 * @param array $params
	 * 
	 * @return FormManager_Field_Select
	 *//*
	public function setViewParams($params = array()) {
		// установка ключа
		if (!isset($this->options['view'][1]['use_key'])) {
			$this->options['view'][1]['use_key'] = isset($params['use_key']) ? $params['use_key'] : false;
		}

		// заполнить опции интервалом чисел
		if (isset($params['optionsByRange'])) {
			if (!is_array($params['optionsByRange'])) {
				throw new FormManager_Exceptions_Field('Range is not an array');
			}
			if (count($params['optionsByRange']) < 2) {
				throw new FormManager_Exceptions_Field('Range shall consist of a start and end values');
			}

			$params['options'] = range($params['optionsByRange'][0], $params['optionsByRange'][1]);
			$this->options['view'][1]['use_key'] = false;
			unset($params['optionsByRange']);
		}

		return parent::setViewParams($params);
	}*/

}