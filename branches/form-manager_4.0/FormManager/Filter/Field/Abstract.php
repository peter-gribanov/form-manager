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
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Filter_Field_Abstract extends FormManager_Filter_Abstract {

	/**
	 * Добавляет ошибку
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 */
	public function addError($key, array $params = array()) {
		// добавление текста вопроса
		// TODO не очень хорошо что здесь выполняется export()
		$field = $this->element->export();
		array_unshift($params, $field['title']);
		parent::addError($key, $params);
	}

	/**
	 * Добавляет уведомление
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 */
	public function addNotice($key, array $params = array()) {
		// добавление текста вопроса
		// TODO не очень хорошо что здесь выполняется export()
		$field = $this->element->export();
		array_unshift($params, $field['title']);
		parent::addNotice($key, $params);
	}

}