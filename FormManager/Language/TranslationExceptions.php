<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 109 $
 * @since     $Date: 2011-12-08 13:02:59 +0300 (Thu, 08 Dec 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Класс предназначен для перевода сообщений исключений
 * 
 * TODO на текущий момент нигде не используется. возможно стоит от него отказаться
 * 
 * @package FormManager\Language
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Language_TranslationExceptions {

	/**
	 * Создает исключение
	 * 
	 * Если указан код и не указано сообщение или используемая языковая тема не является темой по умолчанию
	 * то берется сообщение из языковой темы.
	 * Если в языковой теме не оказалось сообщения с указанным кодом то ищет сообщение с группой этого кода.
	 * 
	 * @param string  $message Текст сообщения
	 * @param integer $code    Код исключения
	 */
	public static function getMessage($message = '', $code = null) {
		// если указан код сообщения и выбрана языковая тема не по молчанию
		// пытаемся получить сообщение из языковой темы
		if ($code && (!$message || !FormManager_Language::isDefaultId())){
			// получение сообщения для кода
			$lang_mess = FormManager_Language::getMessage('error-'.$code);
			if ($lang_mess) {
				$message = $lang_mess;
			} elseif(!$message) { // получение сообщения для группы кода
				$message = FormManager_Language::getMessage('error-'.$code[0].'00');
			}
		}
		return $message;
	}

}