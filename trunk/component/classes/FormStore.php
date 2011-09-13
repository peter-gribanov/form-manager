<?php

/**
 * Хранение объекта формы
 * 
 * @author	Peter Gribanov
 * @since	06.09.2011
 * @version	1.0
 */
class FormStore {

	/**
	 * Объект драйвера хранения форм
	 * 
	 * @var FormStoreInterface
	 */
	private static $driver;


	/**
	 * Возвращает драйвер хранения форм
	 * 
	 * @return FormStoreInterface
	 */
	private static function getDriver(){
		if (!self::$driver){
			require_once 'FormStoreFile.php';
			self::$driver = new FormStoreFile();
		}
		return self::$driver;
	}

	/**
	 * Загружает форму
	 * 
	 * @param string $form_name
	 * @return FormForm
	 */
	static function load($form_name){
		return self::getDriver()->loadForm($form_name);
	}

	/**
	 * Сохряняет форму
	 * 
	 * @param FormForm $form
	 * @param string $form_name
	 * @return boolen
	 */
	static function save(FormForm $form, $form_name){
		return self::getDriver()->saveForm($form, $form_name);
	}

}