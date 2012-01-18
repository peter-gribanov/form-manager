<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 91 $
 * @since     $Date: 2011-11-19 16:54:33 +0300 (Sat, 19 Nov 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Класс описывает многострочное поле ввода
 * 
 * @package FormManager\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Field_TextArea extends FormManager_Field_String {

	/**
	 * Конструктор
	 */
	public function __construct() {
		parent::__construct();
		$this->setDecorator('template', 'textarea');
		// TODO реализовать базовую инициализацию элемента
	}

}