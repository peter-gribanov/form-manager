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
 * @package FormManager
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
	 * @param array|null $params Параметры элемента
	 */
	public function __construct(array $params = array()) {
		$params = array_merge(array(
			'children' => array()
		), $params);
		parent::__construct($params);
		// добавление элементов в коллекцию
		$params['children'] = (array)$params['children'];
		foreach ($params['children'] as $child) {
			$this->addChild($child);
		}
	}

	/**
	 * Получить значение элемента
	 * 
	 * @return mixed
	 */
	public function getValue() {
		// TODO требуется реализация
	}

	/**
	 * Установить значение элемента
	 *
	 * @param mixed $value TODO добавить описание параметра
	 * 
	 * @return FormManager_Element_Collection
	 */
	public function setValue($value) {
		// TODO требуется реализация
		return $this;
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
		return $this;
	}

	/**
	 * Установить значение по умолчанию
	 *
	 * @param mixed $value TODO добавить описание параметра
	 * 
	 * @return FormManager_Element_Collection
	 */
	public function setDefaultValue($value) {
		// TODO требуется реализация
		return $this;
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