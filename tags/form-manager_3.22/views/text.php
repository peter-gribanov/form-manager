<?php
$params = array_merge(array(
	'id'		=> '',
	'class'		=> '',
	'disabled'	=> false
), $this->getViewParams());

?><input type="text" name="<?=$this->getName()?>" value="<?=$this->getValue()?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?> />