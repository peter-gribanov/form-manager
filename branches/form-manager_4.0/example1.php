<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form - Example 1</title>

</head>
<body><?php
//include('FormManager.php');
include('init.php');

$facade = new FormManager_Facade();
$form = $facade->getForm();
$form->setName('my-form');
$form->setTitle('My test form');
$facade->addField('text');
$facade->addField('select', $facade->getField()->Select());
p($facade->export());
exit;


try {
	// составление формы
	$form = FormManager::Form()
		// отправлять форму методом GET
		->setMethod('get')
		// добавление поля для ввода текстового сообщения
		->add(FormManager::Text('mess', 'Ваше сообщение'));

} catch (Exception $e){
	// при составлении структуры формы допущена ошибка
	exit('<p><strong>Ошибка: '.$e->getMessage().'</strong></p>');
}


// форма заполнена и отправлена
if ($form->isAlreadySent()){
	// вывод отправленых данных
	var_dump($_GET);

	try {
		// проверка формы
		$form->valid();
		echo '<p><strong>Форма заполнена правильно.</strong></p>';

	} catch (FormFilterException $e){
		// в форме обнаружена ошибка
		echo '<p><strong>Ошибка: '.$e->getMessage().'</strong></p>';
	}
}


// вывод HTML структуры формы
echo $form->draw();
?>
</body>
</html>