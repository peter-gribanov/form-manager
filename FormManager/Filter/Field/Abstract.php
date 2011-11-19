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
	 * @param FormManager_Model_Field_Interface $field   Объект поля
	 * @param array                             $options Параметры фильтра
	 */
	public function __construct(FormManager_Model_Field_Interface &$field, array $options = array()) {
		//@todo нужно реализовать проверку где происходит валидация
//		if (!is_integer($this->filter_iterator)){
//			throw new FormManager_Filter_Exception('Validate field is not running', 301);
//		}
		$this->field   = $field;
		$this->options = $options;
	}

}