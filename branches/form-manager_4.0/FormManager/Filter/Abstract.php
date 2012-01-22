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
 * Интерфейс фильтра
 * 
 * TODO структура фильтра полная охинея. нужно переделать
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Filter_Abstract implements FormManager_Filter_Interface {

	/**
	 * Список ошибок
	 * 
	 * @var array
	 */
	private $errors = array();

	/**
	 * Список уведомлений
	 * 
	 * @var array
	 */
	private $notices = array();


	/**
	 * Префикс для ключа языковых сообщений
	 * 
	 * @var string
	 */
	const MESSAGE_PREFIX = 'filter:';


	/**
	 * Возвращает список ошибок
	 * 
	 * @return array
	 */
	public function getErrors() {
		return $this->errors;
	}

	/**
	 * Добавляет ошибку
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 */
	protected function addError($key, array $params = array()) {
		// добавление сообщения из языковой темы
		$this->errors[] = FormManager_Language::getMessage(self::MESSAGE_PREFIX.$key, $params);
	}

	/**
	 * Возвращает список уведомлений
	 * 
	 * @return array
	 */
	public function getNotices() {
		return $this->notices;
	}

	/**
	 * Добавляет уведомление
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 */
	protected function addNotice($key, array $params = array()) {
		// добавление сообщения из языковой темы
		$this->notices[] = FormManager_Language::getMessage(self::MESSAGE_PREFIX.$key, $params);
	}

	/**
	 * Фильтровать и проверить ненадёжные данные и влзвращает результат
	 * 
	 * @param mixed                         $value   Проверяемые данные
	 * @param FormManager_Element_Interface $element Проверяемый елемент
	 * 
	 * @return mixed Отфильтрованное $value
	 */
	public function exec($value, FormManager_Element_Interface $element) {
		return $value;
	}

	/**
	 * Собирает результаты проверки
	 * 
	 * @return array {errors:[],notices:[]}
	 */
	public function assemble(){
		return array(
			'errors'  => $this->errors,
			'notices' => $this->notices
		);
	}

	/**
	 * Очистить состояние фильтра
	 */
	public function reset() {
		$this->errors = array();
		$this->notices = array();
	}

	/**
	 * Метод для сериализации класса
	 * 
	 * @return string
	 */
	public function serialize(){
		return '';
	}

	/**
	 * Метод для десериализации класса
	 * 
	 * @param string $data
	 */
	public function unserialize($data){
	}

}