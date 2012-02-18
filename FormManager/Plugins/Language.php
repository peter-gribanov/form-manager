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
 * Инструмент для установки плагинов языковых тем
 * 
 * @package FormManager\Plugins
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Plugins_Language implements FormManager_Plugins_Interface {

	/**
	 * Запрещена инициализация класса
	 */
	private function __construct() {
	}

	/**
	 * Устанавливает языковую группу сообщений
	 * 
	 * Проверяет установлена ли языковая группа сообщений
	 * и если установлена выполняет валидации установленной группы.
	 * 
	 * @throws FormManager_Exceptions_InvalidArgument
	 * @throws FormManager_Exceptions_Logic
	 * 
	 * @param string $name Имя группы сообщений
	 * @param string $id   Идентификатор языковой темы
	 * 
	 * @return boolean
	 */
	static public function install($name, $id = FormManager_Language::DEFAULT_ID) {
		$name = strtolower($name);
		$id   = strtolower($id);
		if ($name == FormManager_Language::DEFAULT_GROUP) {
			throw new FormManager_Exceptions_InvalidArgument('Недопустимое имя'); // TODO описать исключение
		}
		$file = FORM_MANAGER_LANGUAGES_PATH.'/'.$id.'/'.$name.'.php';
		// удалять файлы с недопустимым именем
		if ($name[0] == '.') {
			if (file_exists($file)) {
				unlink($file);
			}
			throw new FormManager_Exceptions_InvalidArgument('Недопустимое имя'); // TODO описать исключение
		}
		// создаем пустую группу если ее нет
		if ((!self::isInstalled($name, $id) || !is_array(include $file)) &&
			!file_put_contents($file, "<?php\nreturn array(\n);")
		) {
			throw new FormManager_Exceptions_Logic('Не удалось создать файл языковой темы'); // TODO описать исключение
		}
		return true;
	}

	/**
	 * Удаляет языковую группу сообщений
	 * 
	 * @throws FormManager_Exceptions_InvalidArgument
	 * @throws FormManager_Exceptions_Logic
	 * 
	 * @param string      $name Имя группы сообщений
	 * @param string|null $id   Идентификатор языковой темы. Если не укзано удаляет во всех языковых темах
	 * 
	 * @return boolean
	 */
	static public function uninstall($name, $id = null) {
		$name = strtolower($name);
		if ($name == FormManager_Language::DEFAULT_GROUP) {
			throw new FormManager_Exceptions_InvalidArgument('Недопустимое имя'); // TODO описать исключение
		}
		if (!self::isInstalled($name, $id)) {
			throw new FormManager_Exceptions_Logic(); // TODO описать исключение
		}
		if ($id) {
			return unlink(FORM_MANAGER_LANGUAGES_PATH.'/'.strtolower($id).'/'.$name.'.php');
		} else {
			// удаляем группу везде
			$handler = dir(FORM_MANAGER_LANGUAGES_PATH);
			while (false !== ($item = $handler->read())) {
				if ($item != '.' && $item != '..' &&
					file_exists(FORM_MANAGER_LANGUAGES_PATH.'/'.$item.'/'.$name.'.php')
				) {
					unlink(FORM_MANAGER_LANGUAGES_PATH.'/'.$item.'/'.$name.'.php');
				}
			}
		}
	}

	/**
	 * Проверяет установлена ли группа языковых сообщений
	 * 
	 * @param string $name Имя группы сообщений
	 * @param string $id   Идентификатор языковой темы
	 * 
	 * @return boolean
	 */
	static public function isInstalled($name, $id = FormManager_Language::DEFAULT_ID) {
		return file_exists(FORM_MANAGER_PATH.'/languages/'.$id.'/'.$name.'.php');
	}

	/**
	 * Возвращает список установленных групп языковых сообщений
	 * 
	 * @param string $id Идентификатор языковой темы
	 * 
	 * @return array|boolean
	 */
	static public function getListOfInstalled($id = FormManager_Language::DEFAULT_ID) {
		$dir = FORM_MANAGER_LANGUAGES_PATH.'/'.$id.'/';
		if (!is_dir($dir)) {
			return false;
		}
		$list = array();
		foreach (scandir($dir) as $item) {
			if ($item != '.' && $item != '..' && pathinfo($item, PATHINFO_EXTENSION) == 'php') {
				$list[] = pathinfo($item, PATHINFO_FILENAME);
			}
		}
		return $list;
	}

}