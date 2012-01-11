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
	'default_submit_title'   => 'Отправить',
	'required_fields'        => 'Поля обязательные для заполнения',
	'filter-null'            => 'Нет информации о поле - %s.',
	'filter-empty'           => 'Вы не заполнили поле - %s.',
	'filter-integer'         => 'Вы указали не целое число в поле - %s.',
	'filter-float'           => 'Вы указали не число с плавающей запятой в поле - %s.',
	'filter-boolean'         => 'Указанное Вами значение не является логическим булевом для поля - %1$s.',
	'filter-boolean-values'  => 'Указанное Вами значение не является одним из двух допустимых (%2$s, %3$s) для поля - %1$s.',
	'filter-length'          => 'Вы указали значение длинною меньше %2$s или больше %3$s символов для поля - %1$s.',
	'filter-length.eq'       => 'Вы указали значение длина которого не равна %2$s символов для поля - %1$s.',
	'filter-length.min'      => 'Вы указали значение длинною меньше %2$s символов для поля - %1$s.',
	'filter-length.max'      => 'Вы указали значение длинною больше %2$s символов для поля - %1$s.',
	'filter-email'	         => 'Вы указали некорректный E-Mail в поле - %s.',
	'filter-select'	         => 'Указанное Вами значение не является одним из списка для поля - %s.',
	'filter-date'	         => 'Указанная Вами дата в поле %s не соответствует формату DD.MM.YYYY.',
	'filter-form-referer'    => 'Форма может быть отправлена только с этого сервера',
	'field-yesno-yes'	     => 'Да',
	'field-yesno-no'	     => 'Нет',
//@todo нехватает кодов исключений
	'exception-000'          => 'Неизвестная ошибка',
	'exception-200'          => 'Ошибка в модели формы',
	'exception-300'          => 'Ошибка в моделе коллекций',
	'exception-400'          => 'Ошибка в модели вопросов',
	'exception-500'          => 'Ошибка в модели полей',
	'exception-600'          => 'Исключене фильтра',
	'exception-700'          => 'Ошибка в базе данных',
	'exception-701'          => 'Имя драйвера базы данных должно быть не пустой строкой',
	'exception-702'          => 'Класс драйвера базы данных не отвечает требованиям интерфейса "FormManager_Db_Interface"',
);