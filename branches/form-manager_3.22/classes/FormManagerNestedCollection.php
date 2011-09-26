<?php

/**
 * Вложенная коллекция элементов формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.22 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @tutorial	http://peter-gribanov.ru/#open-source/form-manager
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerNestedCollection extends FormManagerCollection {

	/**
	 * Устанавливает форму к которой пренадлежит элемент
	 * 
	 * Устанавливает объект формы к которой пренадлежит элемент
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param	FormManagerForm	$form	Объект формы
	 * @return	FormManagerNestedCollection	Объект коллекуии
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
	 * @param	FormManagerItem	$item	Объект элемента
	 * @return	FormManagerNestedCollection	Объект коллекции
	 */
	public function add(FormManagerItem $item){
		$this->items[] = $item;
		return $this;
	}

	/**
	 * Рисует коллекцию элементов
	 * 
	 * @access	private
	 * @return	void
	 */
	public function draw(){
		if (!$this->isEmpty()){
			include dirname(__DIR__).'/skin/'.$this->form->getSkin().'.nested.collection.php';
		}
	}

}