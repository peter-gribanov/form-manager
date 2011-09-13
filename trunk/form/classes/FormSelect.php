<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @package	Form
 * @author	Peter Gribanov
 * @since	07.09.2011
 * @version	1.0
 */
class FormSelect extends FormElement {

	/**
	 * Устанавливает параметры вывода
	 * 
	 * @param array $params
	 * @return FormSelect
	 */
	public function setViewParams($params=array()){
		if (!isset($this->options['view'][1]['use_key']))
			$this->options['view'][1]['use_key'] = isset($params['use_key']) ? $params['use_key'] : true;

		if (isset($params['optionsByQuery'])){
			$db = FormDB::prepare($params['optionsByQuery']);

			$params['options'] = array();

			while ($option=$db->fetch())
				$params['options'][$option->key] = $this->options['view'][1]['use_key'] ? $option->key : $option->value;
		}

		return parent::setViewParams($params);
	}

	/**
	 * Метод для десериализации класса
	 *
	 * @param string $data
	 * @return FormSelect
	 */
	public function unserialize($data){
		parent::unserialize($data);
		$this->setViewParams($this->options['view'][1]);
		return $this;
	}

}