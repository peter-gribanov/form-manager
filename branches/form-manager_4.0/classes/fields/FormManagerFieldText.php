<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager_4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerFieldText extends FormManagerElement {
	

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @param	string	$name	Имя фильтра
	 * @param	array	$params	Параметры фильтра
	 * @throws	InvalidArgumentException
	 * @return	FormManagerElement
	 */
	public function setFilter($name, $params=null){
		if ($name=='length' && (isset($params['max']) || isset($params['eq'])))
			$this->setViewParams(array(
				'length' => isset($params['max']) ? $params['max'] : $params['eq']
			));
		
		return parent::setFilter($name, $params);
	}

}