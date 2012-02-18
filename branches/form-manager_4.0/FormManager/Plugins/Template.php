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
 * Инструмент для установки плагинов шаблонов
 * 
 * @package FormManager\Plugins
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Plugins_Template implements FormManager_Plugins_Interface {

	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает шаблон
	 * 
	 * Проверяет установлен ли шаблон
	 * 
	 * @param string $name  Имя элемента для устанавливаемого шаблона
	 * @param string $group Имя группы шаблонов
	 * 
	 * @return boolean
	 */
	static public function install($name, $group = FormManager_Template::DEFAULT_TEMPLATE) {
		$name  = strtolower($name);
		$group = strtolower($group);
		// создаем пустой шаблон если его нет
		if (!self::isInstalled($name, $group)) {
			return file_put_contents(FORM_MANAGER_TEMPLATES_PATH.'/'.$group.'/'.$name.'/template.php', '');
		}
		return true;
	}

	/**
	 * Удаляет шаблон
	 * 
	 * @param string      $name  Имя элемента для устанавливаемого шаблона
	 * @param string|null $group Имя группы шаблонов. Если не укзано удаляет во всех группах
	 * 
	 * @return boolean
	 */
	static public function uninstall($name, $group = null) {
		$name = strtolower($name);
		if (!self::isInstalled($name, $group)) {
			throw new FormManager_Exceptions_Logic(); // TODO описать исключение
		}
		if ($group) {
			self::rmdir(FORM_MANAGER_TEMPLATES_PATH.strtolower($group).'/'.$name);
		} else {
			// удаляем шаблон везде
			$handler = dir(FORM_MANAGER_TEMPLATES_PATH);
			while (false !== ($item = $handler->read())) {
				if ($item != '.' && $item != '..' && is_dir(FORM_MANAGER_TEMPLATES_PATH.'/'.$item)) {
					self::rmdir(FORM_MANAGER_TEMPLATES_PATH.'/'.$item.'/'.$name);
				}
			}
		}
		return true;
	}

	/**
	 * Проверяет установлена ли шаблон
	 * 
	 * @param string $name  Имя элемента для устанавливаемого шаблона
	 * @param string $group Имя группы шаблонов
	 * 
	 * @return boolean
	 */
	static public function isInstalled($name, $group = FormManager_Template::DEFAULT_TEMPLATE) {
		return file_exists(FORM_MANAGER_TEMPLATES_PATH.'/'.$group.'/'.$name.'/template.php');
	}

	/**
	 * Возвращает список установленных шаблонов
	 * 
	 * @param string $group Имя группы шаблонов
	 * 
	 * @return array
	 */
	static public function getListOfInstalled($group = FormManager_Template::DEFAULT_TEMPLATE) {
		$list = array();
		$dir = FORM_MANAGER_TEMPLATES_PATH.'/'.$group.'/';
		$handler = dir($dir);
		while (false !== ($item = $handler->read())) {
			if ($item != '.' && $item != '..' && file_exists($dir.$item.'/template.php')) {
				$list[] = $item;
			}
		}
		return $list;
	}

	/**
	 * Рекурсивно удаляет директорию
	 * 
	 * @param string $dir Имя директории
	 */
	static private function rmdir($dir) {
		if (!is_dir($dir)) {
			return;
		}
		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..') {
				continue;
			}
			if (is_dir($dir.'/'.$item)) {
				self::rmdir($dir.'/'.$item);
			} else {
				unlink($dir.'/'.$item);
			}
		}
		rmdir($dir);
	}

}