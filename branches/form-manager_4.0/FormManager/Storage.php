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
 * Интерфейс рализующий получение данных из хранилища
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Storage {

	/**
	 * Драйвера работы с хранилищем
	 * 
	 * @var	FormManager_Storage_Interface
	 */
	private static $driver;


	/**
	 * Драйвер по умолчанию
	 * 
	 * @var string
	 */
	const DEFAULT_DRIVER = 'file';

	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает название драйвер для работы с БД и инициализирует его
	 * 
	 * @throws FormManager_Storage_Exception
	 * 
	 * @param string $driver_name Имя драйвера
	 * 
	 * @return FormManager_Storage_Interface Драйвера работы с БД
	 */
	public static function get($driver_name = self::DEFAULT_DRIVER) {
		if (!is_string($driver_name) || !trim($driver_name)) {
			throw new FormManager_Storage_Exception('', 701);
		}

		$class_name = 'FormManager_Storage_'.$driver_name;

		self::$driver = new $class_name;

		if (!(self::$driver instanceof FormManager_Storage_Interface)) {
			throw new FormManager_Storage_Exception('', 702);
		}

		return self::$driver;
	}

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param string $statement SQL запрос
	 * 
	 * @return FormManager_Db_Interface Драйвера работы с БД
	 *//*
	public static function prepare($statement) {
		return self::$driver->prepare($statement);
	}*/

}