<?php

/**
 * Драйвер PDO для работы менеджера форм с БД
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
class FormManagerDBDriverPDO implements FormManagerDBDriver {

	/**
	 * Объект подключения
	 * 
	 * @var	PDO
	 */
	private $pdo;

	/**
	 * Поток запроса
	 * 
	 * @var	PDOStatement
	 */
	private $stream;

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param	string	$statement	SQL запрос
	 * @return	FormManagerDBDriverPDO
	 */
	public function prepare($statement){
		$this->stream = $this->pdo->prepare($statement);
		$this->stream->execute();
		return $this;
	}

	/**
	 * Возвращает одну запись из результата запроса
	 * 
	 * @return	mixed	Запись из результата запроса
	 */
	public function fetch(){
		return $this->stream->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Устанавливает для драйвера существующее соединение с БД
	 * 
	 * @param	PDO	$connect	Объект PDO
	 * @return	boolen	Результат установки соединения
	 */
	public function setConnect(PDO & $connect){
		$this->pdo = $connect;
		return true;
	}

}