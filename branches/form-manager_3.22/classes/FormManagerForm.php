<?php

require 'FormManagerItem.php';
require 'FormManagerCollection.php';

/**
 * Класс описывает форму и позволяет ее динамически составлять
 * 
 * @package	FormManager
 * @author	Peter Gribanov
 * @since	26.11.2010
 * @version	3.22
 */
class FormManagerForm implements Serializable {

	/**
	 * Опции формы
	 * 
	 * @var	array
	 */
	private $options = array(
		'action'		=> '',		// Адрес обработчика формы
		'method'		=> 'post',	// Метод передачи данных
		'name'			=> '',		// Название формы
		'skin'			=> '',		// Шаблон вида формы
		'required'		=> false,	// Есть поля обязательны для заполнения
		'submit_title'	=> '',		// Заголовок для кнопки отправки формы
	);

	/**
	 * Список элементов
	 *
	 * @var	FormManagerCollection
	 */
	private $collection;

	/**
	 * Список переданных параметров
	 * 
	 * @var	array
	 */
	private $inputs = array();

	/**
	 * ID активной языковой темы
	 * 
	 * @var	string
	 */
	private $lang_id;

	/**
	 * Список загруженных сообщений активной языковой темы
	 * 
	 * @var	array
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
		$this->setSkin('view');
		$this->setMethod('post');
		$this->setLangID('en');
	}

	/**
	 * Вставляет один или более элементов в конце списка
	 *
	 * @param FormManagerItem $item
	 * @return FormManagerForm
	 */
	public function add(FormManagerItem $item){
		$this->collection->add($item);
		return $this;
	}

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 *
	 * @param string $query
	 * @throws InvalidArgumentException
	 * @return FormManagerForm
	 */
	public function addByQuery($query){
		if (!$query) return $this;

		$query = explode('&', $query);
		foreach ($query as $var){
			if (substr_count($var, '=') != 1)
				throw new InvalidArgumentException('Cant add element because of improper URL query');

			$var = explode('=', $var);
			$this->add(FormManagerFacade::Hidden($var[0])->setDefaultValue($var[1]));
		}
		return $this;
	}

	/**
	 * Производит проверку всех полей
	 * Псевдоним для FormManagerCollection::valid()
	 *
	 * @return void
	 */
	public function valid(){
		$this->collection->valid();
	}

	/**
	 * Возвращает коллекцию элиментов формы
	 * 
	 * @return FormManagerCollection
	 */
	public function getCollection(){
		return $this->collection;
	}

	/**
	 * Устанавливает флаг что есть поля обязательные для заполнения
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
	 * @return boolen
	 */
	public function isRequired(){
		return $this->options['required'];
	}

	/**
	 * Возвращает значение указанное пользователем
	 * 
	 * @param string $name
	 * @return string
	 */
	public function & getSentValue($name){
		return $this->inputs[$name];
	}

	/**
	 * Очищает отправленные данные
	 * 
	 * @return FormManagerForm
	 */
	public function clearSentValues(){
		$var = '_'.strtoupper($this->options['method']);
		unset($$var);
		// для корректной работы методов isAlreadySent
		// создается не пустой массив
		$$var = array(0);
		return $this;
	}

	/**
	 * Форма уже отправлена
	 * 
	 * @return boolen
	 */
	public function isAlreadySent(){
		if (!isset($_SERVER['HTTP_REFERER'])
			|| !count($this->options['method'] == 'post' ? $_POST : $_GET)
			// должен быть установлен уникальный ключ,
			// но он не обнаружен в полученных данных
			|| ($this->options['method'] == 'get'
				&& $this->getSentValue('unique_key_already_sent')
					!=='4ab24a54898e90ea76f23afc36a81819')){

			return false;
		}

		// получение тикущей страници
		$current = ($_SERVER['SERVER_PROTOCOL'][4]=='S' ? 'https' : 'http').'://'
			.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$referer = $_SERVER['HTTP_REFERER'];

		// игнорировать GET параметры при отправке формы методом GET
		if ($this->options['method'] == 'get'){
			list($current, ) = explode('?', $current.'?', 2);
			list($referer, ) = explode('?', $referer.'?', 2);
		}

		return $current==$referer;
	}

	/**
	 * Устанавливает шаблон вида формы
	 * 
	 * @param string $skin
	 * @throws InvalidArgumentException
	 * @return FormManagerForm
	 */
	public function setSkin($skin){
		if (!is_string($skin) || !trim($skin))
			throw new InvalidArgumentException('Display form must be not empty string');

		if (!file_exists(realpath(dirname(dirname(__FILE__)).'/skin/'.$skin.'.php')))
			throw new InvalidArgumentException("File of display \"$skin\" form do not exists");

		$this->options['skin'] = $skin;
		return $this;
	}

	/**
	 * Возвращает шаблон вида формы
	 * 
	 * @return string
	 */
	public function getSkin(){
		return $this->options['skin'];
	}

	/**
	 * Выводит форму по шаблону
	 * 
	 * @return void
	 */
	public function draw(){
		include dirname(dirname(__FILE__)).'/skin/'.$this->options['skin'].'.php';
	}

	/**
	 * Устанавливает ID языковой темы
	 * 
	 * @param integer $id
	 * @throws InvalidArgumentException
	 * @return FormManagerForm
	 */
	public function setLangID($id){
		// не требуется изменять языковую тему
		if ($this->lang_id==$id) return $this;

		if (!is_string($id) || strlen($id)!=2)
			throw new InvalidArgumentException('Incorrect id language');

		if (!file_exists(dirname(dirname(__FILE__)).'/lang/'.$id.'.php'))
			throw new InvalidArgumentException('Language theme for this id is not found');

		$this->lang_id = $id;
		// обновление списка загруженных сообщений
		include dirname(dirname(__FILE__)).'/lang/'.$this->lang_id.'.php';
		unset($this->lang_posts);
		$this->lang_posts = & $lang;
		return $this;
	}

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @param string $post
	 * @throws InvalidArgumentException
	 * @return string
	 */
	public function getLangPost($post){
		if (!isset($this->lang_posts[$post]))
			throw new InvalidArgumentException('Selected message is not found in the language theme');

		return $this->lang_posts[$post];
	}

	/**
	 * Устанавливает адрес обработчика формы
	 *
	 * @param string $action
	 * @throws InvalidArgumentException
	 * @return FormManagerForm
	 */
	public function setAction($action){
		if (!is_string($action) || !trim($action))
			throw new InvalidArgumentException('Form name must be not empty string');

		$this->options['action'] = $action;
		return $this;
	}

	/**
	 * Возвращает адрес обработчика формы
	 *
	 * @return string
	 */
	public function getAction(){
		return $this->options['action'];
	}

	/**
	 * Устанавливает метод передачи данных
	 *
	 * @param string $method
	 * @throws UnexpectedValueException
	 * @return FormManagerForm
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
				Facade::Hidden('unique_key_already_sent')
					->setDefaultValue('4ab24a54898e90ea76f23afc36a81819')
			);
		}
		return $this;
	}

	/**
	 * Возвращает метод передачи данных
	 *
	 * @return string
	 */
	public function getMethod(){
		return $this->options['method'];
	}

	/**
	 * Устанавливает название формы
	 *
	 * @param string $name
	 * @throws InvalidArgumentException
	 * @return FormManagerForm
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
	 * @return string
	 */
	public function getName(){
		return $this->options['name'];
	}

	/**
	 * Устанавливает заголовок для кнопки отправки формы
	 *
	 * @param string $title
	 * @throws InvalidArgumentException
	 * @return FormManagerForm
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
	 * @return string
	 */
	public function getSubmitTitle(){
		return $this->options['submit_title'];
	}

	/**
	 * Метод для сериализации класса
	 *
	 * @return string
	 */
	public function serialize(){
		return serialize(array($this->options, $this->collection));
	}

	/**
	 * Метод для десериализации класса
	 *
	 * @param string $data
	 * @return FormManagerForm
	 */
	public function unserialize($data){
		list($this->options, $this->collection) = unserialize($data);
		$this->collection->setForm($this);
		return $this;
	}

}
?>