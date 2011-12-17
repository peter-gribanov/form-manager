<?php
/**
 * KCAPTCHA configuration file
 * 
 * @package		KCAPTCHA
 * @author		Kruglov Sergei
 * @version		2.0
 * @link		www.captcha.ru
 * @link		www.kruglov.ru
 * @copyright	Kruglov Sergei, 2006, 2007, 2008, 2011
 */

// do not change without changing font files!
$alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";

// symbols used to draw CAPTCHA
//$allowed_symbols = "0123456789"; #digits
//$allowed_symbols = "23456789abcdegkmnpqsuvxyz"; #alphabet without similar symbols (o=0, 1=l, i=j, t=f)
$allowed_symbols = "23456789abcdegikpqsvxyz"; #alphabet without similar symbols (o=0, 1=l, i=j, t=f)

// folder with fonts
$fontsdir = 'fonts';	

// CAPTCHA string length
//$length = mt_rand(5,7); // random 5 or 6 or 7
// CAPTCHA string length not be a random in package FormManager
$length = FormManager_Model_Field_Kcaptcha::STRING_LENGTH;

// CAPTCHA image size (you do not need to change it, this parameters is optimal)
$width = 250;
$height = 60;

// symbol's vertical fluctuation amplitude
$fluctuation_amplitude = 15;

//noise
//$white_noise_density=0; // no white noise
$white_noise_density=1/6;
//$black_noise_density=0; // no black noise
$black_noise_density=1/30;

// increase safety by prevention of spaces between symbols
$no_spaces = true;

// show credits
// set to false to remove credits line. Credits adds 12 pixels to image height
$show_credits = false;
// if empty, HTTP_HOST will be shown
$credits = 'www.captcha.ru';

// CAPTCHA image colors (RGB, 0-255)
$foreground_color = array(0, 0, 50);
$background_color = array(255, 255, 255);
//$foreground_color = array(mt_rand(0,80), mt_rand(0,80), mt_rand(0,80));
//$background_color = array(mt_rand(220,255), mt_rand(220,255), mt_rand(220,255));

// JPEG quality of CAPTCHA image (bigger is better quality, but larger file size)
$jpeg_quality = 90;
