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
 * @package FormManager\Field
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Field_Abstract extends FormManager_Element implements FormManager_Field_Interface {

	/**
	 * Значение поля по умолчанию
	 * 
	 * @var mixid
	 */
	private $default = '';

	/**
	 * Значение поля
	 * 
	 * @var mixid
	 */
	private $value = '';


	/**
	 * Конструктор
	 */
	public function __construct() {
		$this->setDecorator('disabled', false);
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_NoAction
	 * 
	 * @param FormManager_Element_Interface $element
	 */
	public function add(FormManager_Element_Interface $element) {
		// TODO описать исключение
		throw new FormManager_Exceptions_NoAction();
	}

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 *
	 * @throws FormManager_Exceptions_NoAction
	 * 
	 * @param string $query
	 */
	public function addByQuery($query) {
		// TODO описать исключение
		throw new FormManager_Exceptions_NoAction();
	}

	/**
	 * Устанавливает значение поля
	 * 
	 * @param mixid $val
	 * 
	 * @return boolean
	 */
	public function setDefaultValue($val){
		$this->default = $val;
		return true;
	}

	/**
	 * Возвращает значение поля
	 * 
	 * @return mixid
	 */
	public function getDefaultValue(){
		return $this->default;
	}

	/**
	 * Возвращает значение поля
	 * 
	 * TODO по хорошему этот метод больше не должен использоваться
	 * 
	 * @return mixid
	 */
	public function getValue(){
		// значение указанное пользователем
		$value = & $this->getSentValue();

		// получение значения для checkbox
		if (is_bool($this->getDefaultValue())){
			if ($value=='on'){
				$value = true;
			} elseif ($value===null && $this->getRoot()->isChanged()){
				$value = false;
			}
		}

		return $value!==null ? $value : $this->getDefaultValue();
	}

	/**
	 * Устанавливает значение поля
	 * 
	 * @param mixid $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * Возвращает значение указанное пользователем
	 * 
	 * @return string
	 */
	public function &getSentValue(){
		// FIXME getSentValue() больше нет
		return $this->getRoot()->getSentValue($this->getName());
	}

	/**
	 * Определяет изменено ли поле
	 * 
	 * @return boolean
	 */
	public function isChanged() {
		return $this->getValue() != $this->getDefaultValue();
	}

	/**
	 * Устанавливает фильтр для поля
	 * 
	 * @throws FormManager_Exceptions_Field
	 * 
	 * @param string $name
	 * @param array  $params
	 * 
	 * @return FormManager_Field_Abstract
	 *//*
	public function setFilter($name, $params=null){
		if (!is_string($name) || !trim($name)) {
			throw new FormManager_Exceptions_Field('Element filter name must be not empty string');
		}
		$params = $params ? $params : array();
		if (!is_array($params)) {
			throw new FormManager_Exceptions_Field('Element filter parametrs should be an array');
		}
		if (!file_exists(FORM_PATH.'/filters/'.$name.'.php')) {
			throw new FormManager_Exceptions_Field('File of element filter ('.$name.') do not exists');
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
	 * Метод для сериализации класса
	 * 
	 * @return string
	 */
	public function serialize(){
		// TODO требуется тестирование
		return serialize(array(
			$this->default,
			parent::serialize()
		));
	}

	/**
	 * Метод для десериализации класса
	 * 
	 * @param string $data
	 * 
	 * @return FormManager_Field_Abstract
	 */
	public function unserialize($data){
		// TODO требуется тестирование
		list($this->default, $data) = unserialize($data);
		parent::unserialize($data);
		return $this;
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export(){
		return array_merge(
			parent::export(),
			array('default' => $this->default)
		);
	}

}