<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.27 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager/3.27/
 * @copyright	(c) 2009 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerSelect extends FormManagerElement {

	/**
	 * Устанавливает параметры вывода
	 * 
	 * @param	string	$param		Идентификатор параметра
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setViewParams($params=array()){
		// установка ключа
		if (!isset($this->options['view'][1]['use_key']))
			$this->options['view'][1]['use_key'] = isset($params['use_key']) ? $params['use_key'] : false;

		// заполнить опции интервалом чисел
		if (isset($params['optionsByRange'])){
			if (!is_array($params['optionsByRange']))
				throw new InvalidArgumentException('Range is not an array');
			if (count($params['optionsByRange'])<2)
				throw new InvalidArgumentException('Range shall consist of a start and end values');

			$params['options'] = range($params['optionsByRange'][0], $params['optionsByRange'][1]);
			$this->options['view'][1]['use_key'] = false;
		}

		// заполнить опции из sql запроса
		if (isset($params['optionsByQuery'])){
			if (!is_string($params['optionsByQuery']))
				throw new InvalidArgumentException('SQL request is not a string.');

			$db = FormManagerDB::prepare($params['optionsByQuery']);

			$params['options'] = array();

			while ($option=$db->fetch())
				$params['options'][$option->key] = $this->options['view'][1]['use_key'] ? $option->value : $option->key;
		}

		return parent::setViewParams($params);
	}

	/**
	 * Метод для десериализации класса
	 *
	 * @param	string	$data		Сериализованый объект
	 * @return	FormManagerSelect	Объект элемента
	 */
	public function unserialize($data){
		parent::unserialize($data);
		$this->setViewParams($this->options['view'][1]);
		return $this;
	}

}