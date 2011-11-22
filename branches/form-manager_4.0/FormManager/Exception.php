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
 * Класс исключений
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Exception extends Exception {

	/**
	 * Создает исключение
	 * 
	 * Если не указано сообщение, но указан код то берет сообщение из языковой темы
	 * Если в языковой теме не оказалось сообщения с указанным кодом то ищет сообщение с группой этого кода
	 * 
	 * @param string    $message  Текст сообщения
	 * @param integer   $code     Код исключения
	 * @param Exception $previous Предыдущее исключение
	 */
	public function __construct($message = '', $code = null, Exception $previous = null) {
		// если указан код сообщения и выбрана языковая тема не по молчанию
		// пытаемся получить сообщение из языковой темы
		if ($code && (!$message || !FormManager_Language::isDefaultId())){
			// получение сообщения для кода
			$lang_mess = FormManager_Language::getMessage('exception-'.$code);
			if ($lang_mess) {
				$message = $lang_mess;
			} elseif(!$message) {
				// получение сообщения для группы кода
				$message = FormManager_Language::getMessage('exception-'.$code[0].'00');
			}
		}
		parent::__construct($message, $code, $previous);
	}
}