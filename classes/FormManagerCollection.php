<?php

require 'FormManagerDirectIterator.php';
require 'FormManagerFilterException.php';

/**
 * Коллекция элементов формы
 * 
 * Класс описывающий коллекцию элементов формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.22 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @link		http://peter-gribanov.ru/#open-source/form-manager
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerCollection implements FormManagerItem, IteratorAggregate, Serializable {

	/**
	 * Название коллекции
	 * 
	 * @access	protected
	 * @var		string
	 */
	protected $name = '';

	/**
	 * Список элементов
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $items = array();

	/**
	 * Объект формы
	 * 
	 * @access	protected
	 * @var		FormManagerForm
	 */
	protected $form;


	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * 
	 * Устанавливает объект формы к которой пренадлежыт коллекция элементов
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param	FormManagerForm	$form	Объект формы
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function setForm(FormManagerForm $form){
		$this->form = $form;
		return $this;
	}

	/**
	 * Устанавливает название коллекции
	 *
	 * @param	string	$name	Название коллекции
	 * @throws	InvalidArgumentException	Недопустимое значение
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function setName($name){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Collection name must be not empty string');

		$this->name = $name;
		return $this;
	}

	/**
	 * Возвращает название коллекции
	 *
	 * @return	string	Название коллекции
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Производит проверку переданных данных
	 *
	 * @return	void
	 */
	public function valid(){
		foreach ($this as $item) $item->valid();
	}

	/**
	 * Рисует коллекцию элементов
	 * 
	 * @return	void
	 */
	public function draw(){
		if (!$this->isEmpty())
			include dirname(__DIR__).'/skin/'.$this->form->getSkin().'.collection.php';
	}

	/**
	 * Возвращает итератор по коллекции элементов
	 * 
	 * @return	FormManagerDirectIterator	Объект итератора
	 */
	public function getIterator(){
		return new FormManagerDirectIterator($this->items);
	}

	/**
	 * Добавляет элемент в коллекцию
	 * 
	 * @param	FormManagerItem	$item	Объект элемента
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function add(FormManagerItem $item){
		$this->items[] = $item->setForm($this->form);
		return $this;
	}

	/**
	 * Очищает коллекцию от списка элементов
	 *
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function clear(){
		unset($this->items);
		$this->items = array();
		return $this;
	}

	/**
	 * Проверяет пуста ли коллекция
	 * 
	 * @return	boolean	Результат проверки
	 */
	public function isEmpty(){
		return !$this->items;
	}

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param	string	$post	Идентификатор сообщения
	 * @return	string	Языковое сообщение
	 */
	public function getLangPost($post){
		return $this->form->getLangPost($post);
	}

	/**
	 * Метод для сериализации класса
	 * 
	 * @return	string	Сериализованый объект коллекции
	 */
	public function serialize(){
		return serialize(array(
			$this->name,
			$this->items,
		));
	}

	/**
	 * Метод для десериализации класса
	 * 
	 * @param	string	$data	Сериализованый объект коллекции
	 * @return	void
	 */
	public function unserialize($data){
		list(
			$this->name,
			$this->items
		) = unserialize($data);
	}

}