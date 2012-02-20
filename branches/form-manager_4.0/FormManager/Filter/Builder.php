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
 * Строитель фильтров
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Filter_Builder {

	/**
	 * Строитель
	 * 
	 * @var FormManager_Filter_Builder|null
	 */
	private static $instance = null;

	/**
	 * Элемент формы
	 * 
	 * @var FormManager_Element_Interface|null
	 */
	private $element = null;


	/**
	 * Возвращает экзкмпляр строителя
	 * 
	 * @param FormManager_Element_Interface $element Экзкмпляр элемента
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public static function getInstance(FormManager_Element_Interface $element) {
		if (!self::$instance) {
			self::$instance = new self();
		}
		self::$instance->element = $element;
		return self::$instance;
	}

	/**
	 * Применяет добавление фильтров к элементу
	 * 
	 * <p>
	 * В действительности метод ничего не применяет<br />
	 * Фильтры сами записываются в процессе создания<br />
	 * Метод просто возвращает элемент с уже добавленными фильтрами<br />
	 * Метод необходим для формирования цепочек вида:
	 * </p>
	 * <code>
	 * $MyElement
	 *     ->addFilters()
	 *     ->ToString(...)
	 *     ->NotEmpty(...)
	 *     ->apply()
	 *     ->assemble();
	 * </code>
	 * 
	 * @return FormManager_Element_Interface
	 */
	public function apply() {
		return $this->element;
	}

	/**
	 * Добавляет фильтр к элементу
	 * 
	 * @param FormManager_Filter_Interface $filter
	 * 
	 * @return FormManager_Element_Builder
	 */
	private function add(FormManager_Filter_Interface $filter) {
		$this->element->addFilter($filter);
		return $this;
	}

	/**
	 * Фильтер строки
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function ToString(){
		return $this->add(FormManager_Filter_Factory::getInstance()
			->ToString()
		);
	}

	/**
	 * Фильтра проверки на Null
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function NotNull() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->NotNull()
		);
	}

	/**
	 * Фильтра проверки на длинну строки
	 * 
	 * @param array $values Список значений
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function InArray(array $values = array()) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->InArray($values)
		);
	}

	/**
	 * Фильтер для очистки строки
	 * 
	 * @param string $charlist Дополнительные параметры очистки
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function String_Trim($charlist = '') {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->String_Trim($charlist)
		);
	}

	/**
	 * Валидатор длинны значения
	 * 
	 * @param integer $min Минимальная длинна
	 * @param integer $max Максимальная длинна
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Length($min = 0, $max = 0) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Length($min, $max)
		);
		return new FormManager_Filter_Length($min, $max);
	}

}