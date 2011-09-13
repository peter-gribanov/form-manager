<?php

/**
 * Вложенная коллекция элиментов формы
 * 
 * @package	Form
 * @author	Peter Gribanov
 * @since	07.09.2011
 * @version	1.2
 */
class FormNestedCollection extends FormCollection {

	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormForm $form
	 * @return FormNestedCollection
	 */
	public function setForm(FormForm $form){
		parent::setForm($form);
		foreach ($this as $item){
			$item->setForm($form);
		}
		return $this;
	}

	/**
	 * Добавляет элемент
	 *
	 * @param FormItem $item
	 * @return FormNestedCollection
	 */
	public function add(FormItem $item){
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
			include dirname(dirname(__FILE__)).'/templates/'.$this->form->getTemplate().'/nested.collection.php';
		}
	}

}