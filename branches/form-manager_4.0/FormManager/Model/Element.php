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
	 * @var string
	 */
	private $title = '';

	/**
	 * TODO добавить описание
	 * 
	 * @var array|null
	 */
	private $names_list = null;


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
	public function getParent() {
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
	public function getName() {
		return $this->name;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return array
	 */
	public function getNamesList() {
		if ($this->names_list === null) {
			$this->names_list = array_merge(
				array($this->name),
				$this->getParent()->getNamesList()
			);
		}
		return $this->names_list;
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
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $title
	 */
	public function setTitle($title) {
		if (!is_string($title) || !trim($title)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_Model_Element();
		}
		$this->title = $title;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return string
	 */
	protected function getTitle() {
		return $this->title;
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

	/**
	 * Метод для сериализации класса
	 * 
	 * @return string Сериализованная коллекция
	 */
	public function serialize(){
		return serialize(array(
			$this->childs,
			$this->parent,
			$this->root,
			$this->name,
			$this->comment
		));
	}

	/**
	 * Метод для десериализации класса
	 * 
	 * @param string $data Сериализованная коллекция
	 */
	public function unserialize($data){
		list(
			$this->childs,
			$this->parent,
			$this->root,
			$this->name,
			$this->comment
		) = unserialize($data);
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export(){
		return array(
			'childs'  => $this->childs,
			'parent'  => $this->parent,
			'root'    => $this->root,
			'name'    => $this->name,
			'comment' => $this->comment
		);
	}

}