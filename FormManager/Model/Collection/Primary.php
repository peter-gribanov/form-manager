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
 * Коллекция элиментов формы
 * 
 * @package FormManager\Model\Collection
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Collection_Primary extends FormManager_Model_Collection_Abstract {

	/**
	 * Производит проверку переданных данных
	 *//*
	public function valid(){
		foreach ($this as $item)
			$item->valid();
	}*/

	/**
	 * Рисует коллекцию элиментов
	 *//*
	public function draw(){
		if (!$this->isEmpty())
			include FormManagerForm::getTemplatePath('collection.php');
	}*/

	/**
	 * Возвращает итератор
	 * 
	 * @return	FormManagerIterator
	 *//*
	public function getIterator(){
		return new FormManagerIterator($this->items);
	}*/

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param	string	$post
	 * @return	string
	 *//*
	public function getLangPost($post){
		return $this->form->getLangPost($post);
	}*/

}