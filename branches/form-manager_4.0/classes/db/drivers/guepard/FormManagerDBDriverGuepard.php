<?php

/**
 * Драйвер Guepard для работы менеджера форм с БД
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
class FormManagerDBDriverGuepard implements FormManagerDBDriver {

	/**
	 * Поток запроса
	 * 
	 * @var	DBQuery
	 */
	private $stream;

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param	string	$statement	SQL запрос
	 * @return	FormManagerDBDriverGuepard
	 */
	public function prepare($statement){
		$this->stream = DB::prepare($statement);
		$this->stream->execute();
		return $this;
	}

	/**
	 * Возвращает одну запись из результата запроса
	 * 
	 * @return	mixed	Запись из результата запроса
	 */
	public function fetch(){
		return $this->stream->fetch();
	}

	/**
	 * Устанавливает для драйвера существующее соединение с БД
	 * 
	 * Драйвер использует уже суцществующее соединение с БД и поэтому
	 * передача методу активного подключение не требуется.
	 * Попытка передать ресурс с подключением будит проигнорирована. 
	 * 
	 * @param	resource	$connect	Соединение с БД
	 * @return	boolen	Результат установки соединения
	 */
	public function setConnect( & $connect){
		return true;
	}

}