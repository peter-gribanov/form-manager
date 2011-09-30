<?php

require 'classes/FormManagerForm.php';
require 'classes/FormManagerElement.php';
require 'classes/FormManagerNestedCollection.php';
require 'classes/FormManagerHidden.php';

/**
 * Основной интерфейс(фасад) библиотеки
 * 
 * Класс является интерфейсом библиотеки.
 * Он позволяет состовлять структуру(модель) формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.22 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager/3.22/
 * @copyright	(c) 2009 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 * @example		example1.php Example 1
 * @example		example2.php Example 2
 */
class FormManager {

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
	 * @return	FormManagerElement	Объект элемента формы
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
	 * @return	FormManagerNestedCollection	Объект пустой коллекции элементов
	 */
	public static function Collection(){
		return new FormManagerNestedCollection();
	}

	/**
	 * Создает новый элемент формы Text
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Text($name, $title){
		return self::Element($name, $title);
	}

	/**
	 * Создает новый элемент формы Password
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Password($name='password', $title='Password'){
		return self::Element($name, $title)
			->setView('password')
			->setFilter('empty');
	}

	/**
	 * Создает новый элемент формы Hidden
	 * 
	 * @param	string	$name	Имя элемента
	 * @return	FormManagerHidden	Объект скрытого элемента формы
	 */
	public static function Hidden($name){
		$el = new FormManagerHidden();
		return $el->setName($name);
	}

	/**
	 * Создает новый элемент формы Radio
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Radio($name, $title){
		return self::Element($name, $title)->setView('radio');
	}

	/**
	 * Создает новый элемент формы CheckBox
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
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
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function TextArea($name, $title){
		return self::Element($name, $title)->setView('textarea');
	}

	/**
	 * Создает новый элемент формы Select
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @param	string	$parametrs	Параметры списка
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Select($name, $title, $parametrs=array()){
		return self::Element($name, $title)
			->setView('select', $parametrs)
			->setFilter('select');
	}

	/**
	 * Создает новый элемент формы File
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function File($name, $title){
		return self::Element($name, $title)->setView('file');
	}

	/**
	 * Создает новый элемент формы E-mail
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Email($name, $title){
		return self::Text($name, $title);
	}

	/**
	 * Создает новый элемент формы Captcha
	 * 
	 * @param	string	$name	Имя элемента
	 * @param	string	$title	Заголовок элемента
	 * @return	FormManagerElement	Объект элемента формы
	 */
	public static function Captcha($name, $title, $length=6){
		return self::Text($name, $title)
			->setView('captcha', array('length' => $length))
			->setFilter('empty')
			->setFilter('length', array('min' => $length, 'max' => $length))
			->setFilter('captcha');
	}

}