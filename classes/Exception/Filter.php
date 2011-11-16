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
 * Класс исключений для фильтров
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Exception_Filter extends FormManager_Exception {

	/**
	 * Объект поля формы
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
	 * @param	string				$message	Сообщение
	 * @param	FormManagerElement	$element	Объект элемента
	 * @param	array				$filter		Параметры фильтра
	 * @return	void
	 */
	public function __construct($message, FormManagerElement & $element, & $filter){
		parent::__construct($message, 0);
		$this->element = & $element;
		$this->filter = & $filter;
	}

	/**
	 * Возвращает объект поля формы
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