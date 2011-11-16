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

/*
require 'classes/FormManagerLang.php';
require 'classes/FormManagerForm.php';
require 'classes/FormManagerElement.php';
require 'classes/FormManagerNestedCollection.php';
require 'classes/db/FormManagerDB.php';
require 'classes/fields/FormManagerFieldText.php';
require 'classes/fields/FormManagerFieldHidden.php';
require 'classes/fields/FormManagerFieldRadio.php';
require 'classes/fields/FormManagerFieldSelect.php';
*/

/**
 * Класс представляет интерфейс для составления формы
 * 
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Factory {

	/**
	 * Конструктор
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает название драйвер для работы с БД и инициализирует его
	 * 
	 * @param string $driver_name Имя драйвера
	 */
	public static function setDbDriver($driver_name) {
		FormManager_DB::setDriver($driver_name);
	}

	/**
	 * Создает новую форму
	 * 
	 * @return FormManager_Form
	 */
	public static function Form() {
		return new FormManager_Form();
	}

	/**
	 * Создает новый элимент формы
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Element
	 */
	public static function Element($name, $title) {
		$el = new FormManager_Element();
		return $el
			->setName($name)
			->setTitle($title)
			->setFilter('null');
	}

	/**
	 * Создает новую коллекцию элиментов формы
	 * 
	 * @return FormManager_Collection_Nested
	 */
	public static function Collection() {
		return new FormManager_Collection_Nested();
	}

	/**
	 * Создает новый элимент формы Text
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Field_Text
	 */
	public static function Text($name, $title) {
		$el = new FormManager_Field_Text();
		return $el
			->setName($name)
			->setTitle($title);
	}

	/**
	 * Создает новый элимент формы Password
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Field_Text
	 */
	public static function Password($name = 'password', $title = 'Password') {
		return self::Text($name, $title)
			->setView('password')
			->setFilter('empty');
	}

	/**
	 * Создает новый элимент формы Hidden
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Field_Hidden
	 */
	public static function Hidden($name) {
		$el = new FormManager_Field_Hidden();
		return $el
			->setName($name)
			->setView('hidden');
	}

	/**
	 * Создает новый элимент формы Radio
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Field_Radio
	 */
	public static function Radio($name, $title) {
		$el = new FormManager_Fiel_dRadio();
		return $el
			->setName($name)
			->setTitle($title)
			->setView('radio');
	}

	/**
	 * Создает новый элимент формы CheckBox
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Element
	 */
	public static function CheckBox($name, $title) {
		return self::Element($name, $title)
			->setDefaultValue(false)
			->setView('checkbox')
			->setFilter('bool');
	}

	/**
	 * Создает новый элимент формы TextArea
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Element
	 */
	public static function TextArea($name, $title) {
		return self::Element($name, $title)
			->setView('textarea');
	}

	/**
	 * Создает новый элимент формы Select
	 * 
	 * @param string $name      Имя поля
	 * @param string $title     Заголовок поля
	 * @param string $parametrs Параметры списка
	 * 
	 * @return FormManager_Field_Select
	 */
	public static function Select($name, $title, $parametrs = array()) {
		$el = new FormManager_Field_Select();
		return $el
			->setName($name)
			->setTitle($title)
			->setView('select', $parametrs)
			->setFilter('select');
	}

	/**
	 * Создает новый элимент формы Multi Select
	 * 
	 * @param string $name      Имя поля
	 * @param string $title     Заголовок поля
	 * @param string $parametrs Параметры списка
	 * 
	 * @return FormManager_Field_Select
	 */
	public static function MultiSelect($name, $title, $parametrs = array()) {
		$parametrs = array_merge(array(
			'size'		=> 3,
			'multiple'	=> true,
		), $parametrs);

		return self::Select($name, $title, $parametrs);
	}

	/**
	 * Создает новый элимент формы File
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Element
	 */
	public static function File($name, $title){
		$el = new FormManager_Element();
		return $el->setName($name)
			->setTitle($title)
			->setView('file');
	}

	/**
	 * Создает новый элимент формы E-mail
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Field_Text
	 */
	public static function Email($name, $title){
		return self::Text($name, $title)
			->setFilter('email');
	}

	/**
	 * Создает новый элимент формы Captcha
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManagerFieldText
	 */
	public static function Captcha($name, $title, $length = 6) {
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
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManagerFieldText
	 */
	public static function Date($name, $title) {
		return self::Text($name, $title)
			->setView('date')
			->setFilter('length', array('max'=>10))
			->setFilter('date');
	}

	/**
	 * Создает новый элимент формы Yes или No
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Element
	 */
	public static function YesNo($name, $title) {
		return self::Element($name, $title)
			->setView('yesno')
			->setFilter('bool');
	}

}