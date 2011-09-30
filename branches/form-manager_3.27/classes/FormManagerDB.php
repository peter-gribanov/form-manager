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
	 * Поток запроса
	 * 
	 * @var FormManagerDBDriver
	 */
	private static $driver;


	/**
	 * Устанавливает драйвер для работы с БД
	 * 
	 * @param FormManagerDBDriver $driver
	 * @return void
	 */
	public static function setDBDriver(FormManagerDBDriver $driver){
		self::$driver = $driver;
	}

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param string $statement
	 * @param array $input_parameters
	 * @return FormManagerDBDriver
	 */
	public static function prepare($statement, $input_parameters=null){
		return self::$driver->prepare($statement, $input_parameters);
	}

}