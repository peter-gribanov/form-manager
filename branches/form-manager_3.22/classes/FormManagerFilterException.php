<?php

/**
 * Класс исключений для фильтров
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.22 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @tutorial	http://peter-gribanov.ru/#open-source/form-manager
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerFilterException extends Exception {

	/**
	 * Объект элементы формы
	 * 
	 * @var	FormManagerElement
	 */
	private $element;

	/**
	 * Параметры фильтра
	 * 
	 * @var	array
	 */
	private $filter;


	/**
	 * Конструктор
	 * 
	 * @param	string	$message	Текст сообщения
	 * @param	FormManagerElement	$element	Объект элемента
	 * @param	array	$filter	Параметры фильтра
	 * @return	void
	 */
	public function __construct($message, FormManagerElement & $element, & $filter){
		parent::__construct($message, 0);
		$this->element = & $element;
		$this->filter = & $filter;
	}

	/**
	 * Возвращает объект элемента формы
	 * 
	 * @return	FormManagerElement	Объект элемента
	 */
	public function getElement(){
		return $this->element;
	}

	/**
	 * Возвращает имя фильтра
	 * 
	 * @return	string	Имя фильтра
	 */
	public function getFilterName(){
		return $this->filter[0];
	}

	/**
	 * Возвращает параметры фильтра
	 * 
	 * @return	array	Параметры фильтра
	 */
	public function getFilterParams(){
		return $this->filter[1];
	}

}