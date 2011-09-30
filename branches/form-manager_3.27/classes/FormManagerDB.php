<?php

/**
 * Клас является адаптором для работы с базой данных
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.27 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager/3.27/
 * @copyright	(c) 2009 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerDB {

	/**
	 * Драйвера работы с БД
	 * 
	 * @var FormManagerDBDriver
	 */
	private static $driver;


	/**
	 * Устанавливает драйвер для работы с БД
	 * 
	 * @param	FormManagerDBDriver	$driver	Драйвера работы с БД
	 * @return	void
	 */
	public static function setDBDriver(FormManagerDBDriver $driver){
		self::$driver = $driver;
	}

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param	string	$statement			SQL запрос
	 * @return	FormManagerDBDriver			Драйвера работы с БД
	 */
	public static function prepare($statement){
		return self::$driver->prepare($statement);
	}

}