<?/**

	Одиночный чекбокс

	@param array $element "{'name':'string','valid':'boolean','changed':'boolean','fullname':'string','filters':['string'],'decorators':{'id':'string','template':'string','label':'string'},'errors':[{'tpl':'/test/form/_error.tpl','vars':{},'class':'string'}],'notice':[],'value':'muxed','default':'muxed','input':'mixed'}"
	@param string $skin "test"
        @see Cms_Form_Factory::ElementBoolean
*/?>
<?=self::inc("/{$skin}/form/_label.tpl", array('element'=>$element))?>
<?=self::inc("/{$skin}/form/_error.tpl", array('element'=>$element))?>
<?=self::inc("/{$skin}/form/_notice.tpl", array('element'=>$element))?>
<div class="f-row-control">
	<label class="f-label-checkbox<?if(count($element['errors'])>0):?> f-element-error<?endif;?>">
		<span class="f-checkbox-wrapper">
			<input
				type="checkbox"
				class="f-checkbox"
				name="<?=$element['fullname']?>"
				value="1"
				id="<?=@$element['decorators']['id']?>"
				<?if(@$element['input'] && !is_null($element['input'])):?>checked="checked"<?endif;?>
			/>
		</span>
	</label>
</div>
