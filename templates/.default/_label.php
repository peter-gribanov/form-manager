<?
/**
 * Генерация подписи к элементу
 * 
 * @param array   $element    Все ниже описанное в ассоциативном массиве
 * @param string  $name       Имя элемента
 * @param boolean $valid      Элемент валиден
 * @param boolean $changed    Элемент изменен
 * @param string  $fullname   Полное имя элемента в форме 
 * @param array   $filters    Фильтры [string,..]
 * @param array   $decorators Декораторы {'id':string,'template':string,'label':string,'idseparator':',','options':{'key':'value'}}
 * @param array   $errors     Ошибки [string,..]
 * @param muxed   $value      Значение
 * @param muxed   $default    Значение по умолчанию
 * @param muxed   $input      Значение отправленное пользователем
 */
?>
<?if(!empty($decorators['label'])):?>
	<label for="<?if(!empty($for)):?><?=$for?><?elseif(!empty($decorators['id'])):?><?=$decorators['id']?><?endif;?>" class="f-label">
		<?if(in_array('NotEmpty', $filters)):?>
			<em title="Обязательно для заполнения">*</em>
		<?endif;?>
		<?=$decorators['label']?>
	</label>
<?endif;?>
