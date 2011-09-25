<?php

require 'classes/FormManagerForm.php';
require 'classes/FormManagerElement.php';
require 'classes/FormManagerNestedCollection.php';
require 'classes/FormManagerHidden.php';

/**
 * Класс представляет интерфейс для составления формы
 * 
 * @package	FormManager
 * @author	Peter Gribanov
 * @since	25.11.2010
 * @version	1.1
 */
class FormManagerFacade {

	/**
	 * Создает новую форму
	 * 
	 * @return FormManagerForm
	 */
	public static function Form(){
		return new FormManagerForm();
	}

	/**
	 * Создает новый элимент формы
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function Element($name, $title){
		$el = new FormManagerElement();
		return $el->setName($name)
			->setTitle($title)
			->setFilter('null');
	}

	/**
	 * Создает новую коллекцию элиментов формы
	 * 
	 * @return FormManagerNestedCollection
	 */
	public static function Collection(){
		return new FormManagerNestedCollection();
	}

	/**
	 * Создает новый элимент формы Text
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function Text($name, $title){
		return self::Element($name, $title);
	}

	/**
	 * Создает новый элимент формы Password
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function Password($name='password', $title='Password'){
		return self::Element($name, $title)
			->setView('password')
			->setFilter('empty');
	}

	/**
	 * Создает новый элимент формы Hidden
	 * 
	 * @param string $name Имя поля
	 * @return FormManagerHidden
	 */
	public static function Hidden($name){
		$el = new FormManagerHidden();
		return $el->setName($name);
	}

	/**
	 * Создает новый элимент формы Radio
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function Radio($name, $title){
		return self::Element($name, $title)->setView('radio');
	}

	/**
	 * Создает новый элимент формы CheckBox
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
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
	 * @return FormManagerElement
	 */
	public static function TextArea($name, $title){
		return self::Element($name, $title)->setView('textarea');
	}

	/**
	 * Создает новый элимент формы Select
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @param string $parametrs Параметры списка
	 * @return FormManagerElement
	 */
	public static function Select($name, $title, $parametrs=array()){
		return self::Element($name, $title)
			->setView('select', $parametrs)
			->setFilter('select');
	}

	/**
	 * Создает новый элимент формы File
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function File($name, $title){
		return self::Element($name, $title)->setView('file');
	}

	/**
	 * Создает новый элимент формы E-mail
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function Email($name, $title){
		return self::Text($name, $title);
	}

	/**
	 * Создает новый элимент формы Captcha
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function Captcha($name, $title, $length=6){
		return self::Text($name, $title)
			->setView('captcha', array('length' => $length))
//			->setComment('Код состоит из %s символов.')
			->setFilter('empty')
			->setFilter('length', array('min' => $length, 'max' => $length))
			->setFilter('captcha');
	}

}