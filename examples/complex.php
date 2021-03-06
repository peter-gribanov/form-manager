
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form - Example 2</title>
<style type="text/css">
/* изменить вид поля со спиком годов */
.year {width:70px}
.year, .year option {text-align:right}
</style>
</head>
<body><?php

include('../FormManager.php');


try {
	// составление структуры формы
	$form = FormManager::Form()
//		->setLangID('ru')
		->addByQuery($_SERVER['QUERY_STRING'])
		->add(
			// добавление текстового поля для ввода email
			FormManager::Text('mail', 'Ваш E-Mail')
				// обязательно для заполнения
				->setFilter('empty')
				->setFilter('email')
		)
		->add(
			// поле для ввода текстового сообщения
			// обязательно для заполнения 
			FormManager::TextArea('mess', 'Ваше сообщение')
				->setFilter('empty')
		)
		->add(
			// добавление поля CheckBox для выбора оповещения
			FormManager::CheckBox('resend', 'Оповестить меня')
				// по умолчанию активно
				->setDefaultValue(true)
		)
		// установка имени формы
		->setName('example2')
		// установка текста для кнопки отправки формы
		->setSubmitTitle('Отправить анкету')
		// добавление вложенной коллекции с одним полем
		->add(
			FormManager::Collection()
				->add(
					// выпадающий список со спиком годов
					// в тегах options для value и label используются значения массива
					// по умолчанию для value используются ключи массива
					FormManager::Select('year', 'Год выпуска', array(
						'class'		=> 'year',
						'use_key'	=> false,
						'options'	=> array_keys(array_fill(date('Y')-20, 21, ''))
					))
					// значение по умолчанию: текущий год - 10
					->setDefaultValue(date('Y')-10)
					->setFilter('int')
					->setComment('Дата окончания института')
				)
				// устанавливает имя коллекции
				->setName('Вложенная коллекция 1')
		)
		->add(
			// добавление вложенной коллекции с двумя полями
			FormManager::Collection()
				->add(
					// текстовое поле для ввода даты
					FormManager::Text('date', 'Дата рождения')
						// по умолчанию текущая дата
						->setDefaultValue(date('j.n.Y'))
						// обязательно для заполнения
						->setFilter('empty')
						->setFilter('length', array(
							'min' => 8,
							'max' => 10
						))
				)
				->add(
					// выбор мола мужской или женский
					FormManager::Element('sex', 'Ваш пол')
						->setView('yesno', array(
							'value_no'	=> 'Жен',
							'value_yes' => 'Муж'
						))
						// по умолчанию мужской пол
						->setDefaultValue(true)
						->setFilter('bool')
				)
				// устанавливает имя коллекции
				->setName('Вложенная коллекция 2')
		);

	// обращение к коллекции и установка ее имени
	$form->getCollection()->setName('Основная коллекция');

} catch (Exception $e){
	// при составлении структуры формы допущена ошибка
	exit('<p><strong>Ошибка: '.$e->getMessage().'</strong></p>');
}



// форма заполнена и отправлена
if ($form->isAlreadySent()){
	// вывод отправленых данных
	var_dump($_POST);

	try {
		// проверка формы
		$form->valid();
		echo '<p><strong>Форма заполнена правильно.</strong></p>';

		// очистка отправленных данных
		$form->clearSentValues();

	} catch (FormManagerFilterException $e){
		// в форме обнаружена ошибка
		echo '<p><strong>Ошибка в форме: '.$e->getMessage().'</strong></p>';
	}
}



// вывод HTML структуры формы
$form->draw();
?>
</body>
</html>