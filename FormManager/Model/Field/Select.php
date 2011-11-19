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
 * @package FormManager\Model\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Field_Select extends FormManager_Model_Field_Abstract {

	/**
	 * Устанавливает параметры вывода
	 * 
	 * @param array $params
	 * 
	 * @return FormManager_Model_Field_Select
	 */
	public function setViewParams($params = array()) {
		// установка ключа
		if ( !isset($this->options['view'][1]['use_key']) ) {
			$this->options['view'][1]['use_key'] = isset($params['use_key']) ? $params['use_key'] : false;
		}

		// заполнить опции интервалом чисел
		if ( isset($params['optionsByRange']) ) {
			if ( !is_array($params['optionsByRange']) ) {
				throw new InvalidArgumentException('Range is not an array');
			}
			if ( count($params['optionsByRange']) < 2 ) {
				throw new InvalidArgumentException('Range shall consist of a start and end values');
			}

			$params['options'] = range($params['optionsByRange'][0], $params['optionsByRange'][1]);
			$this->options['view'][1]['use_key'] = false;
		}

		// заполнить опции из sql запроса
		if ( isset($params['optionsByQuery']) ) {
			if ( !is_string($params['optionsByQuery']) ) {
				throw new InvalidArgumentException('SQL request is not a string.');
			}

			$db = FormManagerDB::prepare($params['optionsByQuery']);

			$params['options'] = array();

			while ( $option=$db->fetch() ) {
				$params['options'][$option->key] = $this->options['view'][1]['use_key'] ? $option->value : $option->key;
			}
		}

		return parent::setViewParams($params);
	}

	/**
	 * Метод для десериализации класса
	 *
	 * @param string $data
	 * 
	 * @return FormManager_Model_Field_Select
	 */
	public function unserialize($data) {
		parent::unserialize($data);
		$this->setViewParams($this->options['view'][1]);
		return $this;
	}

}