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
 * Исключение для модели полей
 * 
 * @package FormManager\Exceptions\Model
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Exceptions_Model_Field extends FormManager_Exceptions_Model {

	/**
	 * Создает исключение
	 * 
	 * @param string    $message  Текст сообщения
	 * @param integer   $code     Код исключения
	 * @param Exception $previous Предыдущее исключение
	 */
	public function __construct($message = '', $code = 700, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}

}