<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 94 $
 * @since     $Date: 2011-11-19 17:23:19 +0300 (Sat, 19 Nov 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Фильтра проверки Kcaptcha
 * 
 * @package FormManager\Filter\Field
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Field_Kcaptcha extends FormManager_Filter_Field_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		if (empty($_SESSION['kcaptcha_keystring']) || $_SESSION['kcaptcha_keystring'] != $this->field->getValue()) {
			$this->trigger('kcaptcha');
		}
	}

}