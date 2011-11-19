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
 * Вопрос по умолчанию
 * 
 * @package FormManager\Model\Question
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Model_Question_Abstract extends FormManager_Model_Collection_Item_Abstract implements FormManager_Model_Question_Interface {

	/**
	 * Заголовок для поля
	 * 
	 * @var string
	 */
	protected $title = '';

	/**
	 * Комментарий для поля
	 * 
	 * @var string
	 */
	protected $comment = '';


	/**
	 * Устанавливает заголовок для поля
	 * 
	 * @throws FormManager_Model_Question_Exception
	 * 
	 * @param string $title Текст вопроса
	 * 
	 * @return FormManager_Model_Question_Interface
	 */
	public function setTitle($title){
		if (!is_string($title) || !trim($title)) {
			throw new FormManager_Model_Question_Exception('Element title must be not empty string', 901);
		}
		$this->title = $title;
		return $this;
	}

	/**
	 * Возвращает заголовок для поля
	 * 
	 * @return string
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 * Устанавливает комментарий для поля
	 * 
	 * @throws FormManager_Model_Question_Exception
	 * 
	 * @param string $comment Текст комментария
	 * 
	 * @return FormManager_Model_Question_Interface
	 */
	public function setComment($comment){
		if (!is_string($comment) || !trim($comment)) {
			throw new FormManager_Model_Question_Exception('Element comment must be not empty string', 902);
		}
		$this->comment = $comment;
		return $this;
	}

	/**
	 * Возвращает комментарий для поля
	 * 
	 * @return string
	 */
	public function getComment(){
		return $this->comment;
	}

	/**
	 * Метод для сериализации класса
	 *
	 * @return string
	 */
	public function serialize(){
		return serialize($this->export());
	}

	/**
	 * Метод для десериализации класса
	 *
	 * @param string $data
	 * 
	 * @return FormManager_Model_Collection_Abstract
	 */
	public function unserialize($data){
		list($this->title, $this->comment) = unserialize($data);
		return $this;
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export(){
		return array(
			$this->title,
			$this->comment
		);
	}

}