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
 * Класс исключений для фильтров
 * 
 * @package FormManager\Filter
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Exception extends FormManager_Exception {

	/**
	 * Объект поля формы
	 * 
	 * @var FormManager_Model_Field_Abstract
	 */
	private $field;

	/**
	 * Параметры фильтра
	 * 
	 * @var array
	 */
	private $filter;


	/**
	 * Конструктор
	 * 
	 * @param string                           $message Сообщение
	 * @param FormManager_Model_Field_Abstract $field   Объект элемента
	 * @param array                            $filter  Параметры фильтра
	 */
	public function __construct($message, FormManager_Model_Field_Abstract &$field, &$filter){
		parent::__construct($message, 300);
		$this->field = & $field;
		$this->filter = & $filter;
	}

	/**
	 * Возвращает объект поля формы
	 * 
	 * @return FormManager_Filter_Abstract Объект элемента
	 */
	public function getField(){
		return $this->field;
	}

	/**
	 * Возвращает имя фильтра
	 * 
	 * @return string Имя фильтра
	 */
	public function getFilterName(){
		return $this->filter[0];
	}

	/**
	 * Возвращает параметры фильтра
	 * 
	 * @return array Параметры фильтра
	 */
	public function getFilterParams(){
		return $this->filter[1];
	}

}