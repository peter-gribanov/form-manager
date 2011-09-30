<?php

require 'FormManagerItem.php';
require 'FormManagerCollection.php';

/**
 * Класс описывает форму и позволяет ее динамически составлять
 * 
 * @category	Complex library
 * @package		FormManager
 * @author		Peter S. Gribanov <info@peter-gribanov.ru>
 * @version		3.27 SVN: $Revision$
 * @since		$Date$
 * @link		http://peter-gribanov.ru/open-source/form-manager/3.27/
 * @copyright	(c) 2009 by Peter S. Gribanov
 * @license		http://peter-gribanov.ru/license	GNU GPL Version 3
 */
class FormManagerForm implements Serializable {

	/**
	 * Опции формы
	 * 
	 * @access	private
	 * @var		array
	 */
	private $options = array(
		'action'		=> '',		// Адрес обработчика формы
		'method'		=> 'post',	// Метод передачи данных
		'name'			=> '',		// Название формы
		'required'		=> false,	// Есть поля обязательны для заполнения
		'submit_title'	=> '',		// Заголовок для кнопки отправки формы
		'buttons'		=> array(),	// Список кнопок у формы
	);

	/**
	 * Шаблон вида формы
	 * 
	 * @access	private
	 * @var		string
	 */
	private static $template = '.default';

	/**
	 * Список элементов
	 * 
	 * @access	private
	 * @var		FormManagerCollection
	 */
	private $collection;

	/**
	 * Список переданных параметров
	 * 
	 * @access	private
	 * @var		array
	 */
	private $inputs = array();

	/**
	 * ID активной языковой темы
	 * 
	 * @access	private
	 * @var		string
	 */
	private $lang_id = 'en';

	/**
	 * Список загруженных сообщений активной языковой темы
	 * 
	 * @access	private
	 * @var		array
	 */
	private $lang_posts = array();


	/**
	 * Конструктор
	 *
	 * @return	void
	 */
	public function __construct(){
		$this->collection = new FormManagerCollection();
		$this->collection->setForm($this);
		$this->setMethod('post');
	}

	/**
	 * Вставляет один или более элементов в конце списка
	 *
	 * @param	FormManagerItem	$item	Объект элемента или коллекции элементов
	 * @return	FormManagerForm			Объект формы
	 */
	public function add(FormManagerItem $item){
		$this->collection->add($item);
		return $this;
	}

	/**
	 * Разбирает строку запроса и добавляет скрытые элементы
	 * 
	 * Разбирает строку URL запроса на переменные и их значение
	 * и добавляет в форму скрытые элементы с соответствующими
	 * переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 * 
	 * @param	string	$query				Строка запроса
	 * @throws	InvalidArgumentException	Некооректный URL
	 * @return	FormManagerForm				Объект формы
	 */
	public function addByQuery($query){
		if (!$query) return $this;

		$query = explode('&', $query);
		foreach ($query as $var){
			if (substr_count($var, '=') != 1)
				throw new InvalidArgumentException('Cant add element because of improper URL query');

			$var = explode('=', $var);
			$this->add(FormManager::Hidden($var[0])->setDefaultValue($var[1]));
		}
		return $this;
	}

	/**
	 * Вставляет кнопку на форму
	 * 
	 * @param	string	$title	Заголовок кнопки
	 * @param	array	$params	Параметры вывода
	 * @return	FormManagerForm	Объект формы
	 */
	public function addButton($title, $params=null){
		if (!is_string($title) || !trim($title))
			throw new InvalidArgumentException('Title of button should not be an empty string');
		if ($params && !is_array($params))
			throw new InvalidArgumentException('Button parametrs should be an array');
		if (isset($params['type']) && !in_array($params['type'], array('button', 'reset', 'submit')))
			throw new InvalidArgumentException('Unsupported type of button');

		$this->options['buttons'][] = array($title, $params ? $params : array());
		return $this;
	}

	/**
	 * Рисует кнопку на форму
	 * 
	 * @return void
	 */
	public function drawButtons(){
		foreach ($this->options['buttons'] as $button)
			$this->drawButton($button[0], $button[1]);
	}

	/**
	 * Рисует кнопку на форму
	 * 
	 * @param	string	$title	Заголовок кнопки
	 * @param	array	$params	Параметры вывода
	 * @return	void
	 */
	private function drawButton($title, $params=array()){
		include self::getTemplatePath('fields/button.php');
	}

	/**
	 * Производит проверку всех полей
	 * 
	 * @see		FormManagerCollection::valid()	Псевдоним
	 * @return	void
	 */
	public function valid(){
		$this->collection->valid();
	}

	/**
	 * Возвращает коллекцию элементов формы
	 * 
	 * @return	FormManagerCollection	Объект коллекции
	 */
	public function getCollection(){
		return $this->collection;
	}

	/**
	 * Устанавливает флаг что есть элементы обязательные для заполнения
	 * 
	 * Устанавливает флаг что в форме есть элементы обязательные для заполнения
	 * Метод предназначен для внутреннего использования
	 * 
	 * @return void
	 */
	public function required(){
		$this->options['required'] = true;
	}

	/**
	 * Проверяет есть ли поля обязательные для заполнения
	 * 
	 * @return	boolen	Результат проверки
	 */
	public function isRequired(){
		return $this->options['required'];
	}

	/**
	 * Возвращает значение указанное пользователем
	 * 
	 * @param	string	$name	Идентификатор значения
	 * @return	string			Значение
	 */
	public function & getSentValue($name){
		return $this->inputs[$name];
	}

	/**
	 * Очищает отправленные данные
	 * 
	 * @return	FormManagerForm	Объект формы
	 */
	public function clearSentValues(){
		$method = '_'.strtoupper($this->options['method']);
		unset($GLOBALS[$method]);
		// для корректной работы методов isAlreadySent
		// создается не пустой массив
		$GLOBALS[$method] = array(0);
		$this->inputs = & $GLOBALS[$method];
		return $this;
	}

	/**
	 * Форма уже отправлена
	 * 
	 * @return	boolen	Результат проверки
	 */
	public function isAlreadySent(){
		if (!isset($_SERVER['HTTP_REFERER'])
			|| !count($GLOBALS['_'.strtoupper($this->options['method'])])
			// должен быть установлен уникальный ключ,
			// но он не обнаружен в полученных данных
			|| ($this->options['method'] == 'get'
				&& $this->getSentValue('unique_key_already_sent')
					!=='4ab24a54898e90ea76f23afc36a81819')){

			return false;
		}

		// получение тикущего хотса
		$current = ($_SERVER['SERVER_PROTOCOL'][4]=='S' ? 'https' : 'http').'://'
			.$_SERVER['HTTP_HOST'].'/';
		// разрешен прием форм в пределах одного хоста
		return substr($_SERVER['HTTP_REFERER'], 0, strlen($current))==$current;
	}

	/**
	 * Устанавливает шаблон вида формы
	 * 
	 * @param	string	$template			Идентификатор шаблона
	 * @throws	InvalidArgumentException	Недопустимый идентификатор шаблона
	 * @throws	InvalidArgumentException	Файл шаблона не найден
	 * @return	FormManagerForm				Объект формы
	 */
	public function setTemplate($template){
		if (!is_string($template) || !trim($template))
			throw new InvalidArgumentException('Display form must be not empty string');

		if (!file_exists(FORM_MANAGER_PATH.'/templates/'.$template.'/template.php'))
			throw new InvalidArgumentException('File of display ('.$template.') form do not exists');

		self::$template = $template;
		return $this;
	}

	/**
	 * Возвращает шаблон вида формы
	 * 
	 * @return	string	Идентификатор шаблона
	 */
	public function getTemplate(){
		return self::$template;
	}

	/**
	 * Выводит форму по шаблону
	 * 
	 * @return	void
	 */
	public function draw(){
		include self::getTemplatePath('template.php');
	}

	/**
	 * Устанавливает идентификатор языковой темы
	 * 
	 * @param	integer	$id					Идентификатор языковой темы
	 * @throws	InvalidArgumentException	Недопустимый идентификатор языковой темы
	 * @throws	InvalidArgumentException	Файл языковой темы не найден
	 * @return	FormManagerForm				Объект формы
	 */
	public function setLangID($id){
		// не требуется изменять языковую тему
		if ($this->lang_id==$id) return $this;

		if (!is_string($id) || strlen($id)!=2)
			throw new InvalidArgumentException('Incorrect id language');

		$this->lang_id = $id;
		var_dump($this->lang_id);
		// обновление списка загруженных сообщений
		$this->loadLangPosts();
		return $this;
	}

	/**
	 * Возвращает абсолютный путь к шаблону
	 * 
	 * @param	string	$path	Путь к шаблону
	 * @return	string			Абсолютный путь к шаблону
	 */
	public static function getTemplatePath($path){
		if (file_exists(FORM_MANAGER_PATH.'/templates/'.self::$template.'/'.$path)){
			return FORM_MANAGER_PATH.'/templates/'.self::$template.'/'.$path;
		} elseif (file_exists(FORM_MANAGER_PATH.'/templates/.default/'.$path)){
			return FORM_MANAGER_PATH.'/templates/.default/'.$path;
		} else {
			throw new InvalidArgumentException('Template file ('.$path.') do not exists');
		}
	}

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param	string	$post				Идентификатор сообщения
	 * @throws	InvalidArgumentException	Неизвестный дентификатор сообщения
	 * @return	string						Сообщение
	 */
	public function getLangPost($post){
		if (!isset($this->lang_posts[$post]))
			throw new InvalidArgumentException('Selected message is not found in the language theme');

		return $this->lang_posts[$post];
	}

	/**
	 * Устанавливает адрес обработчика формы
	 * 
	 * @param	string	$action				Адрес обработчика
	 * @throws	InvalidArgumentException	Недопустимый адрес обработчика
	 * @return	FormManagerForm				Объект формы
	 */
	public function setAction($action){
		if (!is_string($action) || !trim($action))
			throw new InvalidArgumentException('Form action must be not empty string');

		$this->options['action'] = $action;
		return $this;
	}

	/**
	 * Возвращает адрес обработчика формы
	 * 
	 * @return	string	Обработчик формы
	 */
	public function getAction(){
		return $this->options['action'];
	}

	/**
	 * Устанавливает метод передачи данных
	 * 
	 * @param	string	$method				Метод
	 * @throws	UnexpectedValueException	Недопустимый метод
	 * @return	FormManagerForm				Объект формы
	 */
	public function setMethod($method){
		$method = strtolower($method);
		if (!in_array($method, array('post', 'get')))
			throw new UnexpectedValueException('Form method must be POST or GET');

		$this->options['method'] = $method;
		if ($method=='post'){
			$this->inputs = & $_POST;
		} else {
			$this->inputs = & $_GET;
			// добавление скрытого поля
			$this->add(
				FormManager::Hidden('unique_key_already_sent')
					->setDefaultValue('4ab24a54898e90ea76f23afc36a81819')
			);
		}
		return $this;
	}

	/**
	 * Возвращает метод передачи данных
	 * 
	 * @return	string	Метод
	 */
	public function getMethod(){
		return $this->options['method'];
	}

	/**
	 * Устанавливает название формы
	 * 
	 * @param	string	$name				Название
	 * @throws	InvalidArgumentException	Недопустимое название
	 * @return	FormManagerForm				Объект формы
	 */
	public function setName($name){
		if (!is_string($name) || !trim($name))
			throw new InvalidArgumentException('Form name must be not empty string');

		$this->options['name'] = $name;
		return $this;
	}

	/**
	 * Возвращает название формы
	 * 
	 * @return	string	Название
	 */
	public function getName(){
		return $this->options['name'];
	}

	/**
	 * Устанавливает заголовок для кнопки отправки формы
	 * 
	 * @param	string	$title				Заголовок
	 * @throws	InvalidArgumentException	Недопустимый заголовок
	 * @return	FormManagerForm				Объект формы
	 */
	public function setSubmitTitle($title){
		if (!is_string($title) || !trim($title))
			throw new InvalidArgumentException('Form submit title must be not empty string');

		$this->options['submit_title'] = $title;
		return $this;
	}

	/**
	 * Возвращает заголовок для кнопки отправки формы
	 * 
	 * @return	string	Заголовок
	 */
	public function getSubmitTitle(){
		return $this->options['submit_title'];
	}

	/**
	 * Метод для сериализации класса
	 *
	 * @return	string	Сериализованый объект формы
	 */
	public function serialize(){
		return serialize(array($this->options, $this->collection, self::$template));
	}

	/**
	 * Метод для десериализации класса
	 * 
	 * @param	string	$data	Сериализованый объект формы
	 * @return	FormManagerForm	Объект формы
	 */
	public function unserialize($data){
		list($this->options, $this->collection, self::$template) = unserialize($data);
		$this->collection->setForm($this);
		$this->loadLangPosts();
		return $this;
	}

	/**
	 * Заружает тему языковых сообщений
	 * 
	 * @throws	LogicException	Файл языковой темы не найден
	 * @return	void
	 */
	private function loadLangPosts(){
		$path = FORM_MANAGER_PATH.'/lang/'.$this->lang_id.'/.parameters.php';
		if (!file_exists($path))
			throw new LogicException('Language theme for this id is not found');

		// загрузка списка сообщений
		include $path;
		$this->lang_posts = $lang;
	}

}
?>