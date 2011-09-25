<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @package	FormManager
 * @author	Peter Gribanov
 * @since	25.11.2010
 * @version	1.0
 */
class FormManagerHidden extends FormManagerElement {

	/**
	 * Конструктор
	 * 
	 * @return void
	 */
	public function __construct(){
		$this->setView('hidden');
	}

	/**
	 * Выводит поле
	 * 
	 * @return void
	 */
	public function draw(){
		include './skin/'.$this->form->getSkin().'.hidden.element.php';
	}

}