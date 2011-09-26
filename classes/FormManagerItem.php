<?php

/**
 * Интерфейс элементов формы
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
interface FormManagerItem {

	/**
	 * Устанавливает форму к которой пренадлежит элемент
	 * 
	 * Устанавливает объект формы к которой пренадлежит элемент
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param	FormManagerForm	$form	Объект формы
	 * @return	FormManagerItem	Объект элемента
	 */
	public function setForm(FormManagerForm $form);
	
	/**
	 * Производит проверку переданных данных 
	 * 
	 * @return	void
	 */
	public function valid();

	/**
	 * Рисует элемент
	 * 
	 * @return void
	 */
	public function draw();

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param	string	$post	Идентификатор сообщения
	 * @return	string	Сообщение
	 */
	public function getLangPost($post);

}