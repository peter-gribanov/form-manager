<?php

require 'classes/FormManagerForm.php';
require 'classes/FormManagerElement.php';
require 'classes/FormManagerNestedCollection.php';
require 'classes/FormManagerText.php';
require 'classes/FormManagerHidden.php';
require 'classes/FormManagerSelect.php';

// путь к библиотеке на диске
define('FORM_MANAGER_PATH', dirname(__FILE__));
// http путь к дирректории
define('FORM_MANAGER_HTTP_PATH', '/form-manager/');

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
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента
	 */
	public static function Element($name, $title){
		$el = new FormManagerElement();
		return $el->setName($name)
			->setTitle($title)
			->setFilter('null');
	}

	/**
	 * Создает новую коллекцию элементов формы
	 * 
	 * @return	FormManagerNestedCollection	Объект коллекции
	 */
	public static function Collection(){
		return new FormManagerNestedCollection();
	}

	/**
	 * Создает новый элемент формы Text
	 * 
	 * @param	string	$name	Имя поля
	 * @param	string	$title	Заголовок поля
	 * @return	FormManagerText	Объект текстового элемента формы
	 */
	public static function Text($name, $title){
		$el = new FormManagerText();
		return $el
			->setName($name)
			->setTitle($title);
	}

	/**
	 * Создает новый элемент формы Password
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Password($name='password', $title='Password'){
		return self::Text($name, $title)
			->setView('password')
			->setFilter('empty');
	}

	/**
	 * Создает новый элемент формы Hidden
	 * 
	 * @param	string	$name		Имя элемента
	 * @return	FormManagerHidden	Объект скрытого элемента формы
	 */
	public static function Hidden($name){
		$el = new FormManagerHidden();
		return $el
			->setName($name)
			->setView('hidden');
	}

	/**
	 * Создает новый элемент формы Radio
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Radio($name, $title){
		return self::Element($name, $title)
			->setView('radio');
	}

	/**
	 * Создает новый элемент формы CheckBox
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function CheckBox($name, $title){
		return self::Element($name, $title)
			->setDefaultValue(false)
			->setView('checkbox')
			->setFilter('bool');
	}

	/**
	 * Создает новый элемент формы TextArea
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function TextArea($name, $title){
		return self::Element($name, $title)
			->setView('textarea');
	}

	/**
	 * Создает новый элемент формы Select
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @param	string	$parametrs	Параметры списка
	 * @return	FormManagerSelect	Объект элемента список
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
	 * Создает новый элемент формы Multi Select
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @param	string	$parametrs	Параметры списка
	 * @return	FormManagerSelect	Объект элемента список
	 */
	public static function MultiSelect($name, $title, $parametrs=array()){
		$parametrs = array_merge(array(
			'size'		=> 3,
			'multiple'	=> true,
		), $parametrs);

		return self::Select($name, $title, $parametrs);
	}

	/**
	 * Создает новый элемент формы File
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function File($name, $title){
		$el = new FormManagerElement();
		return $el->setName($name)
			->setTitle($title)
			->setView('file');
	}

	/**
	 * Создает новый элемент формы E-mail
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Email($name, $title){
		return self::Text($name, $title)
			->setFilter('email');
	}

	/**
	 * Создает новый элемент формы Captcha
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerText	Объект текстового элемента формы
	 */
	public static function Kcaptcha($name, $title, $length=6){
		return self::Text($name, $title)
			->setView('kcaptcha')
			->setComment(sprintf($this->getLangPost('captcha-length'), $length))
			->setFilter('empty')
			->setFilter('length', array('min' => $length, 'max' => $length))
			->setFilter('kcaptcha');
	}

	/**
	 * Создает новый элемент формы Дата
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerText	Объект текстового элемента формы
	 */
	public static function Date($name, $title){
		return self::Text($name, $title)
			->setView('date')
			->setFilter('length', array('max'=>10))
			->setFilter('date');
	}

	/**
	 * Создает новый элемент формы Yes или No
	 * 
	 * @param	string	$name		Имя элемента
	 * @param	string	$title		Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function YesNo($name, $title){
		return self::Element($name, $title)
			->setView('yesno')
			->setFilter('bool');
	}

}