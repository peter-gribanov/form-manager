<?
/**
 * FormManager package
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision$
 * @since     $Date$
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */
?><?if($this->getName()):?><div id="form-<?=$this->getName()?>">
<?endif?>
<form action="<?=$this->getAction()?>" method="<?=$this->getMethod()?>"<?=
($this->getName() ? ' name="'.$this->getName().'"' : '')?> enctype="multipart/form-data">
<?$this->getCollection()->draw()?>
<div class="form-buttons">
<?$this->drawButtons()?>
<button type="submit"><?if($this->getSubmitTitle()):?><?=$this->getSubmitTitle()?><?else:?><?=$this->getLangPost('default_submit_title')?><?endif?></button>
</div>
</form>
<?if($this->isRequired()):?>
<div class="form-field-required-comment">
	<span class="form-field-required">*</span> - <?=$this->getLangPost('required_fields')?>
</div>
<?endif?>
<?if($this->getName()):?></div><?endif?>