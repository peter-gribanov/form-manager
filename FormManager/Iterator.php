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
 * Итератор по списку элементов
 * 
 * @package FormManager
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Iterator implements Iterator {

	/**
	 * Список элиментов
	 * 
	 * @var array
	 */
	private $list = array();


	/**
	 * Конструктор
	 * 
	 * @param array $list Итерируемый список
	 */
	public function __construct(array &$list) {
		$this->list = &$list;
	}

	/**
	 * TODO добавить описание
	 * 
	 * (non-PHPdoc)
	 * @see Iterator::current()
	 * 
	 * @return mixid
	 */
	public function current() {
		return current($this->list);
	}

	/**
	 * TODO добавить описание
	 * 
	 * (non-PHPdoc)
	 * @see Iterator::next()
	 * 
	 * @return mixid
	 */
	public function next() {
		return next($this->list);
	}

	/**
	 * TODO добавить описание
	 * 
	 * (non-PHPdoc)
	 * @see Iterator::key()
	 * 
	 * @return mixid
	 */
	public function key() {
		return key($this->list);
	}

	/**
	 * TODO добавить описание
	 * 
	 * (non-PHPdoc)
	 * @see Iterator::valid()
	 * 
	 * @return boolean
	 */
	public function valid() {
		return $this->current() !== false;
	}

	/**
	 * TODO добавить описание
	 * 
	 * (non-PHPdoc)
	 * @see Iterator::rewind()
	 * 
	 * @return mixid
	 */
	public function rewind() {
		return reset($this->list);
	}

}