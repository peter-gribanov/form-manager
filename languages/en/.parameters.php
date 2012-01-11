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
	'filter-boolean'         => 'You specify the value is not a boolean for field - %1$s.',
	'filter-boolean-values'  => 'You specify the value is not one of the two permissible (%2$s, %3$s) for field - %1$s.',
	'filter-length'          => 'You specify a value less than %2$s or more than %3$s characters for the field - %1$s.',
	'filter-length.eq'       => 'You have specified a value whose length is not equal to %2$s characters for the field - %1$s.',
	'filter-length.min'      => 'You specify a value of less than %2$s characters for the field - %1$s.',
	'filter-length.max'      => 'You specify a value of more than %2$s characters for the field - %1$s.',
	'filter-email'           => 'You have specify incorrect E-Mail in the field - %s.',
	'filter-select'          => 'You specify the value is not one of the list for the field - %s.',
	'filter-date'            => 'The specified date in your field %s does not fit DD.MM.YYYY.',
	'filter-form-referer'    => 'Form can be sent only from this server',
	'field-yesno-yes'        => 'Yes',
	'field-yesno-no'         => 'No',
// TODO нехватает кодов исключений
	'error-000'              => 'Unknown error',
	'error-200'              => 'Error in the model form',
	'error-300'              => 'Error in the model collections',
	'error-400'              => 'Error in the model questions',
	'error-500'              => 'Error in the model fields',
	'error-600'              => 'error filter',
	'error-700'              => 'Error in the database',
	'error-701'              => 'Name of driver of a database should be a string',
	'error-702'              => 'The driver class of the database is not responding interface "FormManager_Db_Interface"',
);