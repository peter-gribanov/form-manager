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
 * Инструмент для установки плагинов фильтров
 * 
 * @package FormManager\Plugins
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Plugins_Filter implements FormManager_Plugins_Interface {

	/**
	 * Список фильтров установленных за период обращения
	 * 
	 * @var array
	 */
	private static $installed_list = array();


	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает элемент
	 * 
	 * @param string $filter Имя фильтра
	 * 
	 * @return boolean
	 */
	static public function install($filter) {
		if (self::isInstalled($filter)) {
			return true; // ???
		}

		$file = FORM_MANAGER_PATH.'/FormManager/Filter/'.str_replace('_', '/', $filter).'.php';

		if (!file_exists($file)) {
			throw new FormManager_Exceptions_Logic('Нет файла'); // TODO описать исключение
		}

		$registrator = new FormManager_Plugins_Registrator();

		if (!$registrator->isValidName($filter)) {
			if (!in_array(strtolower($filter), array('abstract', 'interface', 'factory', 'builder')) &&
				file_exists($file)) {
				unlink($file);
			}
			throw new FormManager_Exceptions_InvalidArgument('Недопустимое имя фильтра'); // TODO описать исключение
		}
		$class_name = 'FormManager_Filter_'.$filter;
		include_once $file;
		if (!class_exists($class_name)) {
			throw new FormManager_Exceptions_Logic('Класс не установлен'); // TODO описать исключение
		}
		if ($class_name instanceof FormManager_Filter_Interface) {
			throw new FormManager_Exceptions_Logic('Некоректный класс фильтра'); // TODO описать исключение
		}
		$registrator->register('filter', $filter);
		self::$installed_list[] = $filter;
		return true;
	}

	/**
	 * Удаляет элемент
	 * 
	 * @param string $filter Имя фильтра
	 * 
	 * @return boolean
	 */
	static public function uninstall($filter) {
		// удаляем только установленные фильтры
		if (!self::isInstalled($filter)) {
			return true; // ???
		}

		$file = FORM_MANAGER_PATH.'/FormManager/Filter/'.str_replace('_', '/', $filter).'.php';
		if (!file_exists($file)) {
			throw new FormManager_Exceptions_Logic('Нет файла'); // TODO описать исключение
		}

		$registrator = new FormManager_Plugins_Registrator();
		$registrator->unregister('filter', $filter);
		// удаление из списка TODO переделать на array_diff
		if ($key = array_search($filter, self::$installed_list)) {
			unset(self::$installed_list[$key]);
		}
		return true;
	}

	/**
	 * Проверяет установлен ли фильтр
	 * 
	 * @param string $filter Имя фильтра
	 * 
	 * @return boolean
	 */
	static public function isInstalled($filter) {
		return (in_array($filter, self::$installed_list) ||
			method_exists('FormManager_Filter_Factory', $filter));
	}

	/**
	 * Возвращает список установленных фильтров
	 * 
	 * @return array
	 */
	static public function getListOfInstalled() {
		return array_diff(get_class_methods('FormManager_Filter_Factory'), array('getInstance'));
	}

}