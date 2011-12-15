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
 * Класс описывает элемент ввода формы
 * 
 * @package FormManager\Model\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Model_Field_Abstract extends FormManager_Model_Element implements FormManager_Interfaces_Model_Field {

	/**
	 * Опции поля
	 * 
	 * @var	array
	 */
	protected $options = array(
//		'name'		=> '',		// Имя поля
		'default'	=> '',		// Значение по умолчанию
		'view'		=> array('text', array()),	// Вид поля
		'filters'	=> array(),	// Фильтры проверки поля
//		'required'	=> false,	// Обязательное для заполнения
	);

	/**
	 * Итератор запуска фильтров при проверки поля
	 * 
	 * @var	integer
	 */
//	private $filter_iterator;


	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param FormManager_Model_Element $element
	 */
	public function add(FormManager_Model_Element $element) {
		// TODO описать исключение
		throw new FormManager_Exceptions_Model_Field();
	}

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 *
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param string $query
	 */
	public function addByQuery($query) {
		// TODO описать исключение
		throw new FormManager_Exceptions_Model_Field();
	}

	/**
	 * Устанавливает имя поля
	 * 
	 * @throws	FormManager_Exceptions_Model_Field
	 * 
	 * @param string $name Имя
	 * 
	 * @return FormManager_Model_Field_Abstract
	 *//*
	public function setName($name){
		if (!is_string($name) || !trim($name)) {
			throw new FormManager_Exceptions_Model_Field('Element name must be not empty string');
		}
		$this->options['name'] = $name;
		return $this;
	}*/

	/**
	 * Возвращает имя поля
	 * 
	 * @return string
	 *//*
	public function getName(){
		return $this->options['name'];
	}*/

	/**
	 * Устанавливает значение поля
	 * 
	 * @param string|integer|float|boolean|array $val
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setDefaultValue($val){
		$this->options['default'] = $val;
		return $this;
	}

	/**
	 * Возвращает значение поля
	 * 
	 * @return string
	 */
	public function getDefaultValue(){
		return $this->options['default'];
	}

	/**
	 * Возвращает значение поля
	 * 
	 * @return string
	 */
	public function getValue(){
		// значение указанное пользователем
		$value = & $this->getSentValue();

		// получение значения для checkbox
		if (is_bool($this->getDefaultValue())){
			if ($value=='on'){
				$value = true;
			} elseif ($value===null && $this->form->isAlreadySent()){
				$value = false;
			}
		}

		return $value!==null ? $value : $this->getDefaultValue();
	}

	/**
	 * Возвращает значение указанное пользователем
	 * 
	 * @return string
	 */
	public function &getSentValue(){
		return $this->form->getSentValue($this->getName());
	}

	/**
	 * Устанавливает вид для поля
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param string $name
	 * @param array  $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setView($name, $params=null){
		if (!is_string($name) || !trim($name)) {
			throw new FormManager_Exceptions_Model_Field('Element view name must be not empty string');
		}
		$params = $params ? $params : array();
		$this->setViewParams($params);

		$this->options['view'][0] = $name;
		return $this;
	}

	/**
	 * Устанавливает параметры вывода
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param  array              $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 */
	public function setViewParams($params=array()){
		if (!is_array($params)) {
			throw new FormManager_Exceptions_Model_Field('Element view parametrs should be an array');
		}
		$this->options['view'][1] = array_merge($this->options['view'][1], $params);

		return $this;
	}

	/**
	 * Выводит поле
	 * 
	 * @return void
	 *//*
	public function draw(){
		$params = $this->options['view'][1];
		include FormManagerForm::getTemplatePath('element.php');
	}*/

	/**
	 * Выводит поле
	 * 
	 * @return void
	 *//*
	public function drawField(){
		// загружаем параметру вывода по умолчанию
		include FormManagerForm::getTemplatePath('fields/'.$this->options['view'][0].'/.parameters.php');
		$params = array_merge($this->options['view'][1], $params);
		// выводим шаблон
		include self::getTemplatePath($this->options['view'][0]);
	}*/

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @throws FormManager_Exceptions_Model_Field
	 * 
	 * @param string $name
	 * @param array  $params
	 * 
	 * @return FormManager_Model_Field_Abstract
	 *//*
	public function setFilter($name, $params=null){
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
		return $this;
	}*/

	/**
	 * Производит проверку переданных данных по полю 
	 * 
	 * @return void
	 *//*
	public function valid(){
		// не проверять отключенные поля 
		if (isset($this->options['view'][1]['disabled'])
			&& $this->options['view'][1]['disabled']) return;

		$this->filter_iterator = 0;
		while (isset($this->options['filters'][$this->filter_iterator])){
			$params = $this->options['filters'][$this->filter_iterator][1];
			include FORM_PATH.'/filters/'.$this->options['filters'][$this->filter_iterator][0].'.php';
			$this->filter_iterator++;
		}
		$this->filter_iterator = null;
	}*/

	/**
	 * Генерирует исключение при проверки поля фильтром
	 * 
	 * @throws FormManagerFilterException
	 * 
	 * @param string $post
	 * @param array  $params
	 *//*
	public function error($post, $params=array()){
		if (!is_integer($this->filter_iterator)){
			throw new LogicException('Validate field is not running');
		}
		// добавление сообщения из языковой темы и название поля
		array_unshift($params, $this->getLangPost($post), $this->getTitle());
		// создание исключения
		throw new FormManagerFilterException(call_user_func_array('sprintf', $params), $this,
			$this->options['filters'][$this->filter_iterator]);
	}*/

	/**
	 * Устанавливает что поле является обязательным для заполнения
	 * 
	 * @return FormManager_Model_Field_Abstract
	 *//*
	public function required(){
		$this->options['required'] = true;
		if ($this->form){
			$this->form->required();
		}
		return $this;
	}*/

	/**
	 * Проверяет является ли поле обязательным для заполнения
	 * 
	 * @return boolean
	 *//*
	public function isRequired(){
		return $this->options['required'];
	}*/

	/**
	 * Метод для сериализации класса
	 *
	 * @return string
	 *//*
	public function serialize(){
		return serialize($this->export());
	}*/

	/**
	 * Метод для десериализации класса
	 *
	 * @param string $data
	 * 
	 * @return FormManager_Model_Collection_Abstract
	 */
	public function unserialize($data){
		// TODO требуется тестирование
		$this->options = unserialize($data);
		return $this;
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export(){
		return array_merge(
			$this->options.
			parent::export()
		);
	}

	/**
	 * Возвращает реальный путь к шаблону элемента
	 * 
	 * @param string $view Вид элемента
	 * 
	 * @return string Путь к шаблону элемента
	 *//*
	public static function getTemplatePath($view){
		return FormManagerForm::getTemplatePath('fields/'.$view.'/template.php');
	}*/

}