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
	 * Фильтер строки
	 */
	public function ToString() {
		return new FormManager_Filter_ToString();
	}

}