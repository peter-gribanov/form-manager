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
 * Класс описывает форму и позволяет ее динамически составлять
 * 
 * Форма это частный случай коллекции
 * TODO нужно ввести понятие подписания формы
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Form extends FormManager_Collection_Abstract {

	/**
	 * Конструктор
	 * 
	 * @param string|null $name     Имя формы
	 * @param string|null $elements Список элементов
	 * @param string|null $label    Подпись формы
	 * @param string      $method   Метод отправки формы
	 */
	public function __construct($name = null, $elements = null, $label = null, $method = 'post') {
		parent::__construct($name, $elements);
		$this
			->addDecorator('action', '')
			->addDecorator('method', $method)
			->addDecorator('id', new FormManager_Decorator_ElementId('ele', '-'))/*
			->addDecorator('controls', 'submit')*/;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_NoAction
	 * 
	 * @param FormManager_Collection_Interface $parent
	 */
	public function setParent(FormManager_Collection_Interface $parent) {
		// TODO описать исключение
		throw new FormManager_Exceptions_NoAction();
	}

}