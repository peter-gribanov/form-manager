<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 100 $
 * @since     $Date: 2011-12-02 21:45:59 +0400 (Пт., 02 дек. 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Фасад библиотеки форм
 * 
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Facade {

	/**
	 * Фабрика полей
	 * 
	 * @var FormManager_Field_Factory|null
	 */
	private $field = null;

	/**
	 * Фабрика коллекций
	 * 
	 * @var FormManager_Collection_Factory|null
	 */
	private $collection = null;

	/**
	 * Фабрика фильтров
	 * 
	 * @var FormManager_Filter_Factory|null
	 */
	private $filter = null;

	/**
	 * Вид
	 * 
	 * @var FormManager_Viwe|null
	 */
	private $view = null;

	/**
	 * Форма
	 * 
	 * @var FormManager_Form|null
	 */
	private $form = null;


	/**
	 * Конструктор
	 */
	public function __construct() {
		$this->form = new FormManager_Form();
		$this->view = new FormManager_Viwe();
		$this->field = new FormManager_Field_Factory();
		$this->collection = new FormManager_Collection_Factory();
		$this->filter = new FormManager_Filter_Factory();
	}

	/**
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param  string $id Id языковой темы
	 * 
	 * @return boolean Результат установки темы
	 */
	public static function setLanguageId($id) {
		return FormManager_Language::setId($id);
	}

	/**
	 * Добавляет новое поле
	 * 
	 * @param string                                   $name Название поля
	 * @param FormManager_Field_Interface|string $type Тип поля или объект поля
	 * 
	 * @return FormManager_Field_Interface
	 */
	public function addField($name, $type = 'Text') {
		return $this->addFieldTo($this->form, $name, $type);
	}

	/**
	 * Добавляет новое поле в указанную коллекцию
	 * 
	 * @param FormManager_Collection_Interface   $collection Родительская колекция
	 * @param string                                   $name       Название поля
	 * @param FormManager_Field_Interface|string $type       Тип поля или объект поля
	 * 
	 * @return FormManager_Field_Interface
	 */
	public function addFieldTo(FormManager_Collection_Interface $collection, $name, $type = 'Text') {
		if ($type instanceof FormManager_Field_Interface) {
			$field = $type;
		} else {
			$field = $this->getField($type);
		}
		$field->setName($name);
		$collection->addChild($field);
		return $field;
	}

	/**
	 * Добавляет новую коллекцию
	 * 
	 * @param FormManager_Collection_Interface|string $type Тип коллекции или объект коллекции
	 * 
	 * @return FormManager_Collection_Interface
	 */
	public function addCollection($type = 'Nested') {
		return $this->addCollectionTo($this->form, $type);
	}

	/**
	 * Добавляет новую коллекцию к другой коллекции
	 * 
	 * @param FormManager_Collection_Interface        $collection Родительская коллекция
	 * @param FormManager_Collection_Interface|string $type       Тип коллекции или объект коллекции
	 * 
	 * @return FormManager_Collection_Interface
	 */
	public function addCollectionTo(FormManager_Collection_Interface $collection, $type = 'Nested') {
		if ($type instanceof FormManager_Collection_Interface) {
			return $collection->add($type);
		} else {
			return $collection->add($this->getCollection($type));
		}
	}

	/**
	 * Возвращает новое поле или фабрику полей
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Field_Factory|FormManager_Field_Interface
	 */
	public function getField($name = null){
		return $name !== null ? $this->field->get($name) : $this->field;
	}

	/**
	 * Возвращает новую коллекцию или фабрику коллекций
	 * 
	 * @param string $name Имя коллекции
	 * 
	 * @return FormManager_Collection_Factory|FormManager_Collection_Interface
	 */
	public function getCollection($name = null){
		return $name !== null ? $this->collection->get($name) : $this->collection;
	}

	/**
	 * Возвращает новый фильтр или фабрику фильтров
	 * 
	 * @param string $name Имя фильтра
	 * 
	 * @return FormManager_Filter_Factory|FormManager_Filter_Interface
	 */
	public function getFilter($name = null){
		return $name !== null ? $this->filter->get($name) : $this->filter;
	}

	/**
	 * Возвращает объект текущей формы
	 * 
	 * @return FormManager_Form
	 */
	public function getForm(){
		return $this->form;
	}

	/**
	 * Ищет поле с указанным названием
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Element|boolean
	 */
	public function search($name) {
		// TODO протестировать
		$result = $this->form->getChild($name);
		if (!($result instanceof FormManager_Element)) {
			$result = $this->searchInChilds($this->form, $name);
		}
		return $result;
	}

	/**
	 * Рекурсивно ищет в дочерних элементах элемент с указанным именем
	 * 
	 * @param FormManager_Element $childs
	 * @param string                    $name
	 * 
	 * @return FormManager_Element|boolean
	 */
	private function searchInChilds(FormManager_Element $childs, $name) {
		foreach ($childs as $child) {
			$result = $child->getChild($name);
			if ($result instanceof FormManager_Element) {
				return $child;
			}
			$result = $this->searchInChilds($child, $name);
			if ($result instanceof FormManager_Element) {
				return $child;
			}
		}
		return false;
	}

	/**
	 * Выполняет проверку формы
	 * 
	 * @return boolean
	 *//*
	public function validate() {
		// TODO требуется реализация
		return false;
	}*/

	/**
	 * Рисует форму
	 */
	public function drow() {
		// TODO требуется реализация
	}

	/**
	 * Вернуть массив данных элемента элемента
	 *
	 * @see FormManager_Form::assemble()
	 *
	 * @return array
	 */
	public function assemble() {
		return $this->form->assemble();
	}

	/**
	 * Устанавливает метод отправки формы
	 * 
	 * @throws FormManager_Exceptions_InvalidArgument
	 * 
	 * @param string $method
	 */
	public function setMethod($method) {
		$method = strtolower($method);
		if (!in_array($method, array('post', 'get'))) {
			// TODO описать исключение
			throw new FormManager_Exceptions_InvalidArgument();
		}
		$input = '_'.strtoupper($method);
		$this->form->addDecorator('method', $method)->setValue($$input);
	}

}