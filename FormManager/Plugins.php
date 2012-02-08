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
	 * Устанавливает элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function install($element) {
		try {
			if (!FormManager_Plugins_Element::install($element)) {
				throw new Exception();
			}
			if (!FormManager_Plugins_Language::install($element)) {
				throw new Exception();
			}
			if (!FormManager_Plugins_Template::install($element)) {
				throw new Exception();
			}
		} catch (Exception $e) {
			self::uninstall($element);
			return false;
		}
		return true;
	}

	/**
	 * Удаляет элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function uninstall($element) {
		$status = true;
		if (!FormManager_Plugins_Element::uninstall($element)) {
			$status = false;
		}
		if (!FormManager_Plugins_Language::uninstall($element)) {
			$status = false;
		}
		if (!FormManager_Plugins_Template::uninstall($element)) {
			$status = false;
		}
		return true;
	}

}