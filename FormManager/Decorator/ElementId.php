<?php
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 41 $
 * @since     $Date: 2011-10-01 00:28:31 +0400 (Сб, 01 окт 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */

/**
 * Декоратор генерирует уникальный ID для элемента
 * 
 * @package FormManager\Decorator
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Decorator_ElementId extends FormManager_Decorator_Abstract {

	/**
	 * Префикс для ID
	 *
	 * @var string
	 */
	private $prefix = '';

	/**
	 * Разделитель имен ID
	 *
	 * @var string
	 */
	private $separator = '-';

	/**
	 * Конструктор
	 *
	 * @param string $prefix    Префикс для ID
	 * @param string $separator Разделитель имен ID
	 */
	public function __construct($prefix, $separator) {
		$this->prefix = $prefix;
		$this->separator = $separator;
	}

	/**
	 * Вернуть рендер декоратора в представление
	 *
	 * @return string
	 */
	public function assemble() {
		$id = array();
		$ele = $this->element;
		do {
			$id[] = $ele->getName();
			$ele = $ele->getParent();
		} while (!is_null($ele));
		// у элементов нет имен
		if (!$id) {
			return '';
		}
		$id[] = $this->prefix;
		return implode($this->separator, array_reverse($id));
	}
}
