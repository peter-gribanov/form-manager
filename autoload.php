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
 * Исключение для автозагрузки
 * 
 * @package AutoLoad
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_AutoLoad_Exception extends Exception {

}


/**
 * Функция автозагрузки классов и интерфейсов у нас анонимная
 * 
 * Pегистрируем ее через SPL, чтобы избежать конфликта с другими
 * функциями автозагрузки. Что, является хорошим тоном.
 * 
 * Второй параметр указывает что необходимо генерить исключени в случаи неуспеха.
 * Третий что нашу функцию необходимо добавить в начала всех функций автозагрузок.
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
spl_autoload_register(function ($name) {
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
}, true, true);
