<?php

/**
 * Класс описывает элемент ввода формы
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.22 SVN: $Revision$
 * @since		$Date$
 * @link		$HeadURL$
 * @link		http://peter-gribanov.ru/#open-source/form-manager
 * @copyright	(c) 2008 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerElement implements FormManagerItem, Serializable {

	/**
	 * Опции элемента
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $options = array(
		'name'		=> '',		// Имя элемента
		'title'		=> '',		// Заголовок для элемента
		'comment'	=> '',		// Комментарий к элементу
		'default'	=> '',		// Значение по умолчанию
		'view'		=> array('text', array()),	// Вид элемента
		'filters'	=> array(),	// Фильтры проверки элемента
		'required'	=> false,	// Обязательное для заполнения
	);

	/**
	 * Объект формы
	 * 
	 * @access	protected
	 * @var		FormManagerForm
	 */
	protected $form;

	/**
	 * Итератор запуска фильтров при проверки элемента
	 * 
	 * @access	private
	 * @var		integer
	 */
	private $filter_iterator;


	/**
	 * Устанавливает форму к которой пренадлежит элемент
	 * 
	 * Устанавливает объект формы к которой пренадлежит элемент
	 * Метод предназначен для внутреннего использования
	 * 
	 * @access	private
	 * @param	FormManagerForm	$form	Объект формы
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setForm(FormManagerForm $form){
		$this->form = $form;
		if ($this->options['required'])
			$this->form->required();

		return $this;
	}

	/**
	 * Устанавливает имя элемента
	 * 
	 * @param	string	$name	Имя элемента
	 * @throws	InvalidArgumentException	Недопустимое значение
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setName($name){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Element name must be not empty string');

		$this->options['name'] = $name;
		return $this;
	}

	/**
	 * Возвращает имя элемента
	 * 
	 * @return	string	Имя элемента
	 */
	public function getName(){
		return $this->options['name'];
	}

	/**
	 * Устанавливает заголовок для элемента
	 * 
	 * @param	string	$title	Заголовок элемента
	 * @throws	InvalidArgumentException	Недопустимое значение
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setTitle($title){
		if (!is_string($title) || !trim($title))
			throw new InvalidArgumentException('Element title must be not empty string');

		$this->options['title'] = $title;
		return $this;
	}

	/**
	 * Возвращает заголовок для элемента
	 * 
	 * @return	string	Заголовок элемента
	 */
	public function getTitle(){
		return $this->options['title'];
	}

	/**
	 * Устанавливает комментарий для элемента
	 * 
	 * @param	string	$comment	Комментарий элемента
	 * @throws	InvalidArgumentException	Недопустимое значение
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setComment($comment){
		if (!is_string($comment) || !trim($comment))
			throw new InvalidArgumentException('Element comment must be not empty string');

		$this->options['comment'] = $comment;
		return $this;
	}

	/**
	 * Возвращает комментарий для элемента
	 * 
	 * @return	string	Комментарий элемента
	 */
	public function getComment(){
		return $this->options['comment'];
	}

	/**
	 * Устанавливает значение по умолчанию для элемента
	 * 
	 * @param	mixed	$val	Значение по умолчанию
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setDefaultValue($val){
		$this->options['default'] = $val;
		return $this;
	}

	/**
	 * Возвращает значение по умолчанию элемента
	 * 
	 * @return	string	Значение по умолчанию
	 */
	public function getDefaultValue(){
		return $this->options['default'];
	}

	/**
	 * Возвращает значение элемента
	 * 
	 * @return	string	Значение элемента
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
	 * @return	string	Пользовательское значение
	 */
	public function & getSentValue(){
		return $this->form->getSentValue($this->getName());
	}

	/**
	 * Устанавливает вид для элемента
	 * 
	 * @param	string	$name	Вид элемента
	 * @param	array	$params	Параметры вида
	 * @throws	InvalidArgumentException	Недопустимое значение
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setView($name, $params=array()){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Element view name must be not empty string');

		if (!is_array($params))
			throw new InvalidArgumentException('Element view parametrs should be an array');

		if (!file_exists(dirname(__DIR__).'/views/'.$name.'.php'))
			throw new InvalidArgumentException('File of element view ('.$name.') do not exists');

		$params = array_merge($this->options['view'][1], $params);
		$this->options['view'] = array($name, $params);
		return $this;
	}

	/**
	 * Возвращает значение одного параметра вывода или их все
	 * 
	 * @param	string	$param	Идентификатор параметра
	 * @return	mixid	Значени параметра(ов)
	 */
	public function getViewParams($param=null){
		if ($param===null){
			return $this->options['view'][1];
		} elseif (isset($this->options['view'][1][$param])){
			return $this->options['view'][1][$param];
		} else {
			return null;
		}
	}

	/**
	 * Выводит обертку элемента
	 * 
	 * @return	void
	 */
	public function draw(){
		include dirname(__DIR__).'/skin/'.$this->form->getSkin().'.element.php';
	}

	/**
	 * Выводит элемент
	 * 
	 * @return	void
	 */
	public function drawField(){
		include dirname(__DIR__).'/views/'.$this->options['view'][0].'.php';
	}

	/**
	 * Устанавливает фильтр для элемента
	 * 
	 * @param	string	$name	Название фильтра
	 * @param	array	$params	Параметры фильтра
	 * @throws	InvalidArgumentException	Недопустимое значение
	 * @return	FormManagerElement	Объект элемента
	 */
	public function setFilter($name, $params=array()){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Element filter name must be not empty string');

		if (!is_array($params))
			throw new InvalidArgumentException('Element filter parametrs should be an array');

		if (!file_exists(dirname(__DIR__).'/filters/'.$name.'.php'))
			throw new InvalidArgumentException('File of element filter ('.$name.') do not exists');

		$this->options['filters'][] = array($name, $params);
		// поле является обязательным для заполнения
		if ($name=='empty') $this->required();

		return $this;
	}

	/**
	 * Производит проверку переданных данных по элементу
	 * 
	 * @return	void
	 */
	public function valid(){
		// не проверять отключенные поля 
		if (isset($this->options['view'][1]['disabled'])
			&& $this->options['view'][1]['disabled']) return;

		$this->filter_iterator = 0;
		while (isset($this->options['filters'][$this->filter_iterator])){
			$params = $this->options['filters'][$this->filter_iterator][1];
			include dirname(__DIR__).'/filters/'.$this->options['filters'][$this->filter_iterator][0].'.php';
			$this->filter_iterator++;
		}
		$this->filter_iterator = null;
	}

	/**
	 * Генерирует исключение при проверки элемента фильтром
	 * 
	 * @param	string	$post	Идентификатор сообщения
	 * @param	array	$params	Параметры сообщения
	 * @throws	LogicException
	 * @throws	FormManagerFilterException	Сообщенине фильтра
	 * @return	void
	 */
	public function error($post, $params=array()){
		if (!is_integer($this->filter_iterator))
			throw new LogicException('Validate field is not running');

		// добавление сообщения из языковой темы и название поля
		array_unshift($params, $this->getLangPost($post), $this->getTitle());
		// создание исключения
		throw new FormManagerFilterException(call_user_func_array('sprintf', $params), $this,
			$this->options['filters'][$this->filter_iterator]);
	}

	/**
	 * Устанавливает что элемент является обязательным для заполнения
	 * 
	 * @return	FormManagerElement	Объект элемента
	 */
	public function required(){
		$this->options['required'] = true;
		if ($this->form) $this->form->required();
		return $this;
	}

	/**
	 * Проверяет является ли элемент обязательным для заполнения
	 * 
	 * @return	boolen	Результат проверки
	 */
	public function isRequired(){
		return $this->options['required'];
	}

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param	string	$post	Идентификатор сообщения
	 * @return	string	Текст сообшения
	 */
	public function getLangPost($post){
		return $this->form->getLangPost($post);
	}

	/**
	 * Метод для сериализации объекта елемента формы
	 * 
	 * @return	string	Сериализованый объект
	 */
	public function serialize(){
		return serialize($this->options);
	}

	/**
	 * Метод для десериализации объекта елемента формы
	 * 
	 * @param	string	$data	Сериализованый объект
	 * @return	FormManagerElement	Объект элемента
	 */
	public function unserialize($data){
		$this->options = unserialize($data);
		return $this;
	}

}