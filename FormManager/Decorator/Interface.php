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
 * Интерфейс декоратора элемента
 * 
 * @package FormManager\Decorator
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Decorator_Interface {

	/**
	 * Установить элемент декорирования
	 *
	 * @param FormManager_Element_Interface $element Элемент
	 *
	 * @return FormManager_Decorator_Interface
	 */
	public function setElement(FormManager_Element_Interface $element);

	/**
	 * Сгенерировать значение декоратора
	 * 
	 * @return array
	 */
	public function assemble();

}