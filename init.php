<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 41 $
 * @since     $Date: 2011-10-01 00:28:31 +0400 (Сб, 01 окт 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Функции spl_autoload_register введена в версии 5.1.2
 */
if (version_compare(phpversion(), '5.1.2', '<') == true) {
	exit('Requires PHP 5.1.2 or more');
}


/**
 * КОНСТАНТЫ
 */

/**
 * Версия менеджера форм
 * 
 * @var string
 */
define('FORM_MANAGER_VERSION', '4.0');

if (!defined('FORM_MANAGER_PATH')) {
	/**
	 * Корневой путь к библиотеке на сервере
	 * 
	 * TODO DocBlox не ципляет комментарий
	 * 
	 * @var string
	 */
	define('FORM_MANAGER_PATH', dirname(__FILE__));
}

if (!defined('FORM_MANAGER_HTTP_PATH')) {
	// определение http пути к дирректории
	// http путь по умолчанию
	$http_path = '/';
	$path = realpath($_SERVER['DOCUMENT_ROOT']);
	if (FORM_MANAGER_PATH != $path && strpos($path, FORM_MANAGER_PATH) === 0) {
		$http_path = str_replace(FORM_MANAGER_PATH, '', $path).'/';
	}

	/**
	 * Корневой HTTP путь к библиотеке на сервере
	 * 
	 * @var string
	 */
	define('FORM_MANAGER_HTTP_PATH', $http_path);

	unset($http_path, $path);
}

if (!defined('FORM_MANAGER_LANGUAGES_PATH')) {
	/**
	 * Корневой путь к языковым сообщениям
	 * 
	 * @var string
	 */
	define('FORM_MANAGER_LANGUAGES_PATH', FORM_MANAGER_PATH.'/languages');
}

if (!defined('FORM_MANAGER_TEMPLATES_PATH')) {
	/**
	 * Корневой путь к шаблонам
	 * 
	 * @var string
	 */
	define('FORM_MANAGER_TEMPLATES_PATH', FORM_MANAGER_PATH.'/templates');
}


/**
 * ОТЛАДОЧНЫЕ ФУНКЦИИ
 */

if (!function_exists('p')) {
	/**
	 * Функция отладки, обычно определяется во внешней библиотеке debuger
	 * 
	 * @author Peter Gribanov <info@peter-gribanov.ru>
	 * 
	 * @param $var Выводимая переменная
	 */
	function p($var) {
		echo '<p style="border:1px #ccc dashed;background:#efe">'.highlight_string(var_export($var, true), true).'</p>';
	}
}


/**
 * АВТОЗАГРУЗКА
 */

/**
 * Исключение для автозагрузки
 * 
 * @package AutoLoad
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_AutoLoad_Exception extends Exception {

}

/**
 * Функция автозагрузки классов и интерфейсов
 * 
 * Функция сделана не ананимной что бы библиотека могла работать с PHP версии ниже 5.3
 * 
 * Pегистрируем ее через SPL, чтобы избежать конфликта с другими
 * функциями автозагрузки. Что, является хорошим тоном.
 * 
 * Внимание вызов у несуществующего класса константы, например FormManager_Undefined::UNDEFINED.
 * Вызовет PHP Fatal error:  Undefined class constant и невозможно будет перехватить исключение.
 * В тоже время FormManager_Undefined::undefined() и FormManager_Undefined::$undefined работать будут ожидаемо
 * 
 * @package AutoLoad
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * 
 * @throws  FormManager_AutoLoad_Exception
 * 
 * @param   string $name Имя класса/интерфейса
 * 
 * @return  boolean
 */
function FormManagerAutoLoad($name) {
	// аутолоадер используем только для FormManager_
	if (strpos($name, 'FormManager_') !== 0) {
		return false;
	}

	// получение имени файла
	$file = FORM_MANAGER_PATH.'/'.str_replace('_', '/', $name).'.php';

	// тип
	$type = strpos($name, 'Interface') === false ? 'class' : 'interface';

	// проверка файла
	if (!file_exists($file) || !is_readable($file)) {
		throw new FormManager_AutoLoad_Exception('File "'.$file.'" for '.$type.' "'.$name.'" not found', 101);
	}

	try {
		include_once($file);
	} catch (Exception $exeption) {
		// Костыль для php. При работе со статическими метада класса, без костыля
		// будет фатальная ошибка и исключение не сгенерируется
		throw new FormManager_AutoLoad_Exception('The file "'.$file.'" error, '.$type.' "'.$name.'" impossible to determine: "'.$exeption->getMessage().'"'. 102);
	}

	// проверка успошности загрузки
	$is = $type.'_exists';
	if (!$is($name, false)) {
		throw new FormManager_AutoLoad_Exception('The file "'.$file.'" '.$type.' "'.$name.'" not found', 103);
	}
	return true;
}

/**
 * Регестрируем автолоудер
 * 
 * Второй параметр указывает что необходимо генерить исключени в случаи неуспеха
 * Третий что нашу функцию необходимо добавить в начала всех функций автозагрузок (PHP >= 5.3)
 */
spl_autoload_register('FormManagerAutoLoad', true, true);
