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
?>  <tr<?if(!empty($params['class'])):?> class="form-<?=$params['class']?>-field"<?endif?>>
    <th class="form-field-title"><?=$this->getTitle()?><?if($this->isRequired()):?><span class="form-field-required">*</span><?endif?>:<?if($this->getComment()):?><div class="form-field-comment">(<?=$this->getComment()?>)</div><?endif?></th>
    <td class="form-field-input"><?$this->drawField()?></td>
  </tr>
