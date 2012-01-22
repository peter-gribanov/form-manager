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
 * @package FormManager\Element
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Element_Abstract implements FormManager_Element_Interface {

	/**
	 * TODO добавить описание
	 * 
	 * @var string
	 */
	private $name = '';

	/**
	 * TODO добавить описание
	 * 
	 * @var FormManager_Collection_Interface|null
	 */
	protected $parent = null;

	/**
	 * Признак что элемент принимал значение
	 *
	 * @var boolean
	 */
	protected $changed = false;

	/**
	 * Список декараторов
	 * 
	 * @var array
	 */
	protected $decorators = array(
//		'template' => ''
	);

	/**
	 * Список фильтров
	 * 
	 * @var array
	 */
	protected $filters = array();

	/**
	 * Значение элемента
	 * 
	 * @var string|null
	 */
	protected $value = null;

	/**
	 * Значение элемента по умолчанию
	 * 
	 * @var string|null
	 */
	protected $default = null;
	

	/**
	 * Конструктор
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $label Подпись элемента
	 */
	public function __construct($name = null, $label = null) {
		$this->setName($name)->addDecorator('label', $label);
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Logic
	 * 
	 * @param FormManager_Collection_Interface $parent
	 * 
	 * @return FormManager_Element_Abstract
	 */
	public function setParent(FormManager_Collection_Interface $parent) {
		if ($parent === $this) {
			// TODO описать исключение
			throw new FormManager_Exceptions_Logic();
		}
		if ($this->parent && $parent) {
			$this->parent->remove($this->getName());
		}
		$this->parent = $parent;
		return $this;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Получить первого предка элемента
	 *
	 * @return FormManager_Collection_Interface|null
	 */
	public function getRoot() {
		$root = $this;
		do {
			$root = $root->getParent();
		} while ($root && $root->getParent());
		return $root;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function setName($name) {
		$this->name = preg_replace('/[^a-zA-Z0-9_\\(\\)\\-]/', '', (string)$name);
		return $this;
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
	 * Получить полное имя элемента
	 *
	 * Полное имя элемента которое будет использоваться на форме,
	 * оно строиться на основе имен предков
	 *
	 * @return string
	 */
	public function getFormName() {
		if ($this->parent instanceof FormManager_Collection_Interface) {
			return $this->parent->getFormName().'['.$this->name.']';
		} else {
			return $this->name;
		}
	}

	/**
	 * Добавляет декоратор
	 * 
	 * @param string $name  Название
	 * @param mixid  $value Значение
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function addDecorator($name, $value) {
		if ($value instanceof FormManager_Decorator_Interface) {
			$this->decorators[$name] = $value->setElement($this);
		} else {
			$this->decorators[$name] = $value;
		}
		return $this;
	}

	/**
	 * Возвращает декоратор для указанного названия
	 * 
	 * @param string $name Название
	 * 
	 * @return string|null
	 */
	public function getDecorator($name) {
		return isset($this->decorators[$name]) ? $this->decorators[$name] : null;
	}

	/**
	 * Определяет изменены ли дочерние элементы
	 * 
	 * @return boolean
	 */
	public function isChanged() {
		return $this->changed;
	}

	/**
	 * Получить сообщения об ошибках
	 *
	 * @return array
	 */
	public function getErrors() {
		$messages = array();
		foreach ($this->filters as $filter) {
			$messages = array_merge($messages, $filter->getErrors());
		}
		$messages = array_merge($messages, $this->getDecorator('errors') ?: array());
		return $messages;
	}

	/**
	 * Получить сообщения об замечаниях
	 *
	 * @return array
	 */
	public function getNotices() {
		$messages = array();
		foreach ($this->filters as $filter) {
			$messages = array_merge($messages, $filter->getNotices());
		}
		return $messages;
	}

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @param FormManager_Filter_Interface $filter Объект фильтра
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function addFilter(FormManager_Filter_Interface $filter) {
		$this->filters[] = $filter;
		return $this;
	}

	/**
	 * Метод для сериализации класса
	 * 
	 * @return string Сериализованная коллекция
	 */
	public function serialize(){
		return serialize(array(
			$this->childs,
			$this->name,
			$this->decorators,
			$this->filters
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
			$this->name,
			$this->decorators,
			$this->filters
		) = unserialize($data);
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function assemble(){
		$decorators = array();
		foreach ($this->decorators as $key => $decorator) {
			if ($decorator instanceof Cms_Form_Decorator_Interface) {
				$decorators[$key] = $decorator->assemble();
			} else {
				$decorators[$key] = $decorator;
			}
		}
		$filters = array();
		foreach ($this->filters as $key => $filter) {
			$filters[] = $filter->assemble();
		}
		return array(
			'name'       => $this->name,
			'full_name'  => $this->getFormName(),
			'valid'      => $this->isValid(),
			'changed'    => $this->isChanged(),
			'decorators' => $decorators,
			'filters'    => $filters,
			'errors'     => $this->getErrors(),
			'notice'     => $this->getNotices(),
		);
	}

}