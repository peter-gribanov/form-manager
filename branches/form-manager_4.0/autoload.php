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
 * Псевдоним для var_dump()
 * 
 * @TODO Удалить на паблике
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 41 $
 * @since     $Date: 2011-10-01 00:28:31 +0400 (Сб, 01 окт 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 * 
 * @param $var Выводимая переменная
 */
function p($var){
	var_dump($var);
}

// регистрируем автозагрузчик
spl_autoload_register(function ($class_name) {
	$file = str_replace(
		array('FormManager_', '_'),
		array('', '/'),
		$class_name
	);
	$file = FORM_MANAGER_PATH.'/classes/'.$file.'.php';

	if ( !file_exists($file)) {
		throw new Exception('Файл класса '.$class_name.' не найден');
	}
	require $file;

	if ( class_exists($class_name) ) {
		throw new Exception('Класса '.$class_name.' не установлен');
	}
	// validate class
	$name = explode('_', $class_name);
	switch ($name[1]) {
		case 'Model': {
			if ( !($class_name instanceof FormManager_Model_interface) ) {
				return false;
			}
		} break;
		case 'Collection': {
			if ( !($class_name instanceof FormManager_Model_interface) ) {
				return false;
			}
		} break;
	}
	return true;
});
