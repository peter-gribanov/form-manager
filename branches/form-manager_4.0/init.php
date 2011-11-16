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
 * Псевдоним для var_dump()
 * 
 * @todo Удалить на паблике
 * 
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * 
 * @param $var Выводимая переменная
 */
function p($var){
	var_dump($var);
}

// подключение автолоудера
require FORM_MANAGER_PATH.'/autoload.php';
