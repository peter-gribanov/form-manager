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
		if ($name == FormManager_Language::DEFAULT_GROUP) {
			return false;
		}
		// удалять файлы с недопустимым именем
		$dir = FORM_MANAGER_PATH.'/languages/'.$id.'/';
		if ($name[0] == '.' && file_exists($dir.$name)) {
			unlink($dir.$name);
			return false;
		}
		return self::isInstalled($name, $id);
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
		return unlink(FORM_MANAGER_PATH.'/languages/'.$id.'/'.$name);
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
		return file_exists(FORM_MANAGER_PATH.'/languages/'.$id.'/'.$name);
	}

	/**
	 * Возвращает список установленных групп языковых сообщений
	 * 
	 * @param string $id Идентификатор языковой темы
	 * 
	 * @return array|boolean
	 */
	static public function getListOfInstalled($id = FormManager_Language::DEFAULT_ID) {
		$dir = FORM_MANAGER_PATH.'/languages/'.$id.'/';
		if (is_dir($dir)) {
			return false;
		}
		return array_diff(scandir($dir), array('..', '.'));
	}

}