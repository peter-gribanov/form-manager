<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerFieldHidden extends FormManagerElement {

	/**
	 * Выводит поле
	 * 
	 * @return	void
	 */
	public function draw(){
		$params = $this->options['view'][1];
		include FormManagerForm::getTemplatePath('hidden.element.php');
	}

}