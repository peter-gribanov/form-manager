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
abstract class FormManager_Model_Field_Abstract extends FormManager_Model_Collection_Item_Abstract implements FormManager_Model_Field_Interface {

	/**
	 * Опции поля
	 * 
	 * @var	array
	 */
	protected $options = array(
		'name'		=> '',		// Имя поля
//		'title'		=> '',		// Заголовок для поля
//		'comment'	=> '',		// Комментарий к полю
		'default'	=> '',		// Значение по умолчанию
		'view'		=> array('text', array()),	// Вид поля
		'filters'	=> array(),	// Фильтры проверки поля
		'required'	=> false,	// Обязательное для заполнения
	);

	/**
	 * Итератор запуска фильтров при проверки поля
	 * 
	 * @var	integer
	 */
	private $filter_iterator;


	/**
	 * Устанавливает имя поля
	 * 
	 * @param	string	$name				Имя
	 * @throws	InvalidArgumentException	Недопустимое имя
	 * @return	FormManagerElement			Объект элемента
	 */
	public function setName($name){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Element name must be not empty string');

		$this->options['name'] = $name;
		return $this;
	}

	/**
	 * Возвращает имя поля
	 * 
	 * @return	string
	 */
	public function getName(){
		return $this->options['name'];
	}

	/**
	 * Устанавливает заголовок для поля
	 * 
	 * TODO перенести в Question
	 * 
	 * @param string $title
	 * @throws InvalidArgumentException
	 * @return FormManagerElement
	 *//*
	public function setTitle($title){
		if (!is_string($title) || !trim($title))
			throw new InvalidArgumentException('Element title must be not empty string');

		$this->options['title'] = $title;
		return $this;
	}*/

	/**
	 * Возвращает заголовок для поля
	 * 
	 * TODO перенести в Question
	 * 
	 * @return string
	 *//*
	public function getTitle(){
		return $this->options['title'];
	}*/

	/**
	 * Устанавливает комментарий для поля
	 * 
	 * TODO перенести в Question
	 * 
	 * @param string $comment
	 * @throws InvalidArgumentException
	 * @return FormManagerElement
	 *//*
	public function setComment($comment){
		if (!is_string($comment) || !trim($comment))
			throw new InvalidArgumentException('Element comment must be not empty string');

		$this->options['comment'] = $comment;
		return $this;
	}*/

	/**
	 * Возвращает комментарий для поля
	 * 
	 * TODO перенести в Question
	 * 
	 * @return string
	 *//*
	public function getComment(){
		return $this->options['comment'];
	}*/

	/**
	 * Устанавливает значение поля
	 * 
	 * @param mixed $val
	 * @return FormManagerElement
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
	 * @param  string                   $name
	 * @param  array                    $params
	 * @throws InvalidArgumentException
	 * @return FormManagerElement
	 */
	public function setView($name, $params=null){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Element view name must be not empty string');

		$params = $params ? $params : array();
		$this->setViewParams($params);

		$this->options['view'][0] = $name;
		return $this;
	}

	/**
	 * Устанавливает параметры вывода
	 * 
	 * @param  array              $params
	 * @return FormManagerElement
	 */
	public function setViewParams($params=array()){
		if (!is_array($params))
			throw new InvalidArgumentException('Element view parametrs should be an array');

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
	 * @return	void
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
	 * @param string $name
	 * @param array $params
	 * @throws InvalidArgumentException
	 * @return FormManagerElement
	 */
	public function setFilter($name, $params=null){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Element filter name must be not empty string');

		$params = $params ? $params : array();
		if (!is_array($params))
			throw new InvalidArgumentException('Element filter parametrs should be an array');

		if (!file_exists(FORM_PATH.'/filters/'.$name.'.php'))
			throw new InvalidArgumentException('File of element filter ('.$name.') do not exists');

		$this->options['filters'][] = array($name, $params);
		// Обязательное для заполнения
		if ($name=='empty'){
			$this->required();
		}
		return $this;
	}

	/**
	 * Производит проверку переданных данных по полю 
	 * 
	 * @return	void
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
	 * @param string $post
	 * @param array $params
	 * @throws LogicException
	 * @throws FormManagerFilterException
	 * @return void
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
	 * @return FormManagerElement
	 */
	public function required(){
		$this->options['required'] = true;
		if ($this->form){
			$this->form->required();
		}
		return $this;
	}

	/**
	 * Проверяет является ли поле обязательным для заполнения
	 * 
	 * @return boolen
	 */
	public function isRequired(){
		return $this->options['required'];
	}

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param  string $post
	 * @return string
	 *//*
	public function getLangPost($post){
		return $this->form->getLangPost($post);
	}*/

	/**
	 * Метод для сериализации класса
	 *
	 * @return string
	 */
	public function serialize(){
		return serialize($this->options);
	}

	/**
	 * Метод для десериализации класса
	 *
	 * @param string $data
	 * @return FormManagerElement
	 */
	public function unserialize($data){
		$this->options = unserialize($data);
		return $this;
	}

	/**
	 * Возвращает реальный путь к шаблону элемента
	 * 
	 * @param	string	$view	Вид элемента
	 * @return	string	Путь к шаблону элемента
	 *//*
	public static function getTemplatePath($view){
		return FormManagerForm::getTemplatePath('fields/'.$view.'/template.php');
	}*/

}