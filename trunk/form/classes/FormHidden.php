<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @package	Form
 * @author	Peter Gribanov
 * @since	25.11.2010
 * @version	1.0
 */
class FormHidden extends FormElement {

	/**
	 * Выводит поле
	 * 
	 * @return void
	 */
	public function draw(){
		include dirname(dirname(__FILE__)).'/skin/'.$this->form->getSkin().'.hidden.element.php';
	}

}