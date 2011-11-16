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
?><select name="<?=$this->getName().($params['multiple'] ? '[]' : '')?>"<?=
($params['class'] ? ' class="'.$params['class'].'"' : '')?><?=
($params['id'] ? ' id="'.$params['id'].'"' : '')?><?=
($params['size']>1 ? ' size="'.$params['size'].'"' : '')?><?=
($params['multiple'] ? ' multiple="multiple"' : '')?><?=
($params['disabled'] ? ' disabled="disabled"' : '')?>>
<? foreach($params['options'] as $value=>$label):?>
<?php
$value = $params['use_key'] ? $value : $label;
?><option value="<?=$value?>" label="<?=$label?>"<?=
(($params['multiple'] && $this->getValue() && in_array($value, $this->getValue()))
	|| (string)$value==$this->getValue() ? ' selected="selected"' : '')?>><?=$label?></option>
<? endforeach?>
</select>