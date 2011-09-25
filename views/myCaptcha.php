<?php
$params = array_merge(array(
	'width'		=> 0,
	'height'	=> 0,
	'length'	=> 0,
	'id'		=> '',
	'class'		=> '',
	'disabled'	=> false
), $this->getViewParams());

?><img src="<?=HOST?>/tools/captcha.php?<?=
($params['width'] ? 'w='.$params['width'].'&' : '')?><?=
($params['height'] ? 'h='.$params['height'].'&' : '')?><?=
($params['length'] ? 'l='.$params['length'].'&' : '')?>_=<?=time()?>" id="form-captcha-image" alt="" /><br />
<div class="comment">Код состоит из <?=$params['length']?> символов.<br />При плохой разборчивости <a href="" id="form-captcha-button" class="global-link">обновите</a> код.</div>
<input type="password" name="<?=$this->getName()?>" value="<?=$this->getValue()?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?> />
<script type="text/javascript">
$(function(){
function reload(){
	$('#form-captcha-button').click(function(e){
		$('#form-captcha-image').attr('src',
			$('#form-captcha-image').attr('src').replace(/(\?.*?)(_=\d+)?/, '$1')
			+'_='+(new Date()).getTime());
		e.stopImmediatePropagation();
		return false;
	});
}
reload();
// добавляем наблюдателя
transition.attach({update:reload});
});
</script>