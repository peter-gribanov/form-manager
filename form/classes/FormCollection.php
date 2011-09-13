<?php

require 'FormDirectIterator.php';
require 'FormFilterException.php';

/**
 * Коллекция элиментов формы
 * 
 * @package	Form
 * @author	Peter Gribanov
 * @since	07.09.2011
 * @version	1.15
 */
class FormCollection implements FormItem, IteratorAggregate, Serializable {

	/**
	 * Название коллекции
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Список элементов
	 *
	 * @var array
	 */
	protected $items = array();

	/**
	 * Объект формы
	 * 
	 * @var FormForm
	 */
	protected $form;


	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormForm $form
	 * @return FormCollection
	 */
	public function setForm(FormForm $form){
		$this->form = $form;
		foreach ($this->items as $item)
			$item->setForm($form);
		return $this;
	}

	/**
	 * Устанавливает название коллекции
	 *
	 * @param string $name
	 * @throws InvalidArgumentException
	 * @return FormCollection
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
	 * @return string
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Производит проверку переданных данных
	 *
	 * @return void
	 */
	public function valid(){
		foreach ($this as $item) $item->valid();
	}

	/**
	 * Рисует коллекцию элиментов
	 * 
	 * @return void
	 */
	public function draw(){
		if (!$this->isEmpty())
			include dirname(dirname(__FILE__)).'/templates/'.$this->form->getTemplate().'/collection.php';
	}

	/**
	 * Возвращает итератор
	 * 
	 * @return FormDirectIterator
	 */
	public function getIterator(){
		return new FormDirectIterator($this->items);
	}

	/**
	 * Добавляет элемент
	 *
	 * @param FormItem $item
	 * @return FormCollection
	 */
	public function add(FormItem $item){
		$this->items[] = $item->setForm($this->form);
		return $this;
	}

	/**
	 * Очищает список элементов
	 *
	 * @return FormCollection
	 */
	public function clear(){
		unset($this->items);
		$this->items = array();
		return $this;
	}

	/**
	 * Проверяет пуста ли коллекция
	 * 
	 * @return boolean
	 */
	public function isEmpty(){
		return !$this->items;
	}

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param string $post
	 * @return string
	 */
	public function getLangPost($post){
		return $this->form->getLangPost($post);
	}

	/**
	 * Метод для сериализации класса
	 *
	 * @return string
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
	 * @param string $data
	 * @return void
	 */
	public function unserialize($data){
		list(
			$this->name,
			$this->items
		) = unserialize($data);
	}

}
?>