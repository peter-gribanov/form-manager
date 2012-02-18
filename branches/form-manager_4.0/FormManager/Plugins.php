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
 * Инструмент для установки плагинов
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Plugins implements FormManager_Plugins_Interface {

	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function install($element) {
		$status = array();
		// установка элемента
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Element::install($element),
				// TODO использовать 'Элемент успешно установленн'
				'message' => FormManager_Language::getMessage('plugins_element_installed')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}
		// установка фильтра
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Filter::install($element),
				// TODO описать сообщение
				'message' => FormManager_Language::getMessage('plugins_filter_installed')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}
		// установка языка
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Language::install($element),
				// TODO описать сообщение
				'message' => FormManager_Language::getMessage('plugins_language_installed')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}
		// установка шаблона
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Template::install($element),
				// TODO описать сообщение
				'message' => FormManager_Language::getMessage('plugins_template_installed')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}/*
		if (!$status['error']) {
			self::uninstall($element);
			return false;
		}*/
		return $status;
	}

	/**
	 * Удаляет элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function uninstall($element) {
		$status = array();
		// удаление элемента
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Element::uninstall($element),
				// TODO использовать 'Элемент успешно установленн'
				'message' => FormManager_Language::getMessage('plugins_element_uninstalled')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}
		// удаление фильтра
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Filter::uninstall($element),
				// TODO описать сообщение
				'message' => FormManager_Language::getMessage('plugins_filter_uninstalled')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}
		// удаление языка
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Language::uninstall($element),
				// TODO описать сообщение
				'message' => FormManager_Language::getMessage('plugins_language_uninstalled')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}
		// удаление шаблона
		try {
			$status['success'][] = array(
				'status'  => FormManager_Plugins_Template::uninstall($element),
				// TODO описать сообщение
				'message' => FormManager_Language::getMessage('plugins_template_uninstalled')
			);
		} catch (FormManager_Exceptions_Error $e) {
			$status['error'][] = array(
				'status'  => false,
				'message' => $e->getMessage()
			);
		}
		return $status;
	}

	/**
	 * Проверяет установлен ли элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function isInstalled($element) {
		return FormManager_Plugins_Element::isInstalled($element);
	}

	/**
	 * Возвращает список установленных элементов
	 * 
	 * @return array
	 */
	static public function getListOfInstalled() {
		return FormManager_Plugins_Element::getListOfInstalled();
	}

}