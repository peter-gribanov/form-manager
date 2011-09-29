<?php
$params = array(
	'id'		=> '',
	'class'		=> '',
	'disabled'	=> false
);

// преобразование в bool если значение было указано некорректно
if (!is_bool($this->getDefaultValue()))
	$this->setDefaultValue((bool)$this->getDefaultValue());