<?
/**
 * FormManager package
 * 
 * @todo Исправить линк на корректную картинку
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision$
 * @since     $Date$
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */
?><div class="b-formmanager-kcaptcha">
<img src="<?=FORM_MANAGER_HTTP_PATH?>templates/.default/fields/kcaptcha/image.php?_=<?=time()?>" class="b-formmanager-kcaptcha-image" alt="" />
<br />
<div class="g-formmanager-comment"><?=sprintf($this->getLangPost('captcha-length'), $params['length'])?><br />
<?=sprintf($this->getLangPost('captcha-link'), '<a href="" class="b-formmanager-kcaptcha-button">', '</a>')?></div>
<input type="password" name="<?=$this->getName()?>" value="<?=$this->getValue()?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?> />
</div>