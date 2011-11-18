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
abstract class FormManager_Filter_Abstract implements FormManager_Model_Field_Interface {

	/**
	 * Объект поля формы
	 * 
	 * @var FormManager_Model_Field_Abstract
	 */
	protected $field;

	/**
	 * Параметры фильтра
	 * 
	 * @var array
	 */
	protected $options;


	/**
	 * Устанавливает объект поля формы
	 * 
	 * @param FormManager_Model_Field_Abstract $field   Объект поля
	 * @param array                            $options Параметры фильтра
	 */
	public function __construct(FormManager_Model_Field_Abstract $field, array $options) {
		// TODO нужно реализовать проверку где происходит валидация
//		if (!is_integer($this->filter_iterator)){
//			throw new FormManager_Filter_Exception('Validate field is not running', 601);
//		}
		$this->field = $field;
	}

	/**
	 * Проверяет поле
	 * 
	 * @throws FormManager_Filter_Exception
	 */
	abstract public function valid();

	/**
	 * Генерирует исключение при проверки поля фильтром
	 * 
	 * @throws FormManager_Filter_Exception
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 * 
	 * @return void
	 */
	private function trigger($key, $params = array()){
		// добавление сообщения из языковой темы и название поля
		array_unshift($params, FormManager_Language::getMessage('filter-'.$key), $this->field->getTitle());
		// создание исключения
		throw new FormManager_Filter_Exception(
			call_user_func_array('sprintf', $params),
			$this,
			$this->options
		);
	}
}