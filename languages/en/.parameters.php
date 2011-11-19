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
	'default_submit_title'   => 'Submit',
	'required_fields'        => 'Required fields',
	'filter-null'            => 'No information about the field - %s.',
	'filter-empty'           => 'You have not filled the field - %s.',
	'filter-integer'         => 'You have specified an integer field - %s.',
	'filter-float'           => 'You have specified floating-point number in the field - %s.',
	'filter-boolen'          => 'You specify the value is not one of the two permissible%2$s for field - %1$s.',
	'filter-length'          => 'You specify a value less than %2$s or more than %3$s characters for the field - %1$s.',
	'filter-length.eq'       => 'You have specified a value whose length is not equal to %2$s characters for the field - %1$s.',
	'filter-length.min'      => 'You specify a value of less than %2$s characters for the field - %1$s.',
	'filter-length.max'      => 'You specify a value of more than %2$s characters for the field - %1$s.',
	'filter-email'           => 'You have specify incorrect E-Mail in the field - %s.',
	'filter-select'          => 'You specify the value is not one of the list for the field - %s.',
	'filter-kcaptcha'        => 'You have entered an incorrect verification code in the field - %s.',
	'filter-kcaptcha-length' => 'Confirmation code consists of %s characters.',
	'filter-kcaptcha-link'   => 'With poor legibility %supdate%s code.',
	'filter-date'            => 'The specified date in your field %s does not fit DD.MM.YYYY.',
	'filter-form-referer'    => 'Form can be sent only from this server',
	'field-yesno-yes'        => 'Yes',
	'field-yesno-no'         => 'No',
//@todo нехватает кодов исключений
	'exception-000'          => 'Unknown error',
	'exception-200'          => 'Error in the model form',
	'exception-300'          => 'Error in the model collections',
	'exception-400'          => 'Error in the model questions',
	'exception-500'          => 'Error in the model fields',
	'exception-600'          => 'Exception filter',
	'exception-700'          => 'Error in the database',
	'exception-701'          => 'Name of driver of a database should be a string',
	'exception-702'          => 'The driver class of the database is not responding interface "FormManager_Db_Interface"',
);