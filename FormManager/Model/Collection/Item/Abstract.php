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
 * Абстрактный класс коллекции элементов формы
 * 
 * @package FormManager\Model\Collection\Item
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Model_Collection_Item_Abstract implements FormManager_Interfaces_Model_Collection_Item {

	/**
	 * Объект формы
	 * 
	 * @var	FormManager_Model_Form
	 */
	protected $form;


	/**
	 * Устанавливает форму
	 * 
	 * Устанавливает объект формы к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManager_Model_Form $form Объект формы
	 * 
	 * @return FormManager_Model_Collection_Item_Abstract Объект коллекции
	 */
	public function setForm(FormManager_Model_Form $form){
		$this->form = $form;
		// устанавливаем форму дочерним элементам
		foreach ($this->items as $item) {
			$item->setForm($form);
		}
		return $this;
	}

}