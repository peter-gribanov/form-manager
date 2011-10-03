  <tr<? if($this->getViewParams('class')):?> class="<?=$this->getViewParams('class')?>-field"<? endif?>>
    <th class="field-title"><?=$this->getTitle()?><? if($this->isRequired()):?><span class="field-required">*</span><? endif?>:<? if($this->getComment()):?><div class="field-comment">(<?=$this->getComment()?>)</div><? endif?></th>
    <td class="field-input"><? $this->drawField()?></td>
  </tr>
