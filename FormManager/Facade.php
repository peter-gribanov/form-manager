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
	 * @var FormManager_Model_Form|null
	 */
	private $form = null;


	/**
	 * Конструктор
	 */
	public function __construct() {
		$this->form = new FormManager_Model_Form();
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
	 * @param string $name Название поля
	 * @param string $type Тип поля
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
	public function addField($name, $type = 'Text') {
		return $this->addFieldTo($this->form, $name, $type);
	}

	/**
	 * Добавляет новое поле в указанную коллекцию
	 * 
	 * @param FormManager_Interfaces_Model_Collection $collection Родительская колекция
	 * @param string                                  $name       Название поля
	 * @param string                                  $type       Тип поля
	 * 
	 * @return FormManager_Interfaces_Model_Field
	 */
	public function addFieldTo(FormManager_Interfaces_Model_Collection $collection, $name, $type = 'Text') {
		$field = $this->getField($type);
		$field->setName($name);
		$collection->add($field);
		return $field;
	}

	/**
	 * Добавляет новый вопрос
	 * 
	 * @param string $title   Заголовок вопроса
	 * @param string $comment Коментарий к полю
	 * 
	 * @return FormManager_Interfaces_Model_Question
	 *//*
	public function addQuestion($title, $comment = '') {
		return $this->addQuestionTo($this->form, $title, $comment);
	}*/

	/**
	 * Добавляет новый вопрос к коллекции
	 * 
	 * @param FormManager_Interfaces_Model_Collection $collection Родительская коллекция
	 * @param string                                  $title      Заголовок вопроса
	 * @param string                                  $comment    Коментарий к полю
	 * 
	 * @return FormManager_Interfaces_Model_Question
	 *//*
	public function addQuestionTo(FormManager_Interfaces_Model_Question $collection, $title, $comment = '') {
		$question = new FormManager_Model_Question_Base();
		$question->setTitle($title);
		$question->setComment($comment);
		$collection->add($question);
		return $question;
	}*/

	/**
	 * Добавляет новую коллекцию
	 * 
	 * @param string $type Тип коллекции
	 * 
	 * @return FormManager_Model_Element
	 */
	public function addCollection($type = 'Nested') {
		return $this->addCollectionTo($this->form, $type);
	}

	/**
	 * Добавляет новую коллекцию к другой коллекции
	 * 
	 * @param FormManager_Model_Element $collection Родительская коллекция
	 * @param string                    $type       Тип коллекции
	 * 
	 * @return FormManager_Model_Element
	 */
	public function addCollectionTo(FormManager_Model_Element $collection, $type = 'Nested') {
		return $collection->add($this->getCollection($type));
	}

	/**
	 * Возвращает новое поле или фабрику полей
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Field_Factory|FormManager_Interfaces_Model_Field
	 */
	public function getField($name = null){
		return $name !== null ? $this->field->get($name) : $this->field;
	}

	/**
	 * Возвращает новую коллекцию или фабрику коллекций
	 * 
	 * @param string $name Имя коллекции
	 * 
	 * @return FormManager_Collection_Factory|FormManager_Interfaces_Model_Collection
	 */
	public function getCollection($name = null){
		return $name !== null ? $this->collection->get($name) : $this->collection;
	}

	/**
	 * Возвращает новый фильтр или фабрику фильтров
	 * 
	 * @param string $name Имя фильтра
	 * 
	 * @return FormManager_Filter_Factory|FormManager_Interfaces_Filter
	 */
	public function getFilter($name = null){
		return $name !== null ? $this->filter->get($name) : $this->filter;
	}

	/**
	 * Ищет поле с указанным названием
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Model_Element|boolean
	 */
	public function search($name) {
		// TODO протестировать
		$result = $this->form->getChild($name);
		if (!($result instanceof FormManager_Model_Element)) {
			$result = $this->searchInChilds($this->form, $name);
		}
		return $result;
	}

	/**
	 * Рекурсивно ищет в дочерних элементах элемент с указанным именем
	 * 
	 * @param FormManager_Model_Element $childs
	 * @param string                    $name
	 * 
	 * @return FormManager_Model_Element|boolean
	 */
	private function searchInChilds(FormManager_Model_Element $childs, $name) {
		foreach ($childs as $child) {
			$result = $child->getChild($name);
			if ($result instanceof FormManager_Model_Element) {
				return $child;
			}
			$result = $this->searchInChilds($child, $name);
			if ($result instanceof FormManager_Model_Element) {
				return $child;
			}
		}
		return false;
	}

	/**
	 * Выполняет проверку формы
	 * 
	 * @return boolean
	 */
	public function validate() {
		// TODO требуется реализация
		return false;
	}

	/**
	 * Рисует форму
	 */
	public function drow() {
		// TODO требуется реализация
	}

	/**
	 * Экспортирует объект формы
	 * 
	 * @return FormManager_Model_Form
	 */
	public function export() {
		return $this->form;
	}

}