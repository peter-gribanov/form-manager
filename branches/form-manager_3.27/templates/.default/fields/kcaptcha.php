<?
$params = $this->getViewParams();
include 'kcaptcha-image.php';
?>
<br />
<div class="comment"><?=sprintf($this->getLangPost('kcaptcha-length'), $params['length'])?><br />
<?=sprintf($this->getLangPost('kcaptcha-link'), '<a href="" class="form-kcaptcha-button">', '</a>')?></div>
<? include 'kcaptcha-field.php'?>