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
	 * Устанавливает драйвер для работы с БД
	 * 
	 * @param	FormManagerDBDriver	$driver	Драйвер БД
	 * @return	void
	 */
	public static function setDBDriver(FormManagerDBDriver $driver){
		self::$driver = $driver;
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