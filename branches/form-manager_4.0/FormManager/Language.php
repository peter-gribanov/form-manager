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
	 * @var array|null
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
	 * @return boolean Результат установки темы
	 */
	public static function setId($id) {
		// проверка списка
		if (($mess=self::getMessagesList($id)) === false) {
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
	 * @return boolean
	 */
	public static function isDefaultId() {
		return self::$id == self::DEFAULT_ID;
	}

	/**
	 * Возвращает одно или все языковые сообщения
	 * 
	 * @throws FormManager_Exceptions_LoadLanguageTheme
	 * 
	 * @param string $id     Id сообщения
	 * @param array  $params Параметры сообщения
	 * 
	 * @return string|boolean Языковые сообщения
	 */
	public static function getMessage($id, array $params = array()) {
		// загрузка списка сообщений если он еще не загружен
		if (self::$mess === null) {
			self::$mess = self::getMessagesList(self::$id);
			// проверка результата загрузки
			if (self::$mess === false) {
				throw new FormManager_Exceptions_LoadLanguageTheme('File ".parameters.php" for linguistic theme "'.self::$id.'" not found');
			} elseif (!is_array(self::$mess) || !self::$mess) {
				throw new FormManager_Exceptions_LoadLanguageTheme('List of messages for linguistic theme "'.self::$id.'" is empty');
			}
		}
		// нет сообщения для данного ключа
		if (!isset(self::$mess[$id])) {
			return false;
		}
		if (!empty($params)) { // сборка сообщения
			return call_user_func('sprintf', array(self::$mess[$id]) + $params);
		} else {
			return self::$mess[$id];
		}
	}

	/**
	 * Загружает список сообщений если он еще не загружен
	 * 
	 * @param string $id Id языковой темы
	 * 
	 * @return array|boolean Результат загрузки списка
	 */
	private static function getMessagesList($id) {
		$dir = FORM_MANAGER_PATH.'/languages/'.$id.'/';
		// загрузка базового набора сообщений
		$file = $dir.'.parameters.php';
		// проверка файла
		if (!file_exists($file) || !is_readable($file)) {
			return false;
		}
		// загрузка списка основных сообщений
		$list = include $file;
		// загрузка сообщений плагинов
		$scan = scandir($dir);
		foreach ($scan as $file) {
			if ($file[0] != '.' && is_readable($dir.$file)) {
				$name = pathinfo($file, PATHINFO_FILENAME);
				$data = include $dir.$file;
				foreach ($data as $key => $mess) {
					$list[$name.'-'.$key] = $mess;
				}
			}
		}
		return $list;
	}
}