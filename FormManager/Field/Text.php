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
class FormManager_Field_Text extends FormManager_Field_String {

	/**
	 * Конструктор
	 */
	public function __construct() {
		parent::__construct();
		$this
			->addDecorator('template', 'text')
			->addFilter(new FormManager_Filter_NotNull());
	}

}