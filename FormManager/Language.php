<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 41 $
 * @since     $Date: 2011-10-01 00:28:31 +0400 (Сб, 01 окт 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Класс для работы с языковыми темами
 * 
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Language {

	/**
	 * Идентификатор языковой темы
	 * 
	 * @var string
	 */
	private static $id = self::DEFAULT_ID;

	/**
	 * Список сообщений языковой темы
	 * 
	 * @var array
	 */
	private static $mess = null;


	/**
	 * Идентификатор языковой темы по умолчанию
	 * 
	 * @var string
	 */
	const DEFAULT_ID = 'en';


	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param  string $id Id языковой темы
	 * 
	 * @return boolen Результат установки темы
	 */
	public static function setId($id) {
		// проверка списка
		if (($mess=self::getMessagesList($id))===false) {
			return false;
		}

		self::$id = $id;
		self::$mess = $mess;

		return true;
	}

	/**
	 * Возвращает идентификатор языковой темы
	 * 
	 * @return string Id языковой темы
	 */
	public static function getId() {
		return self::$id;
	}

	/**
	 * Определяет является ли активная тема темой по умолчанию
	 * 
	 * @return boolen
	 */
	public static function isDefaultId() {
		return (self::$id == self::DEFAULT_ID);
	}

	/**
	 * Возвращает одно или все языковые сообщения
	 * 
	 * @throws FormManager_Exceptions_Language
	 * 
	 * @param string $id Id сообщения
	 * 
	 * @return string|array Языковые сообщения
	 */
	public static function getMessage($id = null) {
		// загрузка списка сообщений если он еще не загружен
		if (self::$mess === null) {
			self::$mess = self::loadMessagesList(self::$id);
			// проверка результата загрузки
			if (self::$mess === false) {
				$file = FORM_MANAGER_PATH.'/languages/'.$id.'/.parameters.php';
				throw new FormManager_Exceptions_Language('File "'.$file.'" for linguistic theme "'.self::$id.'" not found', 401);
			} elseif (!is_array(self::$mess) || !self::$mess) {
				throw new FormManager_Exceptions_Language('List of messages for linguistic theme "'.self::$id.'" is empty', 402);
			}
		}
		if ($id == null) {
			return self::$mess;
		} elseif (isset(self::$mess[$id])) {
			return self::$mess[$id];
		} else {
			return null;
		}
	}

	/**
	 * Загружает список сообщений если он еще не загружен
	 * 
	 * @param string $id Id языковой темы
	 * 
	 * @return array|boolen Результат загрузки списка
	 */
	private static function getMessagesList($id){
		$file = FORM_MANAGER_PATH.'/languages/'.$id.'/.parameters.php';
		// проверка файла
		if (!file_exists($file) || !is_readable($file)) {
			return false;
		}
		// загрузка списка сообщений
		return include $file;
		
	}
}