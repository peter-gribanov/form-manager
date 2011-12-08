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
 * Элемент формы
 * 
 * @package FormManager\Model
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Model_Element implements FormManager_Interfaces_Model {

	/**
	 * TODO добавить описание
	 * 
	 * @var array
	 */
	private $childs = array();

	/**
	 * TODO добавить описание
	 * 
	 * @var FormManager_Model_Element
	 */
	private $parent = null;

	/**
	 * TODO добавить описание
	 * 
	 * @var FormManager_Model_Element
	 */
	private $root = null;

	/**
	 * TODO добавить описание
	 * 
	 * @var string
	 */
	private $name = '';

	/**
	 * TODO добавить описание
	 * 
	 * @var string
	 */
	private $comment = '';


	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Model_Element $element
	 */
	public function add(FormManager_Model_Element $element) {
		$element->setParent($this);
		$element->setRoot($this->root);
		$this->childs[] = $element;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Model_Element $element
	 */
	public function setParent(FormManager_Model_Element $element) {
		if ($element === $this) {
			// TODO описать исключение
			throw FormManager_Exceptions_Model_Element();
		}
		$this->parent = $element;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Model_Element
	 */
	protected function getParent() {
		return $this->parent;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Model_Element $element
	 */
	public function setRoot(FormManager_Model_Element $element) {
		if ($element === $this->root) {
			// TODO описать исключение
			throw FormManager_Exceptions_Model_Element();
		}
		$this->root = $element;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Model_Element
	 */
	protected function getRoot() {
		return $this->root;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return array
	 */
	public function getChilds() {
		return $this->childs;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param integer $id
	 * 
	 * @return FormManager_Model_Element
	 */
	public function getChild($id) {
		if (!is_integer($id)) {
			// TODO описать исключение
			throw FormManager_Exceptions_Model_Element();
		}
		if (!isset($this->childs[$id])) {
			// TODO описать исключение
			throw FormManager_Exceptions_Model_Element();
		}
		return $this->childs[$id];
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $name
	 * 
	 * @return FormManager_Model_Element|boolean
	 */
	public function getChildByName($name) {
		$id = $this->search($element);
		if ($id !== false) {
			return $this->childs[$id];
		}
		return false;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Model_Element $element
	 * 
	 * @return integer|boolean
	 */
	public function search(FormManager_Model_Element $element) {
		foreach ($this->childs as $key=>$el) {
			if ($el === $element) {
				return $key;
			}
		}
		return false;
	}


	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $name
	 * 
	 * @return integer|boolean
	 */
	public function searchByName($name) {
		if (!is_string($name) || !trim($name)) {
			// TODO описать исключение
			throw FormManager_Exceptions_Model_Element();
		}
		foreach ($this->childs as $key=>$el) {
			if ($el->getName() == $name) {
				return $key;
			}
		}
		return false;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Model_Element $element
	 * 
	 * @return boolean
	 */
	public function remove(FormManager_Model_Element $element) {
		$id = $this->search($element);
		if ($id !== false) {
			unset($this->childs[$id]);
			return true;
		}
		return false;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function removeByName($name) {
		$id = $this->searchByName($name);
		if ($id !== false) {
			unset($this->childs[$id]);
			return true;
		}
		return false;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $name
	 */
	public function setName($name) {
		if (!is_string($name) || !trim($name)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_Model_Element();
		}
		$this->name = $name;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return string
	 */
	protected function getName() {
		return $this->name;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $comment
	 */
	public function setComment($comment) {
		if (!is_string($comment) || !trim($comment)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_Model_Element();
		}
		$this->comment = $comment;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return string
	 */
	protected function getComment() {
		return $this->comment;
	}

	/**
	 * Очищает список элементов
	 */
	public function clear() {
		unset($this->childs);
		$this->childs = array();
	}

	/**
	 * Проверяет пуста ли коллекция
	 * 
	 * @return boolean
	 */
	public function isEmpty() {
		return !$this->childs;
	}

}