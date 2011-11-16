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

//require 'FormManagerIterator.php';

/**
 * Коллекция элиментов формы
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Collection_Primary implements FormManager_Model_Collection_Interface, FormManager_Model_Collection_Item, /*IteratorAggregate,*/ Serializable {

	/**
	 * Название коллекции
	 *
	 * @var	string
	 */
	protected $name = '';

	/**
	 * Список элементов
	 *
	 * @var	array
	 */
	protected $items = array();

	/**
	 * Объект формы
	 * 
	 * @var	FormManagerForm
	 */
	protected $form;


	/**
	 * Устанавливает форму
	 * 
	 * Устанавливает объект формы к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param	FormManagerForm	$form	Объект формы
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function setForm(FormManagerForm $form){
		$this->form = $form;
		foreach ($this->items as $item)
			$item->setForm($form);
		return $this;
	}

	/**
	 * Устанавливает название коллекции
	 * 
	 * @param	string	$name				Название коллекции
	 * @throws	InvalidArgumentException	Недопустимое имя
	 * @return	FormManagerCollection		Объект коллекции
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
	 * @return	string
	 *//*
	public function getName(){
		return $this->name;
	}*/

	/**
	 * Производит проверку переданных данных
	 * 
	 * @return	void
	 */
	public function valid(){
		foreach ($this as $item)
			$item->valid();
	}

	/**
	 * Рисует коллекцию элиментов
	 * 
	 * @return	void
	 */
	public function draw(){
		if (!$this->isEmpty())
			include FormManagerForm::getTemplatePath('collection.php');
	}

	/**
	 * Возвращает итератор
	 * 
	 * @return	FormManagerIterator
	 *//*
	public function getIterator(){
		return new FormManagerIterator($this->items);
	}*/

	/**
	 * Добавляет элемент
	 * 
	 * @param	FormManagerItem	$item	Объект элимента
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function add(FormManagerItem $item){
		$this->items[] = $item->setForm($this->form);
		return $this;
	}

	/**
	 * Очищает список элементов
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
	 * @param	string	$post
	 * @return	string
	 *//*
	public function getLangPost($post){
		return $this->form->getLangPost($post);
	}*/

	/**
	 * Метод для сериализации класса
	 * 
	 * @return	string	Сериализованная коллекция
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
	 * @param	string	$data	Сериализованная коллекция
	 * @return	void
	 */
	public function unserialize($data){
		list(
			$this->name,
			$this->items
		) = unserialize($data);
	}

}