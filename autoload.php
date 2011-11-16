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

// регистрируем автозагрузчик
spl_autoload_register(function ($class_name) {
	// получение имени файла
	$file = str_replace(
		array('FormManager_', '_'),
		array('', '/'),
		$class_name
	);
	$file = FORM_MANAGER_PATH.'/classes/'.$file.'.php';

	// проверка существования файла
	if ( !file_exists($file)) {
		throw new Exception('Файл класса '.$class_name.' не найден');
	}
	require $file;
	// проверка существования класса
	if ( class_exists($class_name) ) {
		throw new Exception('Класса '.$class_name.' не установлен');
	}
	// проверка корректности класса
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
