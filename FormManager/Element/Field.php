<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 225 $
 * @since     $Date: 2012-01-22 21:47:31 +0400 (Sun, 22 Jan 2012) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Класс описывает элемент ввода формы
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Element_Field extends FormManager_Element_Abstract implements FormManager_Field_Interface {

	/**
	 * Получить значение элемента
	 * 
	 * @return mixed
	 */
	public function getValue() {
		// TODO требуется реализация
	}

	/**
	 * Установить значение элемента.
	 *
	 * @param mixed $value TODO добавить описание параметра
	 * 
	 * @return FormManager_Element_Field
	 */
	public function setValue($value) {
		// TODO требуется реализация
		return $this;
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
	 * @return FormManager_Field_Abstract
	 */
	public function setDefaultValue($value) {
		// TODO требуется реализация
		return $this;
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
		if (!$this->getErrors()) {
			// Ошибки генерируются только на getValue
			$this->getValue(true);
		}
		return !$this->getErrors();
	}

}