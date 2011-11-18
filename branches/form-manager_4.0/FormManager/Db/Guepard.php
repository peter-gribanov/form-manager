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
 * Драйвер Guepard для работы менеджера форм с БД
 * 
 * @package FormManager\Db
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Db_Guepard implements FormManager_Db_Interface {

	/**
	 * Поток запроса
	 * 
	 * @var DbQuery
	 */
	private $stream;

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param string $statement SQL запрос
	 * 
	 * @return FormManager_Db_Guepard Драйвера работы с БД
	 */
	public function prepare($statement) {
		$this->stream = DB::prepare($statement);
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
		return $this->stream->fetch();
	}

	/**
	 * Устанавливает для драйвера существующее соединение с БД
	 * 
	 * Драйвер использует уже суцществующее соединение с БД и поэтому
	 * передача методу активного подключение не требуется.
	 * Попытка передать ресурс с подключением будит проигнорирована. 
	 * 
	 * @param resource $connect Соединение с БД
	 * 
	 * @return boolen Результат установки соединения
	 */
	public function setConnect(&$connect) {
		return true;
	}

}