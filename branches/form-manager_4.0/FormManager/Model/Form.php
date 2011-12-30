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
 * Класс описывает форму и позволяет ее динамически составлять
 * 
 * TODO форма это частный случай коллекции
 * 
 * @package FormManager\Model
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Model_Form extends FormManager_Model_Element implements FormManager_Model_Collection_Interface {

	/**
	 * Опции формы
	 * 
	 * @var array
	 *//*
	private $options = array(
		'action'       => '',      // Адрес обработчика формы
		'method'       => 'POST',  // Метод передачи данных
//		'name'         => '',      // Название формы
		'required'     => false,   // Есть полны для заполненияя обязатель
//		'submit_title' => '',      // Заголовок для кнопки отправки формы
//		'buttons'      => array(), // Список кнопок у формы
	);*/

	/**
	 * Шаблон вида формы
	 * 
	 * @var string
	 */
//	private static $template = '.default';

	/**
	 * Список элементов
	 * 
	 * @todo исправить имя класса
	 * 
	 * @var FormManager_Model_Collection_Primary
	 */
//	private $collection;

	/**
	 * Список переданных параметров
	 * 
	 * @var array
	 */
//	private $inputs = array();

	/**
	 * Список загруженных сообщений активной языковой темы
	 * 
	 * @var array
	 */
//	private $lang_posts = array();


	/**
	 * Конструктор
	 */
	public function __construct() {
		$this->setDecorator('action', '');
//		$this->collection = new FormManager_Model_Collection_Primary();
//		$this->collection->setForm($this);
//		$this->setMethod('POST');
//		$this->loadLangPosts();
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_NoAction
	 * 
	 * @param FormManager_Model_Element_Interface $element
	 */
	public function setParent(FormManager_Model_Element_Interface $element) {
		// TODO описать исключение
		throw FormManager_Exceptions_NoAction();
	}

	/**
	 * TODO добавить описание
	 * 
	 * @throws FormManager_Exceptions_NoAction
	 * 
	 * @param FormManager_Model_Element_Interface $element
	 */
	public function setRoot(FormManager_Model_Element_Interface $element) {
		// TODO описать исключение
		throw FormManager_Exceptions_NoAction();
	}

	/**
	 * TODO добавить описание
	 * 
	 * @return FormManager_Model_Form
	 */
	protected function getRoot() {
		// может возникнуть бесконечная рекурсия
		return $this;
	}

	/**
	 * Вставляет один или более элементов в конце списка
	 *
	 * @param FormManager_Item $item
	 * 
	 * @return FormManager_Model_Form
	 *//*
	public function add(FormManager_Model_Form $item) {
		$this->collection->add($item);
		return $this;
	}*/

	/**
	 * Разбирает строку запроса и добавляет скрытые поля с переменными из запроса
	 * Пример строки запроса: a=foo&b=bar
	 *
	 * @throws FormManager_Exceptions_Model_Form
	 * 
	 * @param string $query
	 * 
	 * @return FormManager_Model_Form
	 *//*
	public function addByQuery($query) {
		if ( !$query ) {
			return $this;
		}

		$query = explode('&', $query);
		foreach ($query as $var) {
			if ( substr_count($var, '=') != 1 ) {
				throw new FormManager_Exceptions_Model_Form('Cant add element because of improper URL query');
			}

			$var = explode('=', $var);
			$this->add(FormManager::Hidden($var[0])
				->setDefaultValue($var[1]));
		}
		return $this;
	}*/

	/**
	 * Вставляет кнопку на форму
	 *
	 * @param string $title
	 * @param array  $params
	 * 
	 * @return FormManager_Model_Form
	 *//*
	public function addButton($title, $params=null){
		if (!is_string($title) || !trim($title))
			throw new InvalidArgumentException('Title of button should not be an empty string');
		if ($params && !is_array($params))
			throw new InvalidArgumentException('Button parametrs should be an array');
		if (isset($params['type']) && !in_array($params['type'], array('button', 'reset', 'submit')))
			throw new InvalidArgumentException('Unsupported type of button');

		$this->options['buttons'][] = array($title, $params ? $params : array());
		return $this;
	}*/

	/**
	 * Рисует кнопку на форму
	 * 
	 * @return void
	 *//*
	public function drawButtons(){
		foreach ($this->options['buttons'] as $button)
			$this->drawButton($button[0], $button[1]);
	}*/

	/**
	 * Рисует кнопку на форму
	 * 
	 * @param string $title
	 * @param array  $params
	 *//*
	private function drawButton($title, $params=array()){
		include self::getTemplatePath('fields/button.php');
	}*/

	/**
	 * Производит проверку всех полей
	 * Псевдоним для FormManager_Collection::valid()
	 * 
	 * @return void
	 *//*
	public function valid(){
		$this->collection->valid();
	}*/

	/**
	 * Возвращает коллекцию элиментов формы
	 * 
	 * @return FormManager_Model_Collection_Primary
	 *//*
	public function getCollection() {
		return $this->collection;
	}*/

	/**
	 * Возвращает значение указанное пользователем
	 * 
	 * @param string $name
	 * 
	 * @return string
	 *//*
	public function &getSentValue($name) {
		// TODO убрать отсюда
		return $GLOBALS['_POST'][$name];
	}*/

	/**
	 * Очищает отправленные данные
	 *//*
	public function clearSentValues() {
		// TODO убрать отсюда
		$method = '_POST';
		unset($GLOBALS[$method]);
		// для корректной работы методов isAlreadySent
		// создается не пустой массив
		$GLOBALS[$method] = array(0);
//		$this->inputs = & $GLOBALS[$method];
	}*/

	/**
	 * Форма уже отправлена
	 * 
	 * @return boolean
	 *//*
	public function isAlreadySent() {
		// TODO убрать в фильтры
		if ( !isset($_SERVER['HTTP_REFERER'])
			|| !count($GLOBALS['_'.$this->options['method']])
			// должен быть установлен уникальный ключ,
			// но он не обнаружен в полученных данных
			|| ($this->options['method'] == 'GET'
				&& $this->getSentValue('unique_key_already_sent')
					!=='4ab24a54898e90ea76f23afc36a81819') ) {

			return false;
		}

		// получение тикущего хотса
		$current = ($_SERVER['SERVER_PROTOCOL'][4]=='S' ? 'https' : 'http').'://'
			.$_SERVER['HTTP_HOST'].'/';
		// разрешен прием форм в пределах одного хоста
		return strpos($_SERVER['HTTP_REFERER'], $current)===0;
	}*/

	/**
	 * Устанавливает шаблон вида формы
	 * 
	 * @throws InvalidArgumentException
	 * 
	 * @param string $template
	 * 
	 * @return FormManager_Model_Form
	 *//*
	public function setTemplate($template){
		if (!is_string($template) || !trim($template))
			throw new InvalidArgumentException('Display form must be not empty string');

		if (!file_exists(FORM_PATH.'/templates/'.$template.'/template.php'))
			throw new InvalidArgumentException('File of display ('.$template.') form do not exists');

		self::$template = $template;
		return $this;
	}*/

	/**
	 * Возвращает шаблон вида формы
	 * 
	 * @return string
	 *//*
	public function getTemplate(){
		return self::$template;
	}*/

	/**
	 * Выводит форму по шаблону
	 * 
	 * @return void
	 *//*
	public function draw(){
		include self::getTemplatePath('template.php');
	}*/

	/**
	 * Возвращает реальный путь к шаблону
	 * 
	 * @param string $path
	 * 
	 * @return string
	 *//*
	public static function getTemplatePath($path){
		if (file_exists(FORM_PATH.'/templates/'.self::$template.'/'.$path)){
			return FORM_PATH.'/templates/'.self::$template.'/'.$path;
		} elseif (file_exists(FORM_PATH.'/templates/.default/'.$path)){
			return FORM_PATH.'/templates/.default/'.$path;
		} else {
			throw new InvalidArgumentException('Template file ('.$path.') do not exists');
		}
	}*/

	/**
	 * Возвращает сообщение из языковой темы
	 * 
	 * @throws FormManager_Exceptions_Model_Form
	 * 
	 * @param string $post
	 * 
	 * @return string
	 *//*
	public function getLangPost($post) {
		if ( !isset($this->lang_posts[$post]) ) {
			throw new FormManager_Exceptions_Model_Form('Selected message is not found in the language theme');
		}

		return $this->lang_posts[$post];
	}*/

	/**
	 * Устанавливает адрес обработчика формы
	 *
	 * @throws FormManager_Exceptions_Model_Form
	 * 
	 * @param string $action
	 *//*
	public function setAction($action) {
		if (!is_string($action) || !trim($action)) {
			throw new FormManager_Exceptions_Model_Form('Form action must be not empty string');
		}
		$this->options['action'] = $action;
	}*/

	/**
	 * Возвращает адрес обработчика формы
	 *
	 * @return string
	 *//*
	public function getAction(){
		return $this->options['action'];
	}*/

	/**
	 * Устанавливает метод передачи данных
	 *
	 * @throws FormManager_Exceptions_Model_Form
	 * 
	 * @param string $method
	 * 
	 * @return FormManager_Model_Form
	 *//*
	public function setMethod($method) {
		$method = strtoupper($method);
		if ($method != 'POST' && $method != 'GET') {
			throw new FormManager_Exceptions_Model_Form('Form method must be POST or GET');
		}

		$this->options['method'] = $method;
		// добавление скрытого поля
		if ($method == 'GET' && !$this->getRoot()->isAddedByName('unique_key_already_sent')) {
			// TODO должен накладываться фильтр
			$field = new FormManager_Model_Field_Hidden();
			$field->setName('unique_key_already_sent');
			$field->setDefaultValue('4ab24a54898e90ea76f23afc36a81819');
			$this->getRoot()->add($field);
		}

		return $this;
	}*/

	/**
	 * Возвращает метод передачи данных
	 *
	 * @return string
	 *//*
	public function getMethod(){
		return $this->options['method'];
	}*/

	/**
	 * Устанавливает название формы
	 *
	 * @throws FormManager_Exceptions_Model_Form
	 * 
	 * @param string $name
	 * 
	 * @return FormManager_Model_Form
	 *//*
	public function setName($name) {
		if ( !is_string($name) || !trim($name) ) {
			throw new FormManager_Exceptions_Model_Form('Form name must be not empty string');
		}

		$this->options['name'] = $name;
		return $this;
	}*/

	/**
	 * Возвращает название формы
	 *
	 * @return string
	 *//*
	public function getName(){
		return $this->options['name'];
	}*/

	/**
	 * Устанавливает заголовок для кнопки отправки формы
	 *
	 * @throws FormManager_Exceptions_Model_Form
	 * 
	 * @param string $title
	 * 
	 * @return FormManager_Model_Form
	 *//*
	public function setSubmitTitle($title) {
		if ( !is_string($title) || !trim($title) ) {
			throw new FormManager_Exceptions_Model_Form('Form submit title must be not empty string');
		}

		$this->options['submit_title'] = $title;
		return $this;
	}*/

	/**
	 * Возвращает заголовок для кнопки отправки формы
	 *
	 * @return string
	 *//*
	public function getSubmitTitle(){
		return $this->options['submit_title'];
	}*/

	/**
	 * Метод для сериализации класса
	 *
	 * @return string
	 *//*
	public function serialize() {
		return serialize($this->export());
	}*/

	/**
	 * Метод для десериализации класса
	 *
	 * @param string $data
	 * 
	 * @return FormManager_Model_Form
	 */
	public function unserialize($data) {
		// TODO требуется тестирование
		$options = unserialize($data);
		$this->options = array_pop($options);
		parent::unserialize(serialize($options));
		return $this;
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 *//*
	public function export() {
		// TODO требуется тестирование
		$return = parent::export();
		$return[] = $this->options;
		return $return;
	}*/

	/**
	 * Заружает языковые сообщения
	 * 
	 * @throws InvalidArgumentException
	 *//*
	private function loadLangPosts() {
		if ( !file_exists(FORM_LANG_PATH) ) {
			throw new InvalidArgumentException('Language theme for this id is not found');
		}

		// загрузка списка сообщений
		include FORM_LANG_PATH;
		$this->lang_posts = & $lang;
	}*/

}