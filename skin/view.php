<form action="<?=$this->getAction()?>" method="<?=$this->getMethod()?>"<?=
($this->getName() ? ' name="'.$this->getName().'"' : '')?>>
<? $this->getCollection()->draw()?>
<!--<button type="reset"><?=$this->getLangPost('default_reset_title')?></button>-->
<button type="submit"><? if($this->getSubmitTitle()):?><?=$this->getSubmitTitle()?><? else:?><?=$this->getLangPost('default_submit_title')?><? endif?></button>
</form>
<? if($this->isRequired()):?>
<div class="field-required-comment"><span class="field-required">*</span> - <?=$this->getLangPost('required_fields')?></div>
<? endif?>