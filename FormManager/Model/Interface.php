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
 * Интерфейс модели
 * 
 * @package FormManager\Model
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface FormManager_Model_Interface {

	/**
	 * Возвращает все данные
	 * 
	 * @return array
	 */
	public function export();

}