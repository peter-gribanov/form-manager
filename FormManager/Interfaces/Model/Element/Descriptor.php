<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 41 $
 * @since     $Date: 2011-10-01 00:28:31 +0400 (Сб, 01 окт 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Интерфейс модели элемента формулирующая описательную часть элементов
 * 
 * @package FormManager\Interfaces
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Element_Descriptor {

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 */
	public function setName($name);

	/**
	 * TODO добавить описание
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * TODO добавить описание
	 * 
	 * @return array
	 */
	public function getNamesList();

	/**
	 * TODO добавить описание
	 * 
	 * @param string $comment
	 */
	public function setComment($comment);

	/**
	 * TODO добавить описание
	 * 
	 * @param string $title
	 */
	public function setTitle($title);

	/**
	 * Устанавливает флаг что есть поля обязательные для заполнения
	 */
	public function required();

	/**
	 * Проверяет есть ли поля обязательные для заполнения
	 * 
	 * @return boolean
	 */
	public function isRequired();

}