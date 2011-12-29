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
abstract class FormManager_Filter_Abstract implements FormManager_Interfaces_Filter {

	/**
	 * Объект поля формы
	 * 
	 * @var FormManager_Interfaces_Model_Element
	 */
	protected $element;

	/**
	 * Параметры фильтра
	 * 
	 * @var array
	 */
	protected $options;

	/**
	 * Список ошибок
	 * 
	 * @var array
	 */
	private $errors = array();


	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param FormManager_Model_Field_Interface $element Объект поля
	 * @param array                             $options Параметры фильтра
	 */
	public function __construct(FormManager_Interfaces_Model_Element $element, array $options = array()) {
		// TODO нужно реализовать проверку где происходит валидация
//		if (!is_integer($this->filter_iterator)){
//			throw new FormManager_Filter_Exception('Validate field is not running', 301);
//		}
		$this->element = $element;
		$this->options = $options;
	}

	/**
	 * Возвращает список ошибок
	 * 
	 * @return array
	 */
	public function getErrors() {
		return $this->errors;
	}

	/**
	 * Проверяет поле
	 */
	abstract public function check();

	/**
	 * Генерирует исключение при проверки поля фильтром
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 * 
	 * @return void
	 */
	protected function trigger($key, array $params = array()){
		// добавление сообщения из языковой темы
		$this->errors[] = FormManager_Language::getMessage('filter-'.$key, $params);
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export(){
		return $this->errors;
	}
}