<?php

/**
 * Интерфейс элиментов формы
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
interface FormManagerItem {

	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormManagerForm $form
	 * @return FormManagerItem
	 */
	public function setForm(FormManagerForm $form);
	
	/**
	 * Производит проверку переданных данных 
	 *
	 * @return void
	 */
	public function valid();

	/**
	 * Рисует коллекцию элиментов
	 * 
	 * @return void
	 */
	public function draw();

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param string $post
	 * @return string
	 */
	public function getLangPost($post);

}