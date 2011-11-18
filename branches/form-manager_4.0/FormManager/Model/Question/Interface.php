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
 * Интерфейс модели вопроса
 * 
 * @package FormManager\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Model_Question_Interface extends FormManager_Model_Interface {

	/**
	 * Устанавливает форму
	 * 
	 * Устанавливает объект формы к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManager_Form $form Объект формы
	 * 
	 * @return FormManager_Model_Question_Interface Объект вопроса
	 */
	public function setForm(FormManager_Form $form);

}