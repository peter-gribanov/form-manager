<?php
$params = array_merge(array(
	'id'		=> '',
	'class'		=> '',
	'disabled'	=> false,
	'value_no'	=> 'No',
	'value_yes'	=> 'Yes'
), $this->getViewParams());

?><div<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?>><?=$params['value_no']
?> <input type="radio" name="<?=$this->getName()?>" value="0"<?=
($params['class'] ? ' class="'.$params['class'].'-no"' : '')?><?=
(!$this->getValue() ? ' checked="checked"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')
?> /> <input type="radio" name="<?=$this->getName()?>" value="1"<?=
($params['disabled'] ? ' disabled="disabled"' : '')?><?=
($params['class'] ? ' class="'.$params['class'].'-yes"' : '')?><?=
($this->getValue() ? ' checked="checked"' : '')
?> /> <?=$params['value_yes']?></div>