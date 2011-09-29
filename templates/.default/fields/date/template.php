<input type="text" name="<?=$this->getName()?>" value="<?=$this->getValue()?>"<?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?><?=
($params['length'] ? ' maxlength="'.$params['length'].'"' : '')
?> class="<?=($params['class'] ? $params['class'].' ' : '')?>datepicker" />