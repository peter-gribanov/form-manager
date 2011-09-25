<?php

/**
 * Вложенная коллекция элиментов формы
 * 
 * @package	FormManager
 * @author	Peter Gribanov
 * @since	29.11.2010
 * @version	1.1
 */
class FormManagerNestedCollection extends FormManagerCollection {

	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManagerForm $form
	 * @return FormManagerNestedCollection
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
			include dirname(dirname(__FILE__)).'/skin/'.$this->form->getSkin().'.nested.collection.php';
		}
	}

}