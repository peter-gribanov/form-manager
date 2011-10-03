<?php
$params = array_merge(array(
	'min' => 0,
	'max' => 0,
), $params);

$len = strlen($this->getValue());

if ($params['min'] && $params['max'] && ($len<$params['min'] || $len>$params['max'])){
	$this->error('length', array($params['min'], $params['max']));
} elseif ($params['min'] && $len<$params['min']){
	$this->error('length.min', array($params['min']));
} elseif ($params['max'] && $len>$params['max']){
	$this->error('length.max', array($params['max']));
}
?>