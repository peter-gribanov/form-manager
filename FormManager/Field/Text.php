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
class FormManager_Field_Text extends FormManager_Field_String {

	/**
	 * Конструктор
	 */
	public function __construct() {
		parent::__construct();
		$this->setDecorator('template', 'text');
		// TODO реализовать базовую инициализацию элемента
	}

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @param string $name   Имя фильтра
	 * @param array  $params Параметры фильтра
	 * 
	 * @return FormManager_Field_Text
	 *//*
	public function setFilter($name, $params = null) {
		// TODO теперь подругому работает
		if ($name == 'length' && (isset($params['max']) || isset($params['eq']))) {
			$this->setViewParams(array(
				'length' => isset($params['max']) ? $params['max'] : $params['eq']
			));
		}
		return parent::setFilter($name, $params);
	}*/

}