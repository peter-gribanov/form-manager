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
?><? include FormElement::getTemplatePath('captcha-image')?>
<br />
<div class="comment"><?=sprintf($this->getLangPost('captcha-length'), $params['length'])?><br />
<?=sprintf($this->getLangPost('captcha-link'), '<a href="" class="form-captcha-button">', '</a>')?></div>
<? include FormElement::getTemplatePath('captcha-field')?>