<?php
$params = array_merge(array(
	'use_key' => true,
	'options' => array(),
), $this->getViewParams());

$label = $params['use_key'] ? array_keys($params['options']) : array_values($params['options']);

if (!in_array($this->getValue(), $label)){
	$this->error('select');
}
?>