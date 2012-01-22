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
 * Класс описывает элемент ввода формы
 * 
 * @package FormManager\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Field_Abstract extends FormManager_Element_Abstract implements FormManager_Field_Interface {

	/**
	 * Получить значение элемента.
	 */
	public function getValue() {
		// TODO требуется реализация
	}

	/**
	 * Установить значение элемента.
	 *
	 * @param unknown_type $value TODO добавить описание параметра
	 */
	public function setValue($value) {
		// TODO требуется реализация
	}

	/**
	 * Получить значение элемента по умолчанию
	 *
	 * @param boolean $filtred TODO добавить описание параметра
	 *
	 * @return mixed
	 */
	public function getDefaultValue($filtred = true) {
		// TODO требуется реализация
	}

	/**
	 * Установить значение по умолчанию
	 *
	 * @param mixed $value TODO добавить описание параметра
	 *
	 * @return Cms_Form_Element_Interface
	 */
	public function setDefaultValue($value) {
		// TODO требуется реализация
	}

	/**
	 * Устанавливает значение поля
	 * 
	 * @param mixid $val
	 * 
	 * @return boolean
	 *//*
	public function setDefaultValue($val){
		$this->default = $val;
		return true;
	}*/

	/**
	 * Возвращает значение поля
	 * 
	 * @return mixid
	 *//*
	public function getDefaultValue(){
		return $this->default;
	}*/

	/**
	 * Возвращает значение поля
	 * 
	 * TODO по хорошему этот метод больше не должен использоваться
	 * 
	 * @return mixid
	 *//*
	public function getValue(){
		// значение указанное пользователем
		$value = & $this->getSentValue();

		// получение значения для checkbox
		if (is_bool($this->getDefaultValue())){
			if ($value=='on'){
				$value = true;
			} elseif ($value===null && $this->getRoot()->isChanged()){
				$value = false;
			}
		}

		return $value!==null ? $value : $this->getDefaultValue();
	}*/

	/**
	 * Устанавливает значение поля
	 * 
	 * @param mixid $value
	 *//*
	public function setValue($value) {
		$this->value = $value;
	}*/

	/**
	 * Проверить правильно заполнения формы, если ввода данных небыло форма не валидна
	 *
	 * @return boolean
	 */
	public function isValid() {
		if (!$this->isChanged()) {
			return false;
		}
		if (count($this->getErrors()) == 0) {
			// Ошибки генерируются только на getValue
			$this->getValue(true);
		}
		return count($this->getErrors()) == 0 ? true : false;
	}

}