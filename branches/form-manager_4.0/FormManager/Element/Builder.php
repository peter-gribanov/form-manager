<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 98 $
 * @since     $Date: 2011-11-22 23:49:26 +0400 (Вт., 22 нояб. 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Строитель элементов формы
 * 
 * @package FormManager\Element
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Element_Builder {

	/**
	 * Строитель
	 * 
	 * @var FormManager_Element_Builder|null
	 */
	private static $instance = null;

	/**
	 * Элемент коллекции
	 * 
	 * @var FormManager_Collection_Interface
	 */
	private $collection = null;


	/**
	 * Возвращает экзкмпляр фабрики
	 * 
	 * @param FormManager_Collection_Interface $collection Экзкмпляр колекции
	 * 
	 * @return FormManager_Element_Builder
	 */
	public static function getInstance(FormManager_Collection_Interface $collection) {
		if (!self::$instance) {
			self::$instance = new self();
		}
		self::$instance->collection = $collection;
		return self::$instance;
	}

	/**
	 * Применяет добавление элементов в коллекцию
	 * 
	 * <p>
	 * В действительности метод ничего не применяет<br />
	 * Элементы сами записываются в процессе создания<br />
	 * Метод просто возвращает коллекцию с уже добавленными элементами<br />
	 * Метод необходим для формирования цепочек вида:
	 * </p>
	 * <code>
	 * $MyCollection
	 *     ->addChilds()
	 *     ->Text(...)
	 *     ->Select(...)
	 *     ->apply()
	 *     ->assemble();
	 * </code>
	 * 
	 * @return FormManager_Collection_Interface
	 */
	public function apply() {
		return $this->collection;
	}

	/**
	 * Добавляет элемент в коллекцию
	 * 
	 * @param FormManager_Element_Interface $element
	 * 
	 * @return FormManager_Element_Builder
	 */
	private function add(FormManager_Element_Interface $element) {
		$this->collection->addChild($element);
		return $this;
	}

	/**
	 * Возвращает поле Select
	 * 
	 * @param string|null $name    Имя элемента
	 * @param string|null $value   Значение по умолчанию
	 * @param string|null $label   Подпись элемента
	 * @param array|null  $options Параметры выбора
	 * 
	 * @return FormManager_Element_Builder
	 */
	public function Select($name = null, $value = null, $label = null, array $options = array()){
		return $this->add(FormManager_Element_Factory::getInstance()
			->Select($name, $value, $label, $options)
		);
	}

	/**
	 * Возвращает поле Text
	 * 
	 * @param string|null $name  Имя элемента
	 * @param string|null $value Значение по умолчанию
	 * @param string|null $label Подпись элемента
	 * 
	 * @return FormManager_Element_Builder
	 */
	public function Text($name = null, $value = null, $label = null){
		return $this->add(FormManager_Element_Factory::getInstance()
			->Text($name, $value, $label)
		);
	}

}