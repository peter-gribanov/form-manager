<?php

/**
 * Интерфейс для драйвера работы с БД
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
interface FormManagerDBDriver {

	/**
	 * Подготавливает запрос к исполненияю и выполняет его
	 * 
	 * @param string $statement
	 * @param array $input_parameters
	 * @return FormManagerDBDriver
	 */
	public function prepare($statement, $input_parameters=null);

	/**
	 * Возвращает одну запись из результата запроса
	 * 
	 * @return mixed
	 */
	public function fetch();

}