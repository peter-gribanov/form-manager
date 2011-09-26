<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.22 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @link		http://peter-gribanov.ru/#open-source/form-manager
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerHidden extends FormManagerElement {

	/**
	 * Конструктор
	 * 
	 * @return	void
	 */
	public function __construct(){
		$this->setView('hidden');
	}

	/**
	 * Выводит элемент
	 * 
	 * @return	void
	 */
	public function draw(){
		include './skin/'.$this->form->getSkin().'.hidden.element.php';
	}

}