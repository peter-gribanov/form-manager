<?php

/**
 * Класс исключений для фильтров
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormFilterException extends Exception {

	/**
	 * Объект поля формы
	 * 
	 * @var FormManagerElement
	 */
	private $element;

	/**
	 * Параметры фильтра
	 * 
	 * @var array
	 */
	private $filter;


	/**
	 * Конструктор
	 * 
	 * @param string $message
	 * @param FormManagerElement $element
	 * @param array $filter
	 * @return void
	 */
	public function __construct($message, FormManagerElement & $element, & $filter){
		parent::__construct($message, 0);
		$this->element = & $element;
		$this->filter = & $filter;
	}

	/**
	 * Возвращает объект поля формы
	 * 
	 * @return FormManagerElement
	 */
	public function getElement(){
		return $this->element;
	}

	/**
	 * Возвращает имя фильтра
	 * 
	 * @return string
	 */
	public function getFilterName(){
		return $this->filter[0];
	}

	/**
	 * Возвращает параметры фильтра
	 * 
	 * @return array
	 */
	public function getFilterParams(){
		return $this->filter[1];
	}

}