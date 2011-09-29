<?php

/**
 * Вложенная коллекция элиментов формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		4.0 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager_4.0/
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerNestedCollection extends FormManagerCollection {

	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManagerForm $form
	 * @return FormNestedCollection
	 */
	public function setForm(FormManagerForm $form){
		parent::setForm($form);
		foreach ($this as $item){
			$item->setForm($form);
		}
		return $this;
	}

	/**
	 * Добавляет элемент
	 *
	 * @param FormManagerItem $item
	 * @return FormManagerNestedCollection
	 */
	public function add(FormManagerItem $item){
		$this->items[] = $item;
		return $this;
	}

	/**
	 * Рисует коллекцию элиментов
	 * 
	 * @return void
	 */
	public function draw(){
		if (!$this->isEmpty()){
			include FormManagerForm::getTemplatePath('nested.collection.php');
		}
	}

}