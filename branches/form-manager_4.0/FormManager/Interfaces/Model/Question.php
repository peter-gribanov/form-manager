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
 * Интерфейс модели вопроса
 * 
 * @package FormManager\Interfaces\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Interfaces_Model_Question extends FormManager_Interfaces_Model_Collection_Item {

	/**
	 * Устанавливает заголовок для поля
	 * 
	 * @param string $title Текст вопроса
	 * 
	 * @return FormManager_Interfaces_Model_Question
	 */
	public function setTitle($title);

	/**
	 * Возвращает заголовок для поля
	 * 
	 * @return string
	 */
	public function getTitle();

	/**
	 * Устанавливает комментарий для поля
	 * 
	 * @param string $comment Текст комментария
	 * 
	 * @return FormManager_Interfaces_Model_Question
	 */
	public function setComment($comment);

	/**
	 * Возвращает комментарий для поля
	 * 
	 * @return string
	 */
	public function getComment();

}