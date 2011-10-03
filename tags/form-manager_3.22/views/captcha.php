<?php
$params = array_merge(array(
	'width'		=> 0,
	'height'	=> 0,
	'length'	=> 0,
	'id'		=> '',
	'class'		=> '',
	'disabled'	=> false
), $this->getViewParams());

?><img src="<?=HOST?>/formmanager/views/captcha/?<?=
($params['width'] ? 'w='.$params['width'].'&' : '')?><?=
($params['height'] ? 'h='.$params['height'].'&' : '')?><?=
($params['length'] ? 'l='.$params['length'].'&' : '')?>_=<?=time()?>" id="form-captcha-image" alt="" /><br />
<div class="comment"><?=sprintf($this->getLangPost('captcha-length'), $params['length'])?></div>
<input type="password" name="<?=$this->getName()?>" value="<?=$this->getValue()?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?> />