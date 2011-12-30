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
	 * Конструктор
	 */
	public function __construct() {
		$this->setDecorator('action', '');
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
		throw new FormManager_Exceptions_NoAction();
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
		throw new FormManager_Exceptions_NoAction();
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

}