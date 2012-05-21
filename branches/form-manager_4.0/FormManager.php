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
 * Основной интерфейс библиотеки форм
 * 
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager {

	/**
	 * Фабрика полей
	 * 
	 * @var FormManager_Field_Factory|null
	 */
//	private $field = null;

	/**
	 * Фабрика коллекций
	 * 
	 * @var FormManager_Collection_Factory|null
	 */
//	private $collection = null;

	/**
	 * Фабрика элементов
	 * 
	 * @var FormManager_Element_Factory|null
	 */
//	private $element = null;

	/**
	 * Фабрика фильтров
	 * 
	 * @var FormManager_Filter_Factory|null
	 */
//	private $filter = null;

	/**
	 * Вид
	 * 
	 * @var FormManager_View|null
	 */
//	private $view = null;

	/**
	 * Форма
	 * 
	 * @var FormManager_Element_Form|null
	 */
	private $form = null;

	/**
	 * Обработчик успешного заполнения
	 * 
	 * @var callback|Closure|null
	 */
	private $callback = null;

	/**
	 * Пользовательские данные
	 *
	 * @var array
	 */
	private $input = null;

	/**
	 * Название шаблона
	 * 
	 * @var string
	 */
	private $template = FormManager_Template::DEFAULT_TEMPLATE;


	/**
	 * Конструктор
	 * 
	 * @param string|null $name   Имя формы
	 * @param string|null $label  Подпись формы
	 * @param string|null $method Метод отправки формы
	 */
	public function __construct($name = null, $label = null, $method = 'post') {
		$this->form = new FormManager_Element_Form($name, null, $label, $method);
//		$this->view = new FormManager_View();
//		$this->field = new FormManager_Field_Factory();
//		$this->collection = new FormManager_Collection_Factory();
//		$this->element = new FormManager_Element_Factory($this->template);
//		$this->filter = new FormManager_Filter_Factory();
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
	 * Устанавливает название шаблона
	 * 
	 * @throws FormManager_Exceptions_InvalidArgument
	 * 
	 * @param string $template Название шаблона
	 */
	public function setTemplate($template) {
		if (is_dir(FORM_MANAGER_TEMPLATES_PATH.'/'.$template)) {
			// TODO описать исключение
			//throw new FormManager_Exceptions_InvalidArgument();
			$this->template = $template;
		}
		return $this;
	}

	/**
	 * Добавляет новое поле
	 * 
	 * @param string                                   $name Название поля
	 * @param FormManager_Field_Interface|string $type Тип поля или объект поля
	 * 
	 * @return FormManager_Field_Interface
	 *//*
	public function addField($name, $type = 'Text') {
		return $this->addFieldTo($this->form, $name, $type);
	}*/

	/**
	 * Добавляет новое поле в указанную коллекцию
	 * 
	 * @param FormManager_Collection_Interface   $collection Родительская колекция
	 * @param string                                   $name       Название поля
	 * @param FormManager_Field_Interface|string $type       Тип поля или объект поля
	 * 
	 * @return FormManager_Field_Interface
	 *//*
	public function addFieldTo(FormManager_Collection_Interface $collection, $name, $type = 'Text') {
		if ($type instanceof FormManager_Field_Interface) {
			$field = $type;
		} else {
			$field = $this->createField()->$type();
		}
		$field->setName($name);
		$collection->addChild($field);
		return $field;
	}*/

	/**
	 * Добавляет новую коллекцию
	 * 
	 * @param FormManager_Collection_Interface|string $type Тип коллекции или объект коллекции
	 * 
	 * @return FormManager_Collection_Interface
	 *//*
	public function addCollection($type = 'Nested') {
		return $this->addCollectionTo($this->form, $type);
	}*/

	/**
	 * Добавляет новую коллекцию к другой коллекции
	 * 
	 * @param FormManager_Collection_Interface        $collection Родительская коллекция
	 * @param FormManager_Collection_Interface|string $type       Тип коллекции или объект коллекции
	 * 
	 * @return FormManager_Collection_Interface
	 *//*
	public function addCollectionTo(FormManager_Collection_Interface $collection, $type = 'Nested') {
		if ($type instanceof FormManager_Collection_Interface) {
			return $collection->add($type);
		} else {
			return $collection->add($this->getCollection($type));
		}
	}*/

	/**
	 * Возвращает фабрику полей
	 * 
	 * @return FormManager_Field_Factory
	 *//*
	public function createField(){
		return $this->field;
	}*/

	/**
	 * Возвращает фабрику коллекций
	 * 
	 * @return FormManager_Collection_Factory
	 *//*
	public function createCollection(){
		return $this->collection;
	}*/

	/**
	 * Возвращает фабрику элементов
	 * 
	 * @return FormManager_Element_Factory
	 *//*
	public function createElement(){
		return $this->element;
	}*/

	/**
	 * Возвращает фабрику фильтров
	 * 
	 * @return FormManager_Filter_Factory
	 *//*
	public function createFilter(){
		return $this->filter;
	}*/

	/**
	 * Возвращает объект текущей формы
	 * 
	 * @return FormManager_Element_Form
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
	 *//*
	public function search($name) {
		// TODO протестировать
		$result = $this->form->getChild($name);
		if (!($result instanceof FormManager_Element)) {
			$result = $this->searchInChilds($this->form, $name);
		}
		return $result;
	}*/

	/**
	 * Рекурсивно ищет в дочерних элементах элемент с указанным именем
	 * 
	 * @param FormManager_Element $childs
	 * @param string                    $name
	 * 
	 * @return FormManager_Element|boolean
	 *//*
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
	}*/

	/**
	 * Рисует форму
	 *//*
	public function drow() {
		// TODO требуется реализация
	}*/

	/**
	 * Вернуть массив данных элемента элемента
	 *
	 * @see FormManager_Element_Form::assemble()
	 *
	 * @return array
	 */
	public function assemble() {
		$this->form->setValue($this->input);
		$values = $this->form->getValue();
		if ($this->form->isValid() && $this->callback) {
			try {
				$message = call_user_func_array($this->callback, array($values));
					$this->form->addDecorator(
					'success',
					array_merge(
						$this->form->getDecorator('success') ?: array(),
						array(array($message))
					)
				);
			} catch (FormManager_Exception $e) {
				$this->form->addDecorator(
					'errors',
					array_merge(
						$this->form->getDecorator('errors') ?: array(),
						array(array($e->getMessage()))
					)
				);
			}
		}
		return $this->form->assemble();
	}

	/**
	 * Устанавливает метод отправки формы
	 * 
	 * @param string $method
	 * 
	 * @return FormManager
	 */
	public function setMethod($method) {
		$method = strtolower(trim($method));
		if (in_array($method, array('post', 'get'))) {
			$input = '_'.strtoupper($method);
			$this->form->addDecorator('method', $method);
			$this->setValue($$input);
		}
		return $this;
	}

	/**
	 * Устанавливает обработчик успешного заполнения
	 * 
	 * @param callback|Closure $callback Обработчик успешного заполнения
	 * 
	 * @return FormManager
	 */
	public function setAction($callback) {
		// TODO проверить как is_callable работает с Closure
		if (is_callable($callback) || (class_exists('Closure') && $callback instanceof Closure)) {
			$this->callback = $callback;
		}
		return $this;
	}

	/**
	 * Устанавливает пользовательские данные
	 * 
	 * @param array|null $value Пользовательские данные
	 * 
	 * @return FormManager
	 */
	public function setValue(array $value = array()) {
		$this->input = $value;
		return $this;
	}

}