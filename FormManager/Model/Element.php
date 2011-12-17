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
	 * @var FormManager_Model_Element|null
	 */
	private $parent = null;

	/**
	 * TODO добавить описание
	 * 
	 * @var FormManager_Model_Element|null
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
	 * Есть поля обязательные для заполнения
	 * 
	 * @var boolean
	 */
	private $required = false;


	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Model_Element $element
	 * 
	 * @return FormManager_Model_Element
	 */
	public function add(FormManager_Model_Element $element) {
		$element->setParent($this);
		$element->setRoot($this->getRoot());
		$this->childs[] = $element;
		return $element;
	}

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 *
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param string $query
	 */
	public function addByQuery($query) {
		if (!is_string($query) || !trim($query)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_Model_Element();
		}

		// выделение тела запроса если передан не только запрос
		if (strpos($query, '?') !== false) {
			if (substr_count($query, '?') > 1) {
				// TODO описать исключение
				throw new FormManager_Exceptions_Model_Element();
			}
			list(, $query) = explode('?', $query, 2);
		}

		$query = explode('&', $query);
		foreach ($query as $param) {
			if (substr_count($param, '=') != 1) {
				throw new FormManager_Exceptions_Model_Element('Cant add element because of improper URL query');
			}
			list($name, $value) = explode('=', $param, 2);
			$field = new FormManager_Model_Field_Hidden();
			$field->setName($name);
			$field->setDefaultValue($value);
			$this->add($field);
		}
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
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
	 * @throws FormManager_Exceptions_Model_Element
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
	 * @param string $name
	 * 
	 * @return FormManager_Model_Element|boolean
	 */
	public function getChild($name) {
		$id = $this->getChildId($element);
		if ($id !== false) {
			return $this->childs[$id];
		}
		return false;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Element
	 * 
	 * @param integer $id
	 * 
	 * @return FormManager_Model_Element|null
	 */
	protected function getChildById($id) {
		if (!is_integer($id)) {
			// TODO описать исключение
			throw FormManager_Exceptions_Model_Element();
		}
		return isset($this->childs[$id]) ? $this->childs[$id] : null;
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
	protected function getChildId($name) {
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
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function isAdded($name) {
		return (bool)$this->getChildId($name);
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function remove($element_name) {
		$id = $this->getChildId($element_name);
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
			$this->names_list = array($this->name);
			// родительский элимент не доступен для FormManager_Model_Form
			if ($this->getParent() instanceof FormManager_Model_Element) {
				$this->names_list = array_merge(
					$this->names_list,
					$this->getParent()->getNamesList()
				);
			}
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
		// могут быть проблемы с очисткой памяти
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
	 * Устанавливает флаг что есть поля обязательные для заполнения
	 */
	public function required() {
		$this->required = true;
		// родительский элимент не доступен для FormManager_Model_Form
		if ($this->getParent() instanceof FormManager_Model_Element) {
			$this->getParent()->required();
		}
	}

	/**
	 * Проверяет есть ли поля обязательные для заполнения
	 * 
	 * @return boolean
	 */
	public function isRequired() {
		return $this->required;
	}

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param string $name
	 * @param array  $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setFilter($name, $params = null) {
		// TODO требуется реализация
		/*
		if (!is_string($name) || !trim($name)) {
			throw new FormManager_Exceptions_Model_Field('Element filter name must be not empty string');
		}
		$params = $params ? $params : array();
		if (!is_array($params)) {
			throw new FormManager_Exceptions_Model_Field('Element filter parametrs should be an array');
		}
		if (!file_exists(FORM_PATH.'/filters/'.$name.'.php')) {
			throw new FormManager_Exceptions_Model_Field('File of element filter ('.$name.') do not exists');
		}
		$this->options['filters'][] = array($name, $params);
		// Обязательное для заполнения
		if ($name=='empty'){
			$this->required();
		}
		return $this;*/
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