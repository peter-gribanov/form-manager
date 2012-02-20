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
 * Фильтр проверяет с нашего ли хоста отправлена форма
 * 
 * @package FormManager\Filter\Form
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class FormManager_Filter_Form_Referer extends FormManager_Filter_Abstract {

	/**
	 * Адрес предыдущей страници
	 *
	 * @var string
	 */
	private $referer = '';

	/**
	 * Адрес сервера
	 *
	 * @var string
	 */
	private $server = '';


	/**
	 * Конструктор
	 *
	 * @param string $referer Адрес предыдущей страници
	 * @param string $server  Адрес сервера
	 */
	public function __construct($referer, $server) {
		$this->referer = preg_replace('https?:\/\/', '', $referer);
		$this->server = preg_replace('https?:\/\/', '', $server);
	}

	/**
	 * Фильтровать и проверить ненадёжные данные
	 * 
	 * @param mixed                         $value   Проверяемые данные
	 * @param FormManager_Element_Interface $element Проверяемый елемент
	 */
	public function exec($value, FormManager_Element_Interface $element){
		if (strpos($this->referer, $this->server) !== 0) {
			$this->addError('bad_referer');
		}
	}

}