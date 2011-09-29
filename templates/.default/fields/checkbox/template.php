<input type="checkbox" name="<?=$this->getName()?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?><?=
($this->getValue() ? ' checked="checked"' : '')?> />