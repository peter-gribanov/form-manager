<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 41 $
 * @since     $Date: 2011-10-01 00:28:31 +0400 (Сб, 01 окт 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Декоратор элемента
 * 
 * @package FormManager\Decorator
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Decorator_Abstract implements FormManager_Decorator_Interface {

	/**
	 * Элемент формы
	 * 
	 * @var FormManager_Element_Interface
	 */
	protected $element = null;

	/**
	 * Установить элемент декорирования
	 * 
	 * Внимание, элемент декорирования устанавливается только один раз
	 * 
	 * т.к. Если элементу установить декоратор, потом взять его по имени и установить второму элементу
	 * то данный декоратор считается будет декоратором первого элемента, но и дублируется у второго
	 * 
	 * @param FormManager_Element_Interface $element Элемент
	 * 
	 * @return FormManager_Decorator_Abstract
	 */
	public function setElement(FormManager_Element_Interface $element) {
		if ($this->element instanceof FormManager_Element_Interface) {
			// TODO описать исключение
			throw new FormManager_Exceptions_Logic();
		}
		$this->element = $element;
		return $this;
	}

}