<select name="<?=$this->getName().($params['multiple'] ? '[]' : '')?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['size']>1 ? ' size="'.$params['size'].'"' : '')?><?=
($params['multiple'] ? ' multiple="multiple"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?>>
<? foreach($params['options'] as $value=>$label):?>
<?php
$value = $params['use_key'] ? $value : $label;
?><option value="<?=$value?>" label="<?=$label?>"<?=
(($params['multiple'] && $this->getValue() && in_array($value, $this->getValue()))
	|| (string)$value==$this->getValue() ? ' selected="selected"' : '')?>><?=$label?></option>
<? endforeach?>
</select>