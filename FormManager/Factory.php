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

/**
 * Фабрика формы
 * 
 * @deprecated
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Factory {

	/**
	 * TODO добавить описание
	 * 
	 * @var FormManager_Field_Factory|null
	 */
	private static $field_factory = null;


	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Создает новую форму
	 * 
	 * @return FormManager_Form
	 */
	public static function Form() {
		$form = new FormManager_Form();
		return $form;
	}

	/**
	 * Создает новую коллекцию элиментов формы
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $name Имя коллекции
	 * @param string $type Тип коллекции
	 * 
	 * @return FormManager_Collection_Interface
	 */
	public static function getCollection($name, $type = 'default'){
		$class_name = 'FormManager_Collection_'.ucfirst($type);
		$obj = new $class_name();
		if (!($obj instanceof FormManager_Collection_Interface)) {
			throw new FormManager_Exceptions_ObjectType('', 1001);
		}
		return $obj->setName($name);
	}

	/**
	 * Создает новый элимент формы
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Field_Interface
	 */
	public static function getField($name = 'default'){
		if (!self::$field_factory) {
			self::$field_factory = new FormManager_Field_Factory();
		}
		return self::$field_factory->get($name);
	}

	/**
	 * Создает новый вопрос
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $type Тип вопроса
	 * 
	 * @return FormManager_Question_Interface
	 */
	public static function getQuestion($type = 'Base'){
		$class_name = 'FormManager_Question_'.$type;
		$obj = new $class_name();
		if (!($obj instanceof FormManager_Question_Interface)) {
			throw new FormManager_Exceptions_ObjectType('', 1003);
		}
		return $obj;
	}

	/**
	 * Создает новый элимент формы
	 * 
	 * @param string $name Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Field
	 */
	public static function Field($name, $title) {
		$el = new FormManager_Field();
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
		$el = new FormManager_Field_Radio();
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
	 * @return FormManager_Field
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
	 * @return FormManager_Field
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
	 * @return FormManager_Field
	 */
	public static function File($name, $title){
		$el = new FormManager_Field();
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
	 * Создает новый элимент формы Дата
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Field_Text
	 */
	public static function Date($name, $title) {
		return self::Text($name, $title)
			->setView('date')
			->setFilter('length', array('max' => 10))
			->setFilter('date');
	}

	/**
	 * Создает новый элимент формы Yes или No
	 * 
	 * @param string $name  Имя поля
	 * @param string $title Заголовок поля
	 * 
	 * @return FormManager_Field
	 */
	public static function YesNo($name, $title) {
		return self::Element($name, $title)
			->setView('yesno')
			->setFilter('bool');
	}

}