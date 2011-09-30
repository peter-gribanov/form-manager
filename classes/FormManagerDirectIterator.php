<?php

/**
 * Прямой итератор
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
class FormManagerDirectIterator implements Iterator {

	/**
	 * Список данных
	 * 
	 * @var array
	 */
	private $var = array();


	/**
	 * Конструктор
	 * 
	 * @param array $array
	 * @return void
	 */
	public function __construct(& $array){
		if (is_array($array)) $this->var = & $array;
	}

	/**
	 * Устанавливает внутренний указатель на первый элимент
	 * 
	 * @return void
	 */
	public function rewind(){
		reset($this->var);
	}

	/**
	 * Возвращает текущий элимент
	 * 
	 * @return mixed
	 */
	public function current(){
		return current($this->var);
	}

	/**
	 * Возвращает индекс текущей позиции
	 * 
	 * @return mixed
	 */
	public function key(){
		return key($this->var);
	}

	/**
	 * Передвигает вперед внутренний указатель массива
	 * 
	 * @return mixed
	 */
	public function next(){
		return next($this->var);
	}

	/**
	 * Проверяет, существует ли элемент на текущей позиции
	 * 
	 * @return boolean
	 */
	public function valid(){
		return $this->current()!==false;
	}

}