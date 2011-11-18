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
 * Вложенная коллекция элиментов формы
 * 
 * @package FormManager\Model\Collection
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Collection_Nested extends FormManager_Collection_Primary {

	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManagerForm $form
	 * @return FormNestedCollection
	 *//*
	public function setForm(FormManagerForm $form){
		parent::setForm($form);
		foreach ($this as $item){
			$item->setForm($form);
		}
		return $this;
	}*/

	/**
	 * Добавляет элемент
	 *
	 * @param FormManagerItem $item
	 * @return FormManagerNestedCollection
	 *//*
	public function add(FormManagerItem $item){
		$this->items[] = $item;
		return $this;
	}*/

	/**
	 * Рисует коллекцию элиментов
	 * 
	 * @return	void
	 */
	public function draw(){
		if (!$this->isEmpty())
			include FormManagerForm::getTemplatePath('nested.collection.php');
	}

}