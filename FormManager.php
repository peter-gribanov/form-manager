<?php

require 'classes/FormManagerForm.php';
require 'classes/FormManagerElement.php';
require 'classes/FormManagerNestedCollection.php';
require 'classes/FormManagerText.php';
require 'classes/FormManagerHidden.php';
require 'classes/FormManagerSelect.php';

// внутренние константы
define('FORM_MANAGER_PATH', dirname(__FILE__));


/**
 * Основной интерфейс(фасад) библиотеки
 * 
 * Класс является интерфейсом библиотеки.
 * Он позволяет состовлять структуру(модель) формы
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
class FormManager {

	/**
	 * Конструктор
	 * 
	 * @return	void
	 */
	private function __construct(){
	}

	/**
	 * Создает новую форму
	 * 
	 * @return	FormManagerForm	Объект формы
	 */
	public static function Form(){
		return new FormManagerForm();
	}

	/**
	 * Создает новый элемент формы
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента
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
	 * @return	FormManagerNestedCollection	Объект коллекции
	 */
	public static function Collection(){
		return new FormManagerNestedCollection();
	}

	/**
	 * Создает новый элимент формы Text
	 * 
	 * @param	string	$name	Имя поля
	 * @param	string	$title	Заголовок поля
	 * @return	FormManagerText
	 */
	public static function Text($name, $title){
		$el = new FormManagerText();
		return $el
			->setName($name)
			->setTitle($title);
	}

	/**
	 * Создает новый элимент формы Password
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerText
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
	 * @return FormManagerHidden
	 */
	public static function Hidden($name){
		$el = new FormManagerHidden();
		return $el
			->setName($name)
			->setView('hidden');
	}

	/**
	 * Создает новый элимент формы Radio
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
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
		return self::Element($name, $title)
			->setView('textarea');
	}

	/**
	 * Создает новый элимент формы Select
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @param string $parametrs Параметры списка
	 * @return FormManagerSelect
	 */
	public static function Select($name, $title, $parametrs=array()){
		$el = new FormManagerSelect();
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
	 * @return FormManagerSelect
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
	 * @return FormManagerElement
	 */
	public static function File($name, $title){
		$el = new FormManagerElement();
		return $el->setName($name)
			->setTitle($title)
			->setView('file');
	}

	/**
	 * Создает новый элимент формы E-mail
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerText
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
	 * @return FormManagerText
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
	 * @return FormManagerText
	 */
	public static function Date($name, $title){
		return self::Text($name, $title)
			->setView('date')
			->setFilter('length', array('max'=>10))
			->setFilter('date');
	}

	/**
	 * Создает новый элимент формы Yes или No
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerElement
	 */
	public static function YesNo($name, $title){
		return self::Element($name, $title)
			->setView('yesno')
			->setFilter('bool');
	}

}