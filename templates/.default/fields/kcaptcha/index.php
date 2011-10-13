<?php
/**
 * @package		KCAPTCHA
 * @author		Kruglov Sergei
 * @version		2.0
 * @link		www.captcha.ru
 * @link		www.kruglov.ru
 * @copyright	Kruglov Sergei, 2006, 2007, 2008, 2011
 */

error_reporting (E_ALL);

include('KCAPTCHA.php');

session_start();

$captcha = new KCAPTCHA();

if($_REQUEST[session_name()]){
	$_SESSION['kcaptcha_keystring'] = $captcha->getKeyString();
}
