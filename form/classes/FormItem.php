<?php

/**
 * Интерфейс элиментов формы
 * 
 * @package	Form
 * @author	Peter Gribanov
 * @since	25.11.2010
 * @version	1.0
 */
interface FormItem {

	/**
	 * Устанавливает форму к которой пренадлежыт коллекция
	 * Метод предназначен для внутреннего использования
	 * 
	 * @param FormForm $form
	 * @return FormItem
	 */
	public function setForm(FormForm $form);
	
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