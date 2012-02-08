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
 * Инструмент для установки плагинов элементов
 * 
 * @package FormManager\Plugins
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Plugins_Element implements FormManager_Plugins_Interface {

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
		if (self::isInstalled($element)) {
			return true; // ???
		}
		$element_key = strtolower($element);

		/**
		 * Списка зарезервированных слов PHP
		 * 
		 * @see http://php.net/manual/ru/reserved.php
		 */
		$reserved_keywords = array(
			'abstract', 'and', 'array', 'as', 'break', 'case', 'catch', 'class', 'clone', 'const',
			'continue', 'declare', 'default', 'do', 'else', 'elseif', 'enddeclare', 'endfor',
			'endforeach', 'endif', 'endswitch', 'endwhile', 'extends', 'final', 'for', 'foreach',
			'function', 'global', 'goto', 'if', 'implements', 'interface', 'instanceof', 'namespace',
			'new', 'or', 'private', 'protected', 'public', 'static', 'switch', 'throw', 'try', 'use',
			'var', 'while', 'xor', 'die', 'echo', 'empty', 'exit', 'eval', 'include', 'include_once',
			'isset', 'list', 'require', 'require_once', 'return', 'print', 'unset',
			'factory' // дополнительно слово
		);
		// запрешено использовать зарезервированные имена
		if (in_array($element_key, $reserved_keywords)) {
			return false;
		}
		// TODO требуется реализация
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
		if (!self::isInstalled($element)) {
			return true; // ???
		}
		// TODO требуется реализация
		return true;
	}

	/**
	 * Проверяет установлен ли элемент
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function isInstalled($element) {
		return method_exists('FormManager_Element_Factory', $element);
	}

	/**
	 * Возвращает список установленных элементов
	 * 
	 * @return array
	 */
	static public function getListOfInstalled() {
		return get_class_methods('FormManager_Element_Factory');
	}

}