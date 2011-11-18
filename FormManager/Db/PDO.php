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
 * Драйвер PDO для работы менеджера форм с БД
 * 
 * @package FormManager\Db
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Db_PDO implements FormManager_Db_Interface {

	/**
	 * Объект подключения
	 * 
	 * @var PDO
	 */
	private $pdo;

	/**
	 * Поток запроса
	 * 
	 * @var PDOStatement
	 */
	private $stream;

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param string $statement SQL запрос
	 * 
	 * @return FormManager_Db_PDO Драйвера работы с БД
	 */
	public function prepare($statement) {
		$this->stream = $this->pdo->prepare($statement);
		$this->stream->execute();
		return $this;
	}

	/**
	 * Возвращает одну запись из результата запроса
	 * 
	 * @todo проверить возвращаемый тип
	 * 
	 * @return array Запись из результата запроса
	 */
	public function fetch() {
		return $this->stream->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Устанавливает для драйвера существующее соединение с БД
	 * 
	 * @param PDO $connect Объект PDO
	 * 
	 * @return boolen Результат установки соединения
	 */
	public function setConnect(PDO &$connect) {
		$this->pdo = $connect;
		return true;
	}

}