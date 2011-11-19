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
 * Фильтр проверяет с нашего ли хоста отправлена форма
 * 
 * @package FormManager\Filter\Form
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Form_Referer extends FormManager_Filter_Abstract {

	/**
	 * Проверяет поле
	 */
	public function check(){
		// получение тикущего хотса
		$current = ($_SERVER['SERVER_PROTOCOL'][4]=='S' ? 'https' : 'http').'://'
			.$_SERVER['HTTP_HOST'].'/';
		// разрешен прием форм в пределах одного хоста
		if (strpos($_SERVER['HTTP_REFERER'], $current) !== 0) {
			$this->trigger('form-referer');
		}
	}

}