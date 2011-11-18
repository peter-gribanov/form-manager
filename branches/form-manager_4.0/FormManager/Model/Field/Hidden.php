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
 * @package FormManager\Model\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Field_Hidden extends FormManager_Model_Field {

	/**
	 * Выводит поле
	 */
	public function draw() {
		$params = $this->options['view'][1];
		include FormManagerForm::getTemplatePath('hidden.element.php');
	}

}