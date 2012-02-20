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
 * Фабрика фильтров
 * 
 * @package FormManager\Filter
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
final class FormManager_Filter_Factory {

	/**
	 * Фабрика
	 * 
	 * @var FormManager_Filter_Factory|null
	 */
	private static $instance = null;


	/**
	 * Возвращает экзкмпляр фабрики
	 * 
	 * @return FormManager_Filter_Factory
	 */
	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Валидатор символов
	 * 
	 * @return FormManager_Filter_Characters
	 */
	public function Characters() {
		return new FormManager_Filter_Characters();
	}

	/**
	 * Валидатор символво и цифр
	 * 
	 * @return FormManager_Filter_CharactersAndNumbers
	 */
	public function CharactersAndNumbers() {
		return new FormManager_Filter_CharactersAndNumbers();
	}

	/**
	 * Валидатор даты
	 * 
	 * @param string $format Формат даты
	 * 
	 * @return FormManager_Filter_Date
	 */
	public function Date($format = 'YYYY-MM-DD') {
		return new FormManager_Filter_Date($format);
	}

	/**
	 * Фильтра проверки формата e
	 * 
	 * @return FormManager_Filter_Email
	 */
	public function Email() {
		return new FormManager_Filter_Email();
	}

	/**
	 * Фильтер перобразует пустое значение в null
	 * 
	 * @return FormManager_Filter_EmptyToNull
	 */
	public function EmptyToNull() {
		return new FormManager_Filter_EmptyToNull();
	}

	/**
	 * Валидатор не соответствие заданной строке
	 * 
	 * @param unknown_type $equal_value    Ожидаемое значение
	 * @param boolean      $on_error_reset Очищать при ошибке
	 * 
	 * @return FormManager_Filter_Equal
	 */
	public function Equal($equal_value, $on_error_reset = false) {
		return new FormManager_Filter_Equal($equal_value, $on_error_reset);
	}

	/**
	 * Фильтр проверяет с нашего ли хоста отправлена форма
	 * 
	 * @param string $referer Адрес предыдущей страници
	 * @param string $server  Адрес сервера
	 * 
	 * @return FormManager_Filter_Form_Referer
	 */
	public function Form_Referer($referer, $server) {
		return new FormManager_Filter_Form_Referer($referer, $server);
	}

	/**
	 * Фильтра проверки на длинну строки
	 * 
	 * @param array $values Список значений
	 * 
	 * @return FormManager_Filter_InArray
	 */
	public function InArray(array $values = array ()) {
		return new FormManager_Filter_InArray($values);
	}

	/**
	 * Валидатор длинны значения
	 * 
	 * @param integer $min Минимальная длинна
	 * @param integer $max Максимальная длинна
	 * 
	 * @return FormManager_Filter_Length
	 */
	public function Length($min = 0, $max = 0) {
		return new FormManager_Filter_Length($min, $max);
	}

	/**
	 * Валидатор максимального значения
	 * 
	 * @param integer $value Максимальное значение
	 * 
	 * @return FormManager_Filter_MaxValue
	 */
	public function MaxValue($max) {
		return new FormManager_Filter_MaxValue($max);
	}

	/**
	 * Валидатор минимального значения
	 * 
	 * @param integer $min Минимальное значение
	 * 
	 * @return FormManager_Filter_MinValue
	 */
	public function MinValue($min) {
		return new FormManager_Filter_MinValue($min);
	}

	/**
	 * Фильтер не пусто
	 * 
	 * @return FormManager_Filter_NotEmpty
	 */
	public function NotEmpty() {
		return new FormManager_Filter_NotEmpty();
	}

	/**
	 * Фильтра проверки на Null
	 * 
	 * @return FormManager_Filter_NotNull
	 */
	public function NotNull() {
		return new FormManager_Filter_NotNull();
	}

	/**
	 * Фильтер преобразующий к массиву
	 * 
	 * @return FormManager_Filter_NullToArray
	 */
	public function NullToArray() {
		return new FormManager_Filter_NullToArray();
	}

	/**
	 * Фильтер преобразующий к булеану
	 * 
	 * @return FormManager_Filter_NullToBoolean
	 */
	public function NullToBoolean() {
		return new FormManager_Filter_NullToBoolean();
	}

	/**
	 * Фильтер преобразующий к значению по умолчанию
	 * 
	 * @return FormManager_Filter_NullToDefault
	 */
	public function NullToDefault() {
		return new FormManager_Filter_NullToDefault();
	}

	/**
	 * Фильтер преобразующий к строке
	 * 
	 * @return FormManager_Filter_NullToString
	 */
	public function NullToString() {
		return new FormManager_Filter_NullToString();
	}

	/**
	 * Валидатор телефона
	 * 
	 * @return FormManager_Filter_Phone
	 */
	public function Phone() {
		return new FormManager_Filter_Phone();
	}

	/**
	 * Валидатор диапазона
	 * 
	 * @param integer $from Начальная позиция
	 * @param integer $to   Конечная позиция
	 * 
	 * @return FormManager_Filter_RangeValue
	 */
	public function RangeValue($from, $to) {
		return new FormManager_Filter_RangeValue($from, $to);
	}

	/**
	 * Фильтер для очистки строки
	 * 
	 * @param string $charlist Дополнительные параметры очистки
	 * 
	 * @return FormManager_Filter_String_Trim
	 */
	public function String_Trim($charlist = '') {
		return new FormManager_Filter_String_Trim($charlist);
	}

	/**
	 * Валидатор времени
	 * 
	 * @param string $format Формат даты
	 * 
	 * @return FormManager_Filter_Time
	 */
	public function Time($format = 'HH:MM') {
		return new FormManager_Filter_Time($format);
	}

	/**
	 * Фильтра массива
	 * 
	 * @return FormManager_Filter_ToArray
	 */
	public function ToArray() {
		return new FormManager_Filter_ToArray();
	}

	/**
	 * Фильтра булеана
	 * 
	 * @return FormManager_Filter_ToBoolean
	 */
	public function ToBoolean() {
		return new FormManager_Filter_ToBoolean();
	}

	/**
	 * Фильтер чисел с плавоющей точкой
	 * 
	 * @return FormManager_Filter_ToFloat
	 */
	public function ToFloat() {
		return new FormManager_Filter_ToFloat();
	}

	/**
	 * Фильтер чисел
	 * 
	 * @return FormManager_Filter_ToInteger
	 */
	public function ToInteger() {
		return new FormManager_Filter_ToInteger();
	}

	/**
	 * Фильтер строки
	 * 
	 * @return FormManager_Filter_ToString
	 */
	public function ToString() {
		return new FormManager_Filter_ToString();
	}

}