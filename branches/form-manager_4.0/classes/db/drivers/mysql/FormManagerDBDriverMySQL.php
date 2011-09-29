<?php

/**
 * Драйвер MySQL для работы менеджера форм с БД
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
class FormManagerDBDriverMySQL implements FormManagerDBDriver {

	/**
	 * Подключение к БД
	 * 
	 * @var	resource
	 */
	private $connect;

	/**
	 * Поток запроса
	 * 
	 * @var	resource
	 */
	private $result;

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param	string	$statement	SQL запрос
	 * @return	FormManagerDBDriverMySQL
	 */
	public function prepare($statement){
		if ($this->connect){
			$this->result = mysql_query($statement, $this->connect);
		} else {
			$this->result = mysql_query($statement);
		}
		return $this;
	}

	/**
	 * Возвращает одну запись из результата запроса
	 * 
	 * @return	mixed	Запись из результата запроса
	 */
	public function fetch(){
		return mysql_fetch_object($this->result);
	}

	/**
	 * Устанавливает для драйвера существующее соединение с БД
	 * 
	 * @param	resource	$connect	Соединение с БД
	 * @return	boolen	Результат установки соединения
	 */
	public function setConnect( & $connect){
		if (!is_resource($connect)) return false;
		$this->connect = $connect;
		return true;
	}

	/**
	 * Освобождает память от результата запроса
	 * 
	 * @return	void
	 */
	public function __destruct(){
		mysql_free_result($this->result);
	}

}