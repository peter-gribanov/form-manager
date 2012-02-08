<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 212 $
 * @since     $Date: 2012-01-22 18:33:56 +0400 (Sun, 22 Jan 2012) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Интерфейс фильтра
 * 
 * @package FormManager\Plugins
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Plugins_Interface {

	/**
	 * Устанавливает элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function install($element);

	/**
	 * Удаляет элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function uninstall($element);

}