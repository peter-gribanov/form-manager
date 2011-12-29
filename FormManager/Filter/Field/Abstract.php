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
	 * Устанавливает объект поля формы
	 * 
	 * @param FormManager_Model_Field_Interface $field   Объект поля
	 * @param array                             $options Параметры фильтра
	 */
	public function __construct(FormManager_Model_Field_Interface $field, array $options = array()) {
		parent::__construct($field, $options);
	}

	/**
	 * Генерирует исключение при проверки поля фильтром
	 * 
	 * @param string $key    Ключ сообщения
	 * @param array  $params Параметры сообщения
	 * 
	 * @return void
	 */
	protected function trigger($key, array $params = array()){
		// добавление текста вопроса
		// TODO не очень хорошо что здесь выполняется export()
		$field = $this->element->export();
		array_unshift($params, $field['title']);
		parent::trigger($key, $params);
	}

}