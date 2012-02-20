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
 * Коллекция переключатель
 * 
 * В зависимости от входных данных делает активным одного из своих дочерних элементов/коллекций, остальные элементы при этом деактевируются.
 * 
 * TODO возможно стоит наследоваться от коллекции переопределяя некоторые методы
 * TODO проверить работу
 * 
 * @package FormManager
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Element_Switcher extends FormManager_Element_Abstract implements FormManager_Collection_Interface, Countable, IteratorAggregate {

	/**
	 * Элемент переключателя
	 * 
	 * @var FormManager_Element_Abstract|null
	 */
	private $switcher = null;

	/**
	 * Содержит дочерние элементы
	 * 
	 * @var array
	 */
	private $elements = array();

	/**
	 * Список имен и заголовков всех дочерних элементов
	 * 
	 * {name1:label1,name2:label2,...}
	 * 
	 * @var array
	 */
	private $options = array();


	/**
	 * Конструктор
	 *
	 * @param string|null                           $name     Имя элемента
	 * @param FormManager_Element_Interface|null       $switcher Элемент переключателя
	 * @param array|FormManager_Element_Interface|null $elements Элементы коллекции
	 * @param FormManager_Collection_Interface|null    $parent   Родительский элемент
	 */
	public function __construct($name = null, FormManager_Element_Interface $switcher = null, $elements = null, FormManager_Collection_Interface $parent = null) {
		$this->setName($name)->setParent($parent);
		if ($elements instanceof FormManager_Element_Interface) {
			$elements = array($elements->getName() => $elements);
		}
		$elements = is_array($elements) ? $elements : array();
		foreach ($elements as $key => $element) {
			$this->addChildren($element, $key);
		}
		$this->setSwitcher($switcher);
	}

	/**
	 * TODO добавить описание
	 * 
	 * @param FormManager_Element_Interface|null $switcher Объект переключателя
	 * 
	 * @return FormManager_Switcher
	 */
	public function setSwitcher(FormManager_Element_Interface $switcher = null) {
		if ($switcher) {
			if ($options = $switcher->getDecorator('options')) {
				$this->options = array_replace($options, $this->options);
			}
			$value = array_keys($this->options);
			if ($switcher->getDefaultValue(false) === null) {
				$switcher->setDefaultValue(array_shift($value));
			}
			$this->switcher = $switcher
				->setParent($this)
				->addDecorator('options', $this->options)
				->addFilter(new FormManager_Filter_InArray(array_keys($this->options)));
		}
		return $this;
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function getSwitcher() {
		return $this->switcher;
	}

	/**
	 * Добавить дочерний элемент
	 *
	 * @param FormManager_Element_Interface $element  TODO добавить описание параметра
	 * @param string|null                $new_name TODO добавить описание параметра
	 *
	 * @return FormManager_Switcher
	 */
	public function addChildren(FormManager_Element_Interface $element, $new_name = null) {
		$element->setParent($this);
		if (!is_null($new_name) && !$element->getName()) {
			$element->setName((string)$new_name);
		}
		$this->elements[] = $element;
		if ($element->getName() && $element->getDecorator('label')) {
			$this->options[$element->getName()] = $element->getDecorator('label');
		}
		$this->setSwitcher($this->switcher); // обновляем переключатель
		return $this;
	}

	/**
	 * Получить все вложенные элементы
	 *
	 * @param FormManager_Collection_Interface|null $elements TODO добавить описание параметра
	 *
	 * @return array
	 */
	public function getAllChildren(FormManager_Collection_Interface $elements = null) {
		if (is_null($elements)) {
			$elements = $this;
		}
		$ret = array();
		foreach ($elements as $ele) {
			$ret[] = $ele;
			if ($ele instanceof FormManager_Collection_Interface) {
				$ret = array_merge($ret, $this->getAllChildren($ele));
			}
		}
		return $ret;
	}

	/**
	 * Волшебная функция для реализации $obj->value
	 *
	 * @see http://www.php.net/manual/ru/language.oop5.magic.php
	 *
	 * @param string $name TODO добавить описание параметра
	 *
	 * @return mixed
	 */
	public function __get($name) {
		foreach ($this->elements as $element) {
			/**
			 * @var FormManager_Element_Interface $element
			 */
			if ($element->getName() == $name) {
				return $element;
			}
		}
		return null;
	}

	/**
	 * Изменение данных
	 *
	 * @throws Exception
	 *
	 * @param string                    $name    TODO добавить описание параметра
	 * @param FormManager_Element_Abstract $element TODO добавить описание параметра
	 */
	public function __set($name, $element) {
		$this->addChildren($element, $name);
	}

	/**
	 * Возвращает асоциативный массив хранящихся данных
	 *
	 * @param boolean $filtered TODO добавить описание параметра
	 *
	 * @return string
	 */
	public function getValue($filtered = true) {
		$name = $this->switcher->getValue($filtered);
		$ret = array($this->switcher->getName() => $name);
		// получаем данные только из активного блока
		foreach ($this->elements as $element) {
			if ($element->getName() == $name) {
				$ret[$element->getName()] = $element->getValue($filtered);
				break;
			}
		}
		if (count($this->filters) && $filtered) {
			foreach ($this->filters as $filter) {
				$ret = $filter->onGet($ret, $this);
			}
		}
		return $ret;
	}

	/**
	 * Установить значение элемента.
	 * 
	 * @param array $value TODO добавить описание параметра
	 * 
	 * @return FormManager_Switcher
	 */
	public function setValue($value) {
		if (isset($value[$this->getName()]) && $this->filters) {
			foreach (array_reverse($this->filters) as $filter) {
				$value[$this->getName()] = $filter->onSet($value[$this->getName()], $this);
			}
		}
		if (!is_array($value)) {
			throw new Cms_Exception('Ожидался массив');
		}
		if (isset($value[$this->getName()])) {
			$this->changed = true;
			if (isset($value[$this->getName()][$this->switcher->getName()])) {
				$this->switcher->setValue($value[$this->getName()][$this->switcher->getName()]);
			} else {
				$this->switcher->setValue(null);
			}
			$name = $this->switcher->getValue();
			// записываем данные только в активный блок
			foreach ($this->elements as $ele) {
				if ($ele->getName() == $name) {
					if ($ele instanceof FormManager_Collection_Interface) {
						if (isset($value[$this->getName()][$ele->getName()])) {
							$ele->setValue($value[$this->getName()]);
						} else {
							$ele->setValue(array($this->getName() => array()));
						}
					} elseif ($ele instanceof FormManager_Element_Interface) {
						if (isset($value[$this->getName()][$ele->getName()])) {
							$ele->setValue($value[$this->getName()][$ele->getName()]);
						} else {
							$ele->setValue(null);
						}
					}
					break;
				}
			}
		}
		return $this;
	}

	/**
	 * Получить значение элемента по умолчанию
	 *
	 * @param boolean $filtered TODO добавить описание параметра
	 * 
	 * @return array
	 */
	public function getDefaultValue($filtered = true) {
		$ret = array(
			$this->switcher->getName() => $this->switcher->getDefaultValue()
		);
		foreach ($this->elements as $element) {
			$ret[$element->getName()] = $element->getDefaultValue($filtered);
		}
		if ($filtered) {
			foreach ($this->filters as $filter) {
				$ret = $filter->onGet($ret, $this);
			}
		}
		return $ret;
	}

	/**
	 * Установить значение по умолчанию
	 *
	 * @param array $value TODO добавить описание параметра
	 *
	 * @return FormManager_Switcher
	 */
	public function setDefaultValue($value) {
		foreach (array_reverse($this->filters) as $filter) {
			$value = $filter->onSet($value, $this);
		}
		if (!is_array($value)) {
			throw new Cms_Exception('Ожидался массив');
		}
		if (isset($value[$this->switcher->getName()])) {
			$this->switcher->setDefaultValue($value[$this->switcher->getName()]);
		}
		foreach ($this->elements as $ele) {
			if (isset($value[$ele->getName()])) {
				$ele->setDefaultValue($value[$ele->getName()]);
			}
		}
		return $this;
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
		// валидаторы есть у вложенных элементов
		$name = $this->switcher->getValue();
		foreach ($this->elements as $el) {
			if ($el->getName() == $name && $el->getErrors()) {
				return false;
			}
		}
		// у коллекции могут быть свои валидаторы
		if ($this->getErrors()) {
			return false;
		}
		return true;
	}

	/**
	 * Вернуть массив данных элемента элемента
	 * 
	 * @return array
	 */
	public function assemble() {
		$element = array();
		foreach ($this->elements as $el) {
			$element[] = $el->assemble();
		}
		return array_replace(
			parent::assemble(),
			array(
				'switcher' => $this->switcher->assemble(),
				'children' => $element
			)
		);
	}

	/**
	 * Удалить элемент колекции
	 *
	 * @param string $name TODO добавить описание параметра
	 *
	 * @return boolean
	 */
	public function delete($name) {
		foreach ($this->elements as $key => $ele) {
			if ($ele->getName() == $name) {
				$ele->setParent(null);
				unset($this->elements[$key]);
				unset($this->options[$key]);
				$this->setSwitcher($this->switcher); // обновляем переключатель
				return true;
			}
		}
		return false;
	}

	/**
	 * Поддержка isset()
	 *
	 * @param string $name TODO добавить описание параметра
	 *
	 * @return boolean
	 */
	public function __isset($name) {
		foreach ($this->elements as $ele) {
			if ($ele->getName() == $name) {
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
		return count($this->elements);
	}

	/**
	 * Определяет интерфейс IteratorAggregate
	 *
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator($this->elements);
	}

}