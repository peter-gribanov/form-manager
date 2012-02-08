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
	 * Устанавливает язык
	 * 
	 * @param string $name Имя группы сообщений
	 * @param string $id   Идентификатор языковой темы
	 * 
	 * @return boolean
	 */
	static public function install($name, $id = FormManager_Language::DEFAULT_ID) {
		return true;
	}

	/**
	 * Удаляет язык
	 * 
	 * @param string      $name Имя группы сообщений
	 * @param string|null $id   Идентификатор языковой темы. Если не укзано удаляет во всех языковых темах
	 * 
	 * @return boolean
	 */
	static public function uninstall($name, $id = null) {
		// TODO требуется реализация
		return true;
	}

}