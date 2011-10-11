<?php
error_reporting (E_ALL);

include('KCAPTCHA.php');

session_start();

$captcha = new KCAPTCHA();

if($_REQUEST[session_name()]){
	$_SESSION['kcaptcha_keystring'] = $captcha->getKeyString();
}
