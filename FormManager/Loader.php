<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision$
 * @since     $Date$
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Лоадер фабрики
 * 
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Loader {

	/**
	 * Имя файла для сохранения
	 * 
	 * @var string
	 */
	private $class_file = '';

	/**
	 * Коментарий для сохраняемого метода
	 * 
	 * @var string
	 */
	private $method_comment = 'Возвращает объект %s';


	/**
	 * Загружает класс и возвращает его экземпляр
	 * 
	 * Если метод не установлен то добавляет его в класс
	 * Используется для подключения плагинов
	 * Проверяет на конфликт с зарезервированными словами PHP
	 * 
	 * @see http://www.php.net/manual/en/reserved.keywords.php
	 * 
	 * @param string $method Вызываемый метод
	 * @param array  $args   Параметры метода
	 * 
	 * @return object
	 */
	public function __call($method, array $args = array()) {
		$object = $this->get($method);
		if (!$this->class_file) {
			return $object;
		}
		$reserved_keywords = array(
			'abstract', 'and', 'array', 'as', 'break', 'case', 'catch', 'class', 'clone', 'const',
			'continue', 'declare', 'default', 'do', 'else', 'elseif', 'enddeclare', 'endfor',
			'endforeach', 'endif', 'endswitch', 'endwhile', 'extends', 'final', 'for', 'foreach',
			'function', 'global', 'goto', 'if', 'implements', 'interface', 'instanceof', 'namespace',
			'new', 'or', 'private', 'protected', 'public', 'static', 'switch', 'throw', 'try', 'use',
			'var', 'while', 'xor', 'die', 'echo', 'empty', 'exit', 'eval', 'include', 'include_once',
			'isset', 'list', 'require', 'require_once', 'return', 'print', 'unset', 'factory'
		);
		// добавлять метод не состоящий в списке зарезервированных слов PHP + слово factory
		if (!in_array(strtolower($method), $reserved_keywords)) {
			$content = file_get_contents($this->class_file);
			$content = trim(substr($content, 0, -1));
			// шаблон php метода
			$content = $content.'

	/**
	 * '.sprintf($this->method_comment, $method).'
	 * 
	 * @return '.get_class($object).'
	 */
	public function '.$method.'(){
		return $this->get(\''.$method.'\');
	}

}';
			file_put_contents($this->class_file, $content);
		}
		return $object;
	}

	/**
	 * Устанавливает имя файла для сохранения
	 * 
	 * @param string $file Имя файла
	 */
	protected function setClassFile($file) {
		$this->class_file = $file;
	}

	/**
	 * Устанавливает коментарий для сохраняемого метода
	 * 
	 * @param string $comment Комментарий
	 */
	protected function setMethodComment($comment) {
		$this->method_comment = $comment;
	}

	/**
	 * Загружает класс и возвращает его экземпляр
	 * 
	 * @throws FormManager_Exceptions_ObjectType
	 * 
	 * @param string $class_name Имя загружаемого класса
	 * 
	 * @return object
	 */
	public function get($class_name){
		try {
			$objects = new $class_name();
		} catch (FormManager_AutoLoad_Exception $e) {
			$objects = null;
		}
		if (!($objects instanceof $class_name)) {
			throw new FormManager_Exceptions_ObjectType('Не удалось найти класс: '.$class_name, 1002);
		}
		return $objects;
	}
	
}