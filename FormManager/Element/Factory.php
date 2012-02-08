<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 98 $
 * @since     $Date: 2011-11-22 23:49:26 +0400 (Вт., 22 нояб. 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Фабрика элементов формы
 * 
 * @package FormManager\Element
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Element_Factory {

	/**
	 * Возвращает поле Select
	 * 
	 * @return FormManager_Element_Select
	 */
	public function Select(){
		return new FormManager_Element_Select();
	}

	/**
	 * Возвращает поле String
	 * 
	 * @return FormManager_Element_String
	 */
	public function String(){
		return new FormManager_Element_String();
	}

	/**
	 * Возвращает поле Text
	 * 
	 * @return FormManager_Element_Text
	 */
	public function Text(){
		return new FormManager_Element_Text();
	}

}