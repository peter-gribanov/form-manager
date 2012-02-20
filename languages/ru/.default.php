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
	'view:default_submit_title' => 'Отправить',
	'view:field_yesno_yes'      => 'Да',
	'view:field_yesno_no'       => 'Нет',
	// Сообщения фильтров
	'filter:is_null'      => 'Нет информации о поле',
	'filter:is_empty'     => 'Вы не заполнили поле',
	'filter:length'       => 'Вы указали значение длинною меньше %2$s или больше %3$s символов',
	'filter:length_equal' => 'Вы указали значение длина которого не равна %2$s символов',
	'filter:length_min'   => 'Вы указали значение длинною меньше %2$s символов',
	'filter:length_max'   => 'Вы указали значение длинною больше %2$s символов',
	'filter:bad_email'    => 'Вы указали некорректный E-Mail',
	'filter:not_found'    => 'Указанное Вами значение не является одним из списка',
	'filter:date'         => 'Указанная Вами дата не соответствует формату %s',
	'filter:time'         => 'Указанная Вами время не соответствует формату %s',
	'filter:bad_char'     => 'В поле можно вводить только символы алфавита',
	'filter:bad_char_num' => 'В поле можно вводить только символы алфавита и цифры',
	'filter:bad_referer'  => 'Форма может быть отправлена только с этого сервера',
	'filter:phone'        => '',
	'filter:not_equal'    => '',
	'filter:beyond_max'   => '',
	'filter:beyond_min'   => '',
	'filter:range'        => '',
	// Сообщения исключений
// TODO нехватает кодов исключений
	'error:000' => 'Неизвестная ошибка',
	'error:200' => 'Ошибка в модели формы',
	'error:300' => 'Ошибка в моделе коллекций',
	'error:400' => 'Ошибка в модели вопросов',
	'error:500' => 'Ошибка в модели полей',
	'error:600' => 'Исключене фильтра',
	'error:700' => 'Ошибка в базе данных',
	'error:701' => 'Имя драйвера базы данных должно быть не пустой строкой',
	'error:702' => 'Класс драйвера базы данных не отвечает требованиям интерфейса "FormManager_Db_Interface"',
);