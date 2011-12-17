<?
/**
 * FormManager package
 * 
 * @todo Исправить линк на корректную картинку
 * 
 * @package   FormManager
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @version   4.0 SVN: $Revision: 90 $
 * @since     $Date: 2011-11-19 16:53:29 +0300 (Sat, 19 Nov 2011) $
 * @link      http://peter-gribanov.ru/open-source/form-manager/4.0/
 * @copyright 2008 by Peter Gribanov
 * @license   http://peter-gribanov.ru/license	GNU GPL Version 3
 */
?><div class="b-formmanager-kcaptcha">
<img src="<?=FORM_MANAGER_HTTP_PATH?>templates/.default/fields/kcaptcha/image.php?_=<?=time()?>" class="b-formmanager-kcaptcha-image" alt="" />
<br />
<div class="g-formmanager-comment"><?=FormManager_Language::getMessage('kcaptcha-length', array($params['length']))?><br />
<?=FormManager_Language::getMessage('kcaptcha-link', array('<a href="" class="b-formmanager-kcaptcha-button">', '</a>'))?></div>
<input type="password" name="<?=$this->getName()?>" value="<?=$this->getValue()?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?> />
</div>