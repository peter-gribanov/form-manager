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
class FormManager_Lang {

	/**
	 * Идентификатор языковой темы
	 * 
	 * @var string
	 */
	private static $id = 'en';

	/**
	 * Список сообщений языковой темы
	 * 
	 * @var array
	 */
	private static $mess = null;


	/**
	 * Конструктор
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param  string $id Идентификатор языковой темы
	 * 
	 * @return boolen Результат установки темы
	 */
	public static function setID($id) {
		$path = FORM_MANAGER_PATH.'/lang/'.$id.'/.parameters.php';
		if (!file_exists($path)) {
			return false;
		}

		self::$id = $id;
		// загрузка списка сообщений
		include $path;
		self::$mess =& $lang;

		return true;
	}

	/**
	 * Возвращает одно или все языковые сообщения
	 * 
	 * @param string $id Идентификатор сообщения
	 * 
	 * @return string|array Языковые сообщения
	 */
	public static function &getMess($id = null) {
		// загрузка списка сообщений если он еще не загружен
		if (self::$mess === null) {
			self::$mess = include FORM_MANAGER_PATH.'/lang/'.$id.'/.parameters.php';
		}
		return ($id !== null) ? self::$mess[$id] : self::$mess;
	}

}