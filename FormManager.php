<?php

require 'classes/FormManagerForm.php';
require 'classes/FormManagerElement.php';
require 'classes/FormManagerNestedCollection.php';
require 'classes/fields/FormManagerFieldText.php';
require 'classes/fields/FormManagerFieldHidden.php';
require 'classes/fields/FormManagerFieldRadio.php';
require 'classes/fields/FormManagerFieldSelect.php';

// внутренние константы
define('FORM_PATH', dirname(__FILE__));
define('FORM_LANG', 'ru');
define('FORM_LANG_PATH', FORM_PATH.'/lang/'.FORM_LANG.'/.parameters.php');


/**
 * Класс представляет интерфейс для составления формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager_4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManager {

	/**
	 * Конструктор
	 * 
	 * @return void
	 */
	private function __construct(){
	}

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
		return $el
			->setName($name)
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
	 * @return FormManagerFieldText
	 */
	public static function Text($name, $title){
		$el = new FormManagerFieldText();
		return $el
			->setName($name)
			->setTitle($title);
	}

	/**
	 * Создает новый элимент формы Password
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerFieldText
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
	 * @return FormManagerFieldHidden
	 */
	public static function Hidden($name){
		$el = new FormManagerFieldHidden();
		return $el
			->setName($name)
			->setView('hidden');
	}

	/**
	 * Создает новый элимент формы Radio
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * @return FormManagerFieldRadio
	 */
	public static function Radio($name, $title){
		$el = new FormManagerFieldRadio();
		return $el
			->setName($name)
			->setTitle($title)
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
	 * @return FormManagerFieldSelect
	 */
	public static function Select($name, $title, $parametrs=array()){
		$el = new FormManagerFieldSelect();
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
	 * @return FormManagerFieldSelect
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
	 * @return FormManagerFieldText
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
	 * @return FormManagerFieldText
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
	 * @return FormManagerFieldText
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