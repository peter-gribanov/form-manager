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
	 * Имя группы по умолчанию
	 * 
	 * @var string
	 */
	const DEFAULT_GROUP = '.default';


	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param  string $id Идентификатор языковой темы
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
	 * @return string Идентификатор языковой темы
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
	 * @param string $id     Идентификатор сообщения
	 * @param array  $params Параметры сообщения
	 * @param string $group  Имя группы сообщений
	 * 
	 * @return string|boolean Языковые сообщения
	 */
	public static function getMessage($id, array $params = array(), $group = self::DEFAULT_GROUP) {
		// загрузка списка сообщений если он еще не загружен
		if (self::$mess === null) {
			self::$mess = self::getMessagesList(self::$id);
			// проверка результата загрузки
			if (self::$mess === false) {
				throw new FormManager_Exceptions_LoadLanguageTheme('Invalid linguistic theme "'.self::$id.'"');
			} elseif (!is_array(self::$mess) || !self::$mess) {
				throw new FormManager_Exceptions_LoadLanguageTheme('List of messages for linguistic theme "'.self::$id.'" is empty');
			}
		}
		// нет сообщения для данного ключа
		if (!isset(self::$mess[$group][$id])) {
			return false;
		}
		if (!empty($params)) { // сборка сообщения
			return call_user_func_array('sprintf', array_merge(array(self::$mess[$group][$id]), $params));
		} else {
			return self::$mess[$group][$id];
		}
	}

	/**
	 * Загружает список сообщений если он еще не загружен
	 * 
	 * @param string $id Идентификатор языковой темы
	 * 
	 * @return array|boolean Результат загрузки списка
	 */
	private static function getMessagesList($id) {
		if (!FormManager_Plugins_Language::isInstalled(self::DEFAULT_GROUP, $id)) {
			return false;
		}
		$dir = FORM_MANAGER_PATH.'/languages/'.$id.'/';
		// инициализация базовой группы сообщений
		$mess[self::DEFAULT_GROUP] = (array)include $dir.self::DEFAULT_GROUP.'.php';
		// загрузка сообщений плагинов
		foreach (FormManager_Plugins_Language::getListOfInstalled($id) as $group) {
			$mess[$group] = (array)include $dir.$group.'.php';
		}
		return $mess;
	}

}