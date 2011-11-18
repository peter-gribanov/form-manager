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

if (version_compare(phpversion(), '5.0', '<') == true) {
	exit('Для работы требуется PHP 5.0.x');
}

/**
 * Корневой путь к библиотеке на сервере
 * 
 * @todo DocBlox не ципляет комментарий
 * 
 * @var string
 */
define('FORM_MANAGER_PATH', dirname(__FILE__));

// определение http пути к дирректории
// http путь по умолчанию
$http_path = '/';
$path = realpath($_SERVER['DOCUMENT_ROOT']);
if ( FORM_MANAGER_PATH != $path && strpos($path, FORM_MANAGER_PATH) === 0 ) {
	$http_path = str_replace(FORM_MANAGER_PATH, '', $path).'/';
}

/**
 * Корневой HTTP путь к библиотеке на сервере
 * 
 * @var string
 */
define('FORM_MANAGER_HTTP_PATH', $http_path);

unset($http_path, $path);

/**
 * Функция отладки, обычно определяется во внешней библиотеке debuger
 * 
 * @todo Удалить на паблике
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * @param $var Выводимая переменная
 */
if (!function_exists('p')) {
	function p($var) {
		return htmlspecialchars(print_r($var, true));
	}
}

// подключение автолоудера
require FORM_MANAGER_PATH.'/autoload.php';
