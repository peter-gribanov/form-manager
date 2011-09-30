<?php

/**
 * Интерфейс для драйвера работы с БД
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
interface FormManagerDBDriver {

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param	string	$statement	SQL запрос
	 * @return	FormManagerDBDriver	Драйвера работы с БД
	 */
	public function prepare($statement);

	/**
	 * Возвращает одну запись из результата запроса
	 * 
	 * @return	mixed	Запись из результата запроса
	 */
	public function fetch();

	/**
	 * Устанавливает для драйвера существующее соединение с БД
	 * 
	 * Если для работы драйвера необходимо подключение к базе данных,
	 * и он не может воспользоваться уже существующим или создать новое
	 * то для него передается ссылка на уже созданное ранее соединение
	 * с базой данных.
	 * В основном это применяется на низкоуровневых драйверах.
	 * 
	 * @param	resource	$connect	Соединение с БД
	 * @return	boolen					Результат установки соединения
	 */
	public function setConnect( & $connect);

}