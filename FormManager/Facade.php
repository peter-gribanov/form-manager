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
	}

	/**
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param  string $id Id языковой темы
	 * 
	 * @return boolen Результат установки темы
	 */
	public static function setLanguageId($id) {
		return FormManager_Language::setId($id);
	}

	/**
	 * Добавляет новое поле к вопросу
	 * 
	 * @param FormManager_Model_Question_Interface $question Родительский вопрос
	 * @param string                               $name     Название поля
	 * @param string                               $type     Тип поля
	 * 
	 * @return FormManager_Model_Field_Interface
	 */
	public function addFieldTo(FormManager_Model_Question_Interface $question, $name, $type = 'Base') {
		$field = $this->getField($type);
		$field->setName($name);
		$question->add($field);
		return $field;
	}

	/**
	 * Добавляет новый вопрос
	 * 
	 * @param string $title   Заголовок вопроса
	 * @param string $comment Коментарий к полю
	 * 
	 * @return FormManager_Model_Question_Interface
	 */
	public function addQuestion($title, $comment = '') {
		return $this->addQuestionTo($this->form, $title, $comment);
	}

	/**
	 * Добавляет новый вопрос к коллекции
	 * 
	 * @param FormManager_Model_Collection_Interface $collection Родительская коллекция
	 * @param string                                 $title      Заголовок вопроса
	 * @param string                                 $comment    Коментарий к полю
	 * 
	 * @return FormManager_Model_Question_Interface
	 */
	public function addQuestionTo(FormManager_Model_Collection_Interface $collection, $title, $comment = '') {
		$question = new FormManager_Model_Question_Base();
		$question->setTitle($title);
		$question->setComment($comment);
		$collection->add($question);
		return $question;
	}

	/**
	 * Добавляет новую коллекцию
	 * 
	 * @param string $type Тип коллекции
	 * 
	 * @return FormManager_Model_Collection_Interface
	 */
	public function addCollection($type = 'Base') {
		return $this->addCollectionTo($this->form, $type);
	}

	/**
	 * Добавляет новую коллекцию к другой коллекции
	 * 
	 * @param FormManager_Model_Collection_Interface $collection Родительская коллекция
	 * @param string                                 $type       Тип коллекции
	 * 
	 * @return FormManager_Model_Collection_Interface
	 */
	public function addCollectionTo(FormManager_Model_Collection_Interface $collection, $type = 'Base') {
		$coll = $this->getCollection($type);
		$collection->add($coll);
		return $coll;
	}

	/**
	 * Возвращает новое поле или фабрику полей
	 * 
	 * @param string $name Имя поля
	 * 
	 * @return FormManager_Field_Factory|FormManager_Model_Field_Interface
	 */
	public function getField($name = null){
		return $name ? $this->field->get($name) : $this->field;
	}

	/**
	 * Возвращает новую коллекцию или фабрику коллекций
	 * 
	 * @param string $name Имя коллекции
	 * 
	 * @return FormManager_Collection_Factory|FormManager_Model_Collection_Interface
	 */
	public function getCollection($name = null){
		return $name ? $this->collection->get($name) : $this->collection;
	}

	/**
	 * Выполняет проверку формы
	 * 
	 * @return boolen
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

}