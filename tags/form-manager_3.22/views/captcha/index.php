<?php
error_reporting(E_ALL);

/* Using:

	<?php
	session_start();
	?>
	<form action="" method="post">
	<p>Enter text shown below:</p>
	<p><img src="PATH-TO-THIS-SCRIPT"></p>
	<p><input type="text" name="keystring"></p>
	<p><input type="submit" value="Check"></p>
	</form>
	<?php
	if(count($_POST)>0){
		if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring']){
			echo "Correct";
		}else{
			echo "Wrong";
		}
	}
	unset($_SESSION['captcha_keystring']);
	?>

*/

require_once dirname(__FILE__).'/Captcha.php';

session_start();

$captcha = new Captcha();

try {
	if (isset($_GET['w'])) $captcha->setWidth($_GET['w']);
	if (isset($_GET['h'])) $captcha->setHeight($_GET['h']);
	if (isset($_GET['l'])) $captcha->setLength($_GET['l']);
} catch (Exception $e){}

$captcha->getImage();

$_SESSION['captcha_keystring'] = $captcha->getKeyString();
?>