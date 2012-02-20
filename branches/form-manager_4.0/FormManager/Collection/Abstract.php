<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 210 $
 * @since     $Date: 2012-01-18 21:47:57 +0400 (Wed, 18 Jan 2012) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Класс описывает коллекцию элементов формы
 * 
 * @package FormManager\Collection
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Collection_Abstract extends FormManager_Element_Abstract implements FormManager_Collection_Interface {

	/**
	 * TODO добавить описание
	 * 
	 * @var array
	 */
	private $childs = array();


	/**
	 * Конструктор
	 * 
	 * @param string|null $name     Имя коллекции
	 * @param string|null $elements Список элементов
	 * @param string|null $label    Подпись коллекции
	 */
	public function __construct($name = null, $elements = null, $label = null) {
		parent::__construct($name, $label);
		// добавление элементов в коллекцию
		$elements = $elements ? $elements : array();
		if ($elements instanceof FormManager_Element_Interface) {
			$elements = array($elements);
		}
		foreach ($elements as $el) {
			$this->addChild($el);
		}
	}

	/**
	 * Получить значение элемента.
	 */
	public function getValue() {
		// TODO требуется реализация
	}

	/**
	 * Установить значение элемента.
	 *
	 * @param unknown_type $value TODO добавить описание параметра
	 */
	public function setValue($value) {
		// TODO требуется реализация
	}

	/**
	 * Получить значение элемента по умолчанию
	 *
	 * @param boolean $filtred TODO добавить описание параметра
	 *
	 * @return mixed
	 */
	public function getDefaultValue($filtred = true) {
		// TODO требуется реализация
	}

	/**
	 * Установить значение по умолчанию
	 *
	 * @param mixed $value TODO добавить описание параметра
	 *
	 * @return FormManager_Collection_Abstract
	 */
	public function setDefaultValue($value) {
		// TODO требуется реализация
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Element_Interface $element
	 * 
	 * @return FormManager_Collection_Abstract
	 */
	public function addChild(FormManager_Element_Interface $element) {
		$this->childs[] = $element->setParent($this);
		return $this;
	}

	/**
	 * Добавляет в коллекцию список элементов
	 * 
	 * @param array $childs Список элементов
	 * 
	 * @return FormManager_Element_Builder
	 */
	public function addChilds(array $childs = array()) {
		foreach ($childs as $child) {
			$this->addChild($child);
		}
		return FormManager_Element_Builder::getInstance($this);
	}

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 * 
	 * @throws FormManager_Exceptions_InvalidArgument
	 * 
	 * @param string $query
	 *//*
	public function addByQuery($query) {
		if (!is_string($query) || !trim($query)) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}

		// выделение тела запроса если передан не только запрос
		if (strpos($query, '?') !== false) {
			if (substr_count($query, '?') > 1) {
				// TODO описать исключение
				throw new FormManager_Exceptions_InvalidArgument();
			}
			list(, $query) = explode('?', $query, 2);
		}

		$query = explode('&', $query);
		foreach ($query as $param) {
			if (substr_count($param, '=') != 1) {
				throw new FormManager_Exceptions_InvalidArgument('Cant add element because of improper URL query');
			}
			list($name, $value) = explode('=', $param, 2);
			$field = new FormManager_Field_Hidden();
			$field->setName($name);
			$field->setDefaultValue($value);
			$this->add($field);
		}
	}*/

	/**
	 * TODO добавить описание
	 * 
	 * @return array
	 *//*
	public function getChilds() {
		return $this->childs;
	}*/

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return FormManager_Element_Interface|null
	 */
	public function getChild($name) {
		foreach ($this->childs as $key => $el) {
			if ($el->getName() == $name) {
				return $this->childs[$key];
			}
		}
		return null;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function remove($name) {
		foreach ($this->childs as $key => $el) {
			if ($el->getName() == $name) {
				unset($this->childs[$key]);
				return true;
			}
		}
		return false;
	}

	/**
	 * Проверить правильно заполнения формы, если ввода данных небыло форма не валидна
	 * 
	 * @return boolean
	 */
	public function isValid() {
		if (!$this->isChanged()) {
			return false;
		}
		if (count($this->getErrors()) == 0) {
			// TODO Из за этой строки ломался аплоад файлов Смотреть /test/mediaprocessor.html
			//$this->getValue(true); // TODO Ошибки генерируются только на getValue
			$this->assemble();
		}
		// валидаторы есть у вложенных элементов
		foreach ($this as $element) {
			if (count($element->getErrors()) != 0) {
				return false;
			}
		}
		// у коллекции могут быть свои валидаторы
		if (count($this->getErrors()) != 0) {
			return false;
		}
		return true;
	}

	/**
	 * Волшебная функция для реализации $obj->value
	 * 
	 * @param string $name TODO добавить описание параметра
	 * 
	 * @return FormManager_Element_Interface|null
	 */
	public function __get($name) {
		return $this->getChild($name);
	}

	/**
	 * Изменение данных
	 * 
	 * @param string                        $name    TODO добавить описание параметра
	 * @param FormManager_Element_Interface $element TODO добавить описание параметра
	 */
	public function __set($name, FormManager_Element_Interface $element) {
		$this->addChild($element->setName($name));
	}

	/**
	 * Поддержка isset()
	 * 
	 * @param string $name TODO добавить описание параметра
	 * 
	 * @return boolean
	 */
	public function __isset($name) {
		foreach ($this->childs as $el) {
			if ($el->getName() == $name) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Определяет интерфейс Countable
	 * 
	 * @return integer
	 */
	public function count() {
		return count($this->childs);
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator($this->childs);
	}

	/**
	 * Метод для сериализации класса
	 * 
	 * @return string Сериализованная коллекция
	 */
	public function serialize(){
		return serialize(array(
			$this->childs,
			parent::serialize()
		));
	}

	/**
	 * Метод для десериализации класса
	 * 
	 * @param string $data Сериализованная коллекция
	 */
	public function unserialize($data){
		list($this->childs, $data) = unserialize($data);
		parent::unserialize($data);
	}

	/**
	 * Вернуть массив данных элемента элемента
	 * 
	 * @see FormManager_Element_Abstract::assemble()
	 * 
	 * @return array
	 */
	public function assemble() {
		$childs = array();
		foreach ($this->childs as $el) {
			$childs[$el->getName()] = $el->assemble();
		}
		return array_replace(parent::assemble(), array('childs' => $childs));
	}

}