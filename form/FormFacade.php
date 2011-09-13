<?php

require 'classes/FormForm.php';
require 'classes/FormElement.php';
require 'classes/FormNestedCollection.php';
require 'classes/FormText.php';
require 'classes/FormHidden.php';
require 'classes/FormSelect.php';

/**
 * Класс представляет интерфейс для составления формы
 * 
 * @package	Form
 * @author	Peter Gribanov
 * @since	07.09.2011
 * @version	1.3
 */
class FormFacade {

	/**
	 * Создает новую форму
	 * 
	 * @return FormForm
	 */
	public static function Form(){
		return new FormForm();
	}

	/**
	 * Создает новый элимент формы
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function Element($name, $title){
		$el = new FormElement();
		return $el->setName($name)
			->setTitle($title)
			->setFilter('null');
	}

	/**
	 * Создает новую коллекцию элиментов формы
	 * 
	 * @return FormNestedCollection
	 */
	public static function Collection(){
		return new FormNestedCollection();
	}

	/**
	 * Создает новый элимент формы Text
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function Text($name, $title){
		$el = new FormText();
		return $el
			->setName($name)
			->setTitle($title);
	}

	/**
	 * Создает новый элимент формы Password
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function Password($name='password', $title='Password'){
		return self::Text($name, $title)
			->setView('password')
			->setFilter('empty');
	}

	/**
	 * Создает новый элимент формы Hidden
	 * 
	 * @param string $name Имя поля
	 * @return FormHidden
	 */
	public static function Hidden($name){
		$el = new FormHidden();
		return $el
			->setName($name)
			->setView('hidden');
	}

	/**
	 * Создает новый элимент формы Radio
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function Radio($name, $title){
		return self::Element($name, $title)
			->setView('radio');
	}

	/**
	 * Создает новый элимент формы CheckBox
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function CheckBox($name, $title){
		return self::Element($name, $title)
			->setDefaultValue(false)
			->setView('checkbox')
			->setFilter('bool');
	}

	/**
	 * Создает новый элимент формы TextArea
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function TextArea($name, $title){
		return self::Element($name, $title)
			->setView('textarea');
	}

	/**
	 * Создает новый элимент формы Select
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @param string $parametrs Параметры списка
	 * @return FormElement
	 */
	public static function Select($name, $title, $parametrs=array()){
		$el = new FormSelect();
		return $el
			->setName($name)
			->setTitle($title)
			->setView('select', $parametrs)
			->setFilter('select');
	}

	/**
	 * Создает новый элимент формы Multi Select
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @param string $parametrs Параметры списка
	 * @return FormElement
	 */
	public static function MultiSelect($name, $title, $parametrs=array()){
		$parametrs = array_merge(array(
			'size'		=> 3,
			'multiple'	=> true,
		), $parametrs);

		return self::Select($name, $title, $parametrs);
	}

	/**
	 * Создает новый элимент формы File
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function File($name, $title){
		return self::Element($name, $title)
			->setView('file');
	}

	/**
	 * Создает новый элимент формы E-mail
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function Email($name, $title){
		return self::Text($name, $title)
			->setFilter('email');
	}

	/**
	 * Создает новый элимент формы Captcha
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function Captcha($name, $title, $length=6){
		return self::Text($name, $title)
			->setView('captcha')
			->setComment(sprintf($this->getLangPost('captcha-length'), $length))
			->setFilter('empty')
			->setFilter('length', array('min' => $length, 'max' => $length))
			->setFilter('captcha');
	}

	/**
	 * Создает новый элимент формы Дата
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormElement
	 */
	public static function Date($name, $title){
		return self::Text($name, $title)
			->setView('date')
			->setFilter('length', array('eq'=>10))
			->setFilter('date');
	}

}