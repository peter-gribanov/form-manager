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
	'default_submit_title' => 'Submit',
	'required_fields'      => 'Required fields',
	'null'                 => 'No information about the field - %s.',
	'empty'                => 'You have not filled the field - %s.',
	'int'                  => 'You have specified an integer field - %s.',
	'float'                => 'You have specified floating-point number in the field - %s.',
	'bool'                 => 'You specify the value is not one of the two permissible%2$s for field - %1$s.',
	'length'               => 'You specify a value less than %2$s or more than %3$s characters for the field - %1$s.',
	'length.eq'            => 'You have specified a value whose length is not equal to %2$s characters for the field - %1$s.',
	'length.min'           => 'You specify a value of less than %2$s characters for the field - %1$s.',
	'length.max'           => 'You specify a value of more than %2$s characters for the field - %1$s.',
	'email'                => 'You have specify incorrect E-Mail in the field - %s.',
	'select'               => 'You specify the value is not one of the list for the field - %s.',
	'kcaptcha'             => 'You have entered an incorrect verification code in the field - %s.',
	'kcaptcha-length'      => 'Confirmation code consists of %s characters.',
	'kcaptcha-link'        => 'With poor legibility %supdate%s code.',
	'date'                 => 'The specified date in your field %s does not fit DD.MM.YYYY.',
	'field-yesno-yes'      => 'Yes',
	'field-yesno-no'       => 'No',
	'exception-200'        => 'Error in the model form',
	'exception-300'        => 'Error in the model collections',
	'exception-400'        => 'Error in the model questions',
	'exception-500'        => 'Error in the model fields',
	'exception-600'        => 'Exception filter',
	'exception-700'        => 'Error in the database',
	'exception-701'        => 'Name of driver of a database should be a string',
	'exception-702'        => 'The driver class of the database is not responding interface "FormManager_Db_Interface"',
);