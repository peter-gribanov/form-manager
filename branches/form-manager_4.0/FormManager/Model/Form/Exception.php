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
 * Исключение для модели форм
 * 
 * @package FormManager\Model\Form
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Form_Exception extends FormManager_Exception {

	/**
	 * Создает исключение
	 * 
	 * @param string    $message  Текст сообщения
	 * @param integer   $code     Код исключения
	 * @param Exception $previous Предыдущее исключение
	 */
	public function __construct($message = '', $code = 600, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}

}