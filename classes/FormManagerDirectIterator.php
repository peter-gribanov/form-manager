<?php

/**
 * Прямой итератор по коллекции элементов
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
class FormManagerDirectIterator implements Iterator {

	/**
	 * Список данных
	 * 
	 * @access	private
	 * @var		array
	 */
	private $var = array();


	/**
	 * Конструктор
	 * 
	 * @param	array	$array	ССылка на коллекцию элементов
	 * @return	void
	 */
	public function __construct( & $array){
		if (is_array($array)) $this->var = & $array;
	}

	/**
	 * Устанавливает внутренний указатель на первый элемент
	 * 
	 * @return	void
	 */
	public function rewind(){
		reset($this->var);
	}

	/**
	 * Возвращает текущий элемент
	 * 
	 * @return	mixed	Элемент коллекции
	 */
	public function current(){
		return current($this->var);
	}

	/**
	 * Возвращает индекс текущей позиции
	 * 
	 * @return	mixed	Индекс текущей позиции
	 */
	public function key(){
		return key($this->var);
	}

	/**
	 * Передвигает вперед внутренний указатель массива
	 * 
	 * @return	mixed	??
	 */
	public function next(){
		return next($this->var);
	}

	/**
	 * Проверяет, существует ли элемент на текущей позиции
	 * 
	 * @return	boolean	Результат проверки
	 */
	public function valid(){
		return $this->current()!==false;
	}

}