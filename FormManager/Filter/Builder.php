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
	 * Валидатор символов
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Characters() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Characters()
		);
	}

	/**
	 * Валидатор символво и цифр
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function CharactersAndNumbers() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->CharactersAndNumbers()
		);
	}

	/**
	 * Валидатор даты
	 * 
	 * @param string $format Формат даты
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Date($format = 'YYYY-MM-DD') {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Date($format)
		);
	}

	/**
	 * Фильтра проверки формата e
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Email() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Email()
		);
	}

	/**
	 * Фильтер перобразует пустое значение в null
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function EmptyToNull() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->EmptyToNull()
		);
	}

	/**
	 * Валидатор не соответствие заданной строке
	 * 
	 * @param unknown_type $equal_value    Ожидаемое значение
	 * @param boolean      $on_error_reset Очищать при ошибке
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Equal($equal_value, $on_error_reset = false) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Equal($equal_value, $on_error_reset)
		);
	}

	/**
	 * Фильтр проверяет с нашего ли хоста отправлена форма
	 * 
	 * @param string $referer Адрес предыдущей страници
	 * @param string $server  Адрес сервера
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Form_Referer($referer, $server) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Form_Referer($referer, $server)
		);
	}

	/**
	 * Фильтра проверки на длинну строки
	 * 
	 * @param array $values Список значений
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function InArray(array $values = array ()) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->InArray($values)
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
	}

	/**
	 * Валидатор максимального значения
	 * 
	 * @param integer $value Максимальное значение
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function MaxValue($max) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->MaxValue($max)
		);
	}

	/**
	 * Валидатор минимального значения
	 * 
	 * @param integer $min Минимальное значение
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function MinValue($min) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->MinValue($min)
		);
	}

	/**
	 * Фильтер не пусто
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function NotEmpty() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->NotEmpty()
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
	 * Фильтер преобразующий к массиву
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function NullToArray() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->NullToArray()
		);
	}

	/**
	 * Фильтер преобразующий к булеану
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function NullToBoolean() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->NullToBoolean()
		);
	}

	/**
	 * Фильтер преобразующий к значению по умолчанию
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function NullToDefault() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->NullToDefault()
		);
	}

	/**
	 * Фильтер преобразующий к строке
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function NullToString() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->NullToString()
		);
	}

	/**
	 * Валидатор телефона
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Phone() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Phone()
		);
	}

	/**
	 * Валидатор диапазона
	 * 
	 * @param integer $from Начальная позиция
	 * @param integer $to   Конечная позиция
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function RangeValue($from, $to) {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->RangeValue($from, $to)
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
	 * Валидатор времени
	 * 
	 * @param string $format Формат даты
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function Time($format = 'HH:MM') {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->Time($format)
		);
	}

	/**
	 * Фильтра массива
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function ToArray() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->ToArray()
		);
	}

	/**
	 * Фильтра булеана
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function ToBoolean() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->ToBoolean()
		);
	}

	/**
	 * Фильтер чисел с плавоющей точкой
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function ToFloat() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->ToFloat()
		);
	}

	/**
	 * Фильтер чисел
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function ToInteger() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->ToInteger()
		);
	}

	/**
	 * Фильтер строки
	 * 
	 * @return FormManager_Filter_Builder
	 */
	public function ToString() {
		return $this->add(FormManager_Filter_Factory::getInstance()
			->ToString()
		);
	}

}