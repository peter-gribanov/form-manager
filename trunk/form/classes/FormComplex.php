<?php

/**
 * Интерфейс для комплексных компонентов использующих компонент формы
 * 
 * @package	Form
 * @author	Peter Gribanov
 * @since	07.09.2011
 * @version	1.0
 */
interface FormComplex {

	/**
	 * Устанавливает объект формы
	 * 
	 * @param FormForm $form
	 * @return void
	 */
	public function setForm(FormForm $form);

}