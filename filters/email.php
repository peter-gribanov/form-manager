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

// Check for @ symbol
if ( substr_count($this->getValue(), '@') != 1 ) {
	$this->error('email');
}
if ( function_exists('filter_var') && !filter_var($this->getValue(), FILTER_VALIDATE_EMAIL) ) {
	$this->error('email');
}
//$reg = '/^(?:[-a-z0-9])+@(?:[-a-z0-9]{2,}\.)+(?:[a-z]{2,4}|[0-9]{1,4})$/i';
$reg = file_get_contents(FORM_MANAGER_PATH.'/filters/mail.address.validation.re');
if ( !preg_match($reg, $this->getValue()) ) {
	$this->error('email');
}
