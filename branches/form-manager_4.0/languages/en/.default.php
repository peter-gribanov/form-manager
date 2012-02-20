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
	// Шаблонные сообщения
	'view:default_submit_title' => 'Submit',
	'view:field_yesno_yes'      => 'Yes',
	'view:field_yesno_no'       => 'No',
	// Сообщения фильтров
	'filter:is_null'      => 'No information about the field',
	'filter:is_empty'     => 'You have not filled the field',
	'filter:length'       => 'You specify a value less than %2$s or more than %3$s characters',
	'filter:length_equal' => 'You have specified a value whose length is not equal to %2$s characters',
	'filter:length_min'   => 'You specify a value of less than %2$s characters',
	'filter:length_max'   => 'You specify a value of more than %2$s characters',
	'filter:bad_email'    => 'You have specify incorrect E-Mail',
	'filter:not_found'    => 'You specify the value is not one of the list',
	'filter:date'         => 'The specified date does not fit %s',
	'filter:time'         => 'The specified time does not fit %s',
	'filter:bad_char'     => 'In the field you can enter only alphabetic characters',
	'filter:bad_char_num' => 'In the field you can enter only alphabetic characters and digits',
	'filter:bad_referer'  => 'Form can be sent only from this server',
	'filter:phone'        => '',
	'filter:not_equal'    => '',
	'filter:beyond_max'   => '',
	'filter:beyond_min'   => '',
	'filter:range'        => '',
	// Сообщения исключений
// TODO нехватает кодов исключений
	'error:000' => 'Unknown error',
	'error:200' => 'Error in the model form',
	'error:300' => 'Error in the model collections',
	'error:400' => 'Error in the model questions',
	'error:500' => 'Error in the model fields',
	'error:600' => 'error filter',
	'error:700' => 'Error in the database',
	'error:701' => 'Name of driver of a database should be a string',
	'error:702' => 'The driver class of the database is not responding interface "FormManager_Db_Interface"',
);