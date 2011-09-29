<? include FormElement::getTemplatePath('captcha-image')?>
<br />
<div class="comment"><?=sprintf($this->getLangPost('captcha-length'), $params['length'])?><br />
<?=sprintf($this->getLangPost('captcha-link'), '<a href="" class="form-captcha-button">', '</a>')?></div>
<? include FormElement::getTemplatePath('captcha-field')?>