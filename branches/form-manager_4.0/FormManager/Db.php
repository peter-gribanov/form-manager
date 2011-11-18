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
	 * @var	FormManager_Db_Interface
	 */
	private static $driver;


	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает название драйвер для работы с БД и инициализирует его
	 * 
	 * @throws FormManager_Db_Exception
	 * 
	 * @param string $driver_name Имя драйвера
	 */
	public static function set($driver_name) {
		if (!is_string($driver_name) || !trim($driver_name)) {
			throw new FormManager_Db_Exception('', 701);
		}

		$class_name = 'FormManager_Db_'.$driver_name;

		self::$driver = new $class_name;

		if (!(self::$driver instanceof FormManager_Db_Interface)) {
			throw new FormManager_Exception('', 702);
		}
	}

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param string $statement SQL запрос
	 * 
	 * @return FormManager_Db_Interface Драйвера работы с БД
	 */
	public static function prepare($statement) {
		return self::$driver->prepare($statement);
	}

}