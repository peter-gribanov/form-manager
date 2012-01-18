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
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Filter_Interface {

	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param array $options Параметры фильтра
	 */
	public function __construct(array $options = array());

	/**
	 * Возвращает список ошибок
	 * 
	 * @return array
	 */
	public function getErrors();

	/**
	 * Добавляет ошибку
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 */
	public function addError($key, array $params = array());

	/**
	 * Возвращает список уведомлений
	 * 
	 * @return array
	 */
	public function getNotices();

	/**
	 * Добавляет уведомление
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 */
	public function addNotice($key, array $params = array());

	/**
	 * Устанавливает проверяемый елемент
	 * 
	 * @param FormManager_Element_Interface $element Проверяемый елемент
	 */
	public function setElement(FormManager_Element_Interface $element);

	/**
	 * Собирает елемент
	 * 
	 * @return array
	 */
	public function assemble();

}