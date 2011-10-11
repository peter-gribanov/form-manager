<?php
if (empty($_SESSION['kcaptcha_keystring']) || $_SESSION['kcaptcha_keystring'] != $this->getValue()){
	$this->error('kcaptcha');
}
