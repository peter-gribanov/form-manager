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
?><div<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?>>
	<label for="<?=$params['id']?>-no"><?=$params['value_no']?></label>
	<input type="radio" name="<?=$this->getName()?>" value="0" id="<?=$params['id']?>-no"<?=
($params['class'] ? ' class="'.$params['class'].'-no"' : '')?><?=
(!$this->getValue() ? ' checked="checked"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')
?> />
	<input type="radio" name="<?=$this->getName()?>" value="1" id="<?=$params['id']?>-yes"<?=
($params['disabled'] ? ' disabled="disabled"' : '')?><?=
($params['class'] ? ' class="'.$params['class'].'-yes"' : '')?><?=
($this->getValue() ? ' checked="checked"' : '')
?> />
	<label for="<?=$params['id']?>-yes"><?=$params['value_yes']?></label>
</div>