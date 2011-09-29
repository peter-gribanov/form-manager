<?php

/**
 * Клас является адаптором для работы с базой данных
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
class FormManagerDB {

	/**
	 * Поток запроса
	 * 
	 * @var	FormManagerDBDriver
	 */
	private static $driver;


	/**
	 * Устанавливает название драйвер для работы с БД и инициализирует его
	 * 
	 * @param	string	$driver_name	Имя драйвера
	 * @throws	InvalidArgumentException
	 * @throws	Exception
	 * @return	void
	 */
	public static function setDriver($driver_name){
		if (!is_string($driver_name) || !trim($driver_name))
			throw new InvalidArgumentException('Name of driver of a database should be a string.');

		$classname = 'FormManagerDBDriver'.$driver_name;
		$file = dirname(__FILE__).'/drivers/'.strtolower($driver_name).'/'.$classname.'.php';

		if (!file_exists($file))
			throw new Exception('File not found the driver of a database.');

		require_once $file;

		if (!class_exists($classname))
			throw new Exception('Not find a class driver of a database.');

		self::$driver = $driver;

		if (!(self::$driver instanceof FormManagerDBDriver))
			throw new Exception('The driver class of the database is not responding interface FormManagerDBDriver.');
	}

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param	string	$statement	SQL запрос
	 * @param	array	$input_parameters	Параметры запроса
	 * @return	FormManagerDBDriver	Драйвер БД
	 */
	public static function prepare($statement, $input_parameters=null){
		return self::$driver->prepare($statement, $input_parameters);
	}

}