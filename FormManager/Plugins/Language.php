<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 210 $
 * @since     $Date: 2012-01-18 21:47:57 +0400 (Wed, 18 Jan 2012) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Инструмент для установки плагинов языковых тем
 * 
 * @package FormManager\Plugins
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Plugins_Language implements FormManager_Plugins_Interface {

	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает языковую группу сообщений
	 * 
	 * @param string $name Имя группы сообщений
	 * @param string $id   Идентификатор языковой темы
	 * 
	 * @return boolean
	 */
	static public function install($name, $id = FormManager_Language::DEFAULT_ID) {
		$name = strtolower($name);
		if ($name == FormManager_Language::DEFAULT_GROUP || $name[0] == '.') {
			return false;
		}
		if (self::isInstalled($name, $id)) {
			return true; // ???
		}
		$register_file = FORM_MANAGER_PATH.'/languages/'.$id.'/.register.php';
		// TODO прописать в .register.php
		return true;
	}

	/**
	 * Удаляет языковую группу сообщений
	 * 
	 * @param string      $name Имя группы сообщений
	 * @param string|null $id   Идентификатор языковой темы. Если не укзано удаляет во всех языковых темах
	 * 
	 * @return boolean
	 */
	static public function uninstall($name, $id = null) {
		$name = strtolower($name);
		if ($name == FormManager_Language::DEFAULT_GROUP) {
			return false;
		}
		if (!self::isInstalled($name, $id)) {
			return true; // ???
		}
		// TODO требуется реализация
		return true;
	}

	/**
	 * Проверяет установлена ли группа языковых сообщений
	 * 
	 * @param string $name Имя группы сообщений
	 * @param string $id   Идентификатор языковой темы
	 * 
	 * @return boolean
	 */
	static public function isInstalled($name, $id = FormManager_Language::DEFAULT_ID) {
		$dir = FORM_MANAGER_PATH.'/languages/'.$id.'/';
		if (!file_exists($dir.'.register.php')) {
			return false;
		}
		if ($name == FormManager_Language::DEFAULT_GROUP) {
			return file_exists($dir.self::DEFAULT_GROUP.'.php');
		}
		return in_array($name, (array)include $dir.'.register.php');
	}

	/**
	 * Возвращает список установленных групп языковых сообщений
	 * 
	 * @param string $id Идентификатор языковой темы
	 * 
	 * @return array
	 */
	static public function getListOfInstalled($id = FormManager_Language::DEFAULT_ID) {
		$register = array();
		$register_file = FORM_MANAGER_PATH.'/languages/'.$id.'/.register.php';
		if (file_exists($register_file)) {
			$register = (array)include $register_file;
		}
		$register[] = FormManager_Language::DEFAULT_GROUP;
		return $register;
	}

}