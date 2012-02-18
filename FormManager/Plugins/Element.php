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
	 * @throws FormManager_Exceptions_InvalidArgument
	 * 
	 * @param string $element Имя элемента
	 * 
	 * @return boolean
	 */
	static public function install($element) {
		if (self::isInstalled($element)) {
			return true;
		}

		$file = FORM_MANAGER_PATH.'/FormManager/Element/'.str_replace('_', '/', $element).'.php';

		if (!file_exists($file)) {
			throw new FormManager_Exceptions_Logic('Нет файла'); // TODO описать исключение
		}

		$registrator = new FormManager_Plugins_Registrator();

		if (!$registrator->isValidName($element)) {
			if (!in_array(strtolower($element), array('abstract', 'interface', 'factory', 'builder')) &&
				file_exists($file)) {
				unlink($file);
			}
			throw new FormManager_Exceptions_InvalidArgument('Недопустимое имя элемента'); // TODO описать исключение
		}
		$class_name = 'FormManager_Element_'.$element;
		include_once $file;
		if (!class_exists($class_name)) {
			throw new FormManager_Exceptions_Logic('Класс не установлен'); // TODO описать исключение
		}
		if ($class_name instanceof FormManager_Element_Interface) {
			throw new FormManager_Exceptions_Logic('Некоректный класс элемента'); // TODO описать исключение
		}
		$registrator->register('Element', $element);
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

		$file = FORM_MANAGER_PATH.'/FormManager/Element/'.str_replace('_', '/', $element).'.php';
		if (!file_exists($file)) {
			throw new FormManager_Exceptions_Logic('Нет файла'); // TODO описать исключение
		}

		$registrator = new FormManager_Plugins_Registrator();
		$registrator->unregister('Element', $element);
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
		return array_diff(get_class_methods('FormManager_Element_Factory'), array('__construct'));
	}

}