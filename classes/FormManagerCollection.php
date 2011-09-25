<?php

require 'FormManagerDirectIterator.php';
require 'FormManagerFilterException.php';

/**
 * Коллекция элиментов формы
 * 
 * @package	FormManager
 * @author	Peter Gribanov
 * @since	29.11.2010
 * @version	1.13
 */
class FormManagerCollection implements FormManagerItem, IteratorAggregate, Serializable {

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
	 * @var FormManagerForm
	 */
	protected $form;


	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManagerForm $form
	 * @return FormManagerCollection
	 */
	public function setForm(FormManagerForm $form){
		$this->form = $form;
		return $this;
	}

	/**
	 * Устанавливает название коллекции
	 *
	 * @param string $name
	 * @throws InvalidArgumentException
	 * @return FormManagerCollection
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
			include dirname(dirname(__FILE__)).'/skin/'.$this->form->getSkin().'.collection.php';
	}

	/**
	 * Возвращает итератор
	 * 
	 * @return FormManagerDirectIterator
	 */
	public function getIterator(){
		return new FormManagerDirectIterator($this->items);
	}

	/**
	 * Добавляет элемент
	 *
	 * @param FormManagerItem $item
	 * @return FormManagerCollection
	 */
	public function add(FormManagerItem $item){
		$this->items[] = $item->setForm($this->form);
		return $this;
	}

	/**
	 * Очищает список элементов
	 *
	 * @return FormManagerCollection
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