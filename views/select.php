<?php
$params = array_merge(array(
	'id'		=> '',
	'class'		=> '',
	'size'		=> 1,
	'use_key'	=> true,
	'options'	=> array(),
	'multiple'	=> false,
	'disabled'	=> false
), $this->getViewParams());

?><select name="<?=$this->getName()?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['size']>1 ? ' size="'.$params['size'].'"' : '')?><?=
($params['multiple'] ? ' multiple="multiple"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?>>
<? foreach($params['options'] as $value=>$label):?>
<?php
$value = $params['use_key'] ? $value : $label;
?><option value="<?=$value?>" label="<?=$label?>"<?=
((string)$value==$this->getValue() ? ' selected="selected"' : '')?>><?=$label?></option>
<? endforeach?>
</select>