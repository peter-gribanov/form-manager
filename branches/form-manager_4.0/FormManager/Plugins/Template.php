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
	 * @param string $name  Имя шаблона
	 * @param string $group Имя группы шаблонов
	 * 
	 * @return boolean
	 */
	static public function install($name, $group = FormManager_Template::DEFAULT_TEMPLATE) {
		return true;
	}

	/**
	 * Удаляет шаблон
	 * 
	 * @param string      $name  Имя шаблона
	 * @param string|null $group Имя группы шаблонов. Если не укзано удаляет во всех группах
	 * 
	 * @return boolean
	 */
	static public function uninstall($name, $group = null) {
		// TODO требуется реализация
		return true;
	}

	/**
	 * Проверяет установлена ли шаблон
	 * 
	 * @param string $name  Имя шаблона
	 * @param string $group Имя группы шаблонов
	 * 
	 * @return boolean
	 */
	static public function isInstalled($name, $group = FormManager_Template::DEFAULT_TEMPLATE) {
		// TODO требуется реализация
		return false;
	}

	/**
	 * Возвращает список установленных шаблонов
	 * 
	 * @param string $group Имя группы шаблонов
	 * 
	 * @return array
	 */
	static public function getListOfInstalled($group = FormManager_Template::DEFAULT_TEMPLATE) {
		// TODO требуется реализация
		return array();
	}

}