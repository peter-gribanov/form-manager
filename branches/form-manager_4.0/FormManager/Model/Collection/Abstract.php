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
 * Абстрактный класс коллекции элементов формы
 * 
 * @package FormManager\Model\Collection
 * @author  Peter S. Gribanov <info@peter-gribanov.ru>
 */
abstract class FormManager_Model_Collection_Abstract extends FormManager_Model_Collection_Item_Abstract implements FormManager_Model_Collection_Interface {

	/**
	 * Название коллекции
	 *
	 * @var	string
	 */
	protected $name = '';

	/**
	 * Список элементов
	 *
	 * @var	array
	 */
	protected $items = array();


	/**
	 * Устанавливает название коллекции
	 * 
	 * @throws FormManager_Model_Collection_Exception
	 * 
	 * @param string $name Название коллекции
	 * 
	 * @return FormManager_Model_Collection_Abstract Объект коллекции
	 */
	public function setName($name){
		if (!is_string($name) || !trim($name)) {
			throw new FormManager_Model_Collection_Exception('Collection name must be not empty string', 601);
		}
		$this->name = $name;
		return $this;
	}

	/**
	 * Возвращает название коллекции
	 * 
	 * @return string
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Добавляет элемент
	 * 
	 * @param FormManager_Model_Collection_Item_Interface $item Объект элимента
	 * 
	 * @return FormManager_Model_Collection_Abstract Объект коллекции
	 */
	public function add(FormManager_Model_Collection_Item_Interface $item){
		$this->items[] = $item->setForm($this->form);
		return $this;
	}

	/**
	 * Очищает список элементов
	 * 
	 * @return FormManagerCollection Объект коллекции
	 */
	public function clear(){
		unset($this->items);
		$this->items = array();
		return $this;
	}

	/**
	 * Проверяет пуста ли коллекция
	 * 
	 * @return boolean Результат проверки
	 */
	public function isEmpty(){
		return !$this->items;
	}

	/**
	 * Метод для сериализации класса
	 * 
	 * @return string Сериализованная коллекция
	 */
	public function serialize(){
		return serialize($this->export());
	}

	/**
	 * Метод для десериализации класса
	 * 
	 * @param string $data Сериализованная коллекция
	 * 
	 * @return void
	 */
	public function unserialize($data){
		list(
			$this->name,
			$this->items
		) = unserialize($data);
	}

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export(){
		return array(
			$this->name,
			$this->items,
		);
	}
	
}