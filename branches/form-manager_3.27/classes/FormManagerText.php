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
class FormManagerText extends FormManagerElement {
	

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @param string $name
	 * @param array $params
	 * @throws InvalidArgumentException
	 * @return FormManagerElement
	 */
	public function setFilter($name, $params=null){
		if ($name=='length' && (isset($params['max']) || isset($params['eq'])))
			$this->setViewParams(array(
				'length' => isset($params['max']) ? $params['max'] : $params['eq']
			));
		
		return parent::setFilter($name, $params);
	}

}