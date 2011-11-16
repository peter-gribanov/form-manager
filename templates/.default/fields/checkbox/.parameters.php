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

// преобразование в bool если значение было указано некорректно
if ( !is_bool($this->getDefaultValue()) ) {
	$this->setDefaultValue((bool)$this->getDefaultValue());
}

return array(
	'id'       => '',
	'class'    => '',
	'disabled' => false
);