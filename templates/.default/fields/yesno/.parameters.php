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

return array(
	'id'        => 'form-field-yesno-'.$this->getName(),
	'class'     => '',
	'disabled'  => false,
	'value_no'  => $this->getLangPost('field-yesno-no'),
	'value_yes' => $this->getLangPost('field-yesno-yes')
);