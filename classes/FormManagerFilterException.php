<?php

/**
 * Класс исключений для фильтров
 * 
 * @package	FormManager
 * @author	Peter Gribanov
 * @since	25.11.2010
 * @version	1.1
 */
class FormManagerFilterException extends Exception {

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