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
 * Клас является адаптором для работы с базой данных
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Db {

	/**
	 * Драйвера работы с БД
	 * 
	 * @var	FormManager_Db_Driver
	 */
	private static $driver;


	/**
	 * Устанавливает название драйвер для работы с БД и инициализирует его
	 * 
	 * @throws FormManager_Exception_InvalidArgument Недопустимое имя драйвера
	 * @throws FormManager_Exception                 Файл драйвера не обнаружен
	 * @throws FormManager_Exception                 Класс драйвера не обнаружен
	 * 
	 * @param string $driver_name Имя драйвера
	 */
	public static function setDriver($driver_name) {
		if ( !is_string($driver_name) || !trim($driver_name) ) {
			throw new FormManager_Exception_InvalidArgument('Name of driver of a database should be a string.');
		}

		$class_name = 'FormManager_Db_Driver_'.$driver_name;/*
		$file = FORM_MANAGER_PATH.'/Classes/Db/Driver/'.strtolower($driver_name).'/'.$classname.'.php';

		if ( !file_exists($file) ) {
			throw new FormManager_Exception('File not found the driver of a database.');
		}

		require_once $file;

		if ( !class_exists($classname) ) {
			throw new FormManager_Exception('Not find a class driver of a database.');
		}*/

		self::$driver = new $class_name;
/*
		if ( !(self::$driver instanceof FormManager_Db_Driver_Interface) ) {
			throw new FormManager_Exception('The driver class of the database is not responding interface FormManagerDBDriver.');
		}*/
	}

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param string $statement SQL запрос
	 * 
	 * @return FormManager_Db_Driver Драйвера работы с БД
	 */
	public static function prepare($statement) {
		return self::$driver->prepare($statement);
	}

}