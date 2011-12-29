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
 * Класс исключений для фильтров
 * 
 * @package FormManager\Exceptions
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Exceptions_Filter extends FormManager_Exception {

	/**
	 * Создает исключение
	 * 
	 * @param string  $message Текст сообщения
	 * @param integer $code    Код исключения
	 */
	public function __construct($message = '', $code = 300) {
		parent::__construct($message, $code);
	}

}