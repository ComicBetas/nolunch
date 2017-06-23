<?php

function getAttributeOptionHTML($v)
{
    if ($v == 'TEMPLATE') {
        $akSelectValueID = 'TEMPLATE_CLEAN';
        $akSelectValue = 'TEMPLATE';
    } else {
        if ($v->getSelectAttributeOptionID() != false) {
            $akSelectValueID = $v->getSelectAttributeOptionID();
        } else {
            $akSelectValueID = uniqid();
        }
        $akSelectValue = $v->getSelectAttributeOptionValue();
    }
    ?>
		<div id="akSelectValueDisplay_<?php echo $akSelectValueID?>" >
			<div class="rightCol">
				<input class="btn btn-primary" type="button" onClick="ccmAttributesHelper.editValue('<?php echo addslashes($akSelectValueID)?>')" value="<?php echo t('Edit')?>" />
				<input class="btn btn-danger" type="button" onClick="ccmAttributesHelper.deleteValue('<?php echo addslashes($akSelectValueID)?>')" value="<?php echo t('Delete')?>" />
			</div>			
			<span onClick="ccmAttributesHelper.editValue('<?php echo addslashes($akSelectValueID)?>')" id="akSelectValueStatic_<?php echo $akSelectValueID?>" class="leftCol"><?php echo $akSelectValue ?></span>
		</div>
		<div id="akSelectValueEdit_<?php echo $akSelectValueID?>" style="display:none">
			<span class="leftCol">
				<input name="akSelectValueOriginal_<?php echo $akSelectValueID?>" type="hidden" value="<?php echo $akSelectValue?>" />
				<?php if (is_object($v) && $v->getSelectAttributeOptionID()) {
    ?>
					<input id="akSelectValueExistingOption_<?php echo $akSelectValueID?>" name="akSelectValueExistingOption_<?php echo $akSelectValueID?>" type="hidden" value="<?php echo $akSelectValueID?>" />
				<?php
} else {
    ?>
					<input id="akSelectValueNewOption_<?php echo $akSelectValueID?>" name="akSelectValueNewOption_<?php echo $akSelectValueID?>" type="hidden" value="<?php echo $akSelectValueID?>" />
				<?php
}
    ?>
				<input id="akSelectValueField_<?php echo $akSelectValueID?>" onkeypress="ccmAttributesHelper.keydownHandler(event);" class="akSelectValueField form-control" data-select-value-id="<?php echo $akSelectValueID;
    ?>" name="akSelectValue_<?php echo $akSelectValueID?>" type="text" value="<?php echo $akSelectValue?>" size="40" />
			</span>		
			<div class="rightCol">
				<input class="btn btn-default" type="button" onClick="ccmAttributesHelper.editValue('<?php echo addslashes($akSelectValueID)?>')" value="<?php echo t('Cancel')?>" />
				<input class="btn btn-success" type="button" onClick="ccmAttributesHelper.changeValue('<?php echo addslashes($akSelectValueID)?>')" value="<?php echo t('Save')?>" />
			</div>		
		</div>	
		<div class="ccm-spacer">&nbsp;</div>
<?php
} ?>

<fieldset class="ccm-attribute ccm-attribute-select">
<legend><?php echo t('Select Options')?></legend>

<div class="form-group">
    <label><?php echo t("Multiple Values")?></label>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('akSelectAllowMultipleValues', 1, $akSelectAllowMultipleValues)?> <span><?php echo t('Allow multiple options to be chosen.')?></span>
        </label>
    </div>
</div>

<div class="form-group">
    <label><?php echo t("User Submissions")?></label>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('akSelectAllowOtherValues', 1, $akSelectAllowOtherValues)?> <span><?php echo t('Allow users to add to this list.')?></span>
        </label>
    </div>
</div>

<div class="form-group">
<label for="akSelectOptionDisplayOrder"><?php echo t("Option Order")?></label>
	<?php
    $displayOrderOptions = array(
        'display_asc' => t('Display Order'),
        'alpha_asc' => t('Alphabetical'),
        'popularity_desc' => t('Most Popular First'),
    );
    ?>

	<?php echo $form->select('akSelectOptionDisplayOrder', $displayOrderOptions, $akSelectOptionDisplayOrder)?>
</div>

<div class="clearfix">
<label><?php echo t('Values')?></label>
<div class="input">
	<div id="attributeValuesInterface">
	<div id="attributeValuesWrap">
	<?php
    Loader::helper('text');
    foreach ($akSelectValues as $v) {
        if ($v->getSelectAttributeOptionID() != false) {
            $akSelectValueID = $v->getSelectAttributeOptionID();
        } else {
            $akSelectValueID = uniqid();
        }
        ?>
		<div id="akSelectValueWrap_<?php echo $akSelectValueID?>" class="akSelectValueWrap akSelectValueWrapSortable">
			<?php echo getAttributeOptionHTML($v)?>
		</div>
	<?php
    } ?>
	</div>
	
	<div id="akSelectValueWrapTemplate" class="akSelectValueWrap" style="display:none">
		<?php echo getAttributeOptionHTML('TEMPLATE') ?>
	</div>
	
	<div id="addAttributeValueWrap" class="form-inline">
		<input id="akSelectValueFieldNew" name="akSelectValueNew" type="text" value="<?php echo $defaultNewOptionNm ?>" size="40"  class="form-control"
		onfocus="ccmAttributesHelper.clrInitTxt(this,'<?php echo $defaultNewOptionNm ?>','faint',0)" 
		onblur="ccmAttributesHelper.clrInitTxt(this,'<?php echo $defaultNewOptionNm ?>','faint',1)"
		onkeypress="ccmAttributesHelper.keydownHandler(event);"
		 /> 
		<input class="btn btn-primary" type="button" onClick="ccmAttributesHelper.saveNewOption(); $('#ccm-attribute-key-form').unbind()" value="<?php echo t('Add') ?>" />
	</div>
	</div>

</div>
</div>


</fieldset>
<script type="text/javascript">

	var ccmAttributesHelper={
		valuesBoxDisabled:function(typeSelect){
			var attrValsInterface=document.getElementById('attributeValuesInterface')
			var requiredVals=document.getElementById('reqValues');
			var allowOther=document.getElementById('allowOtherValuesWrap');
			var offMsg=document.getElementById('attributeValuesOffMsg');
			if (typeSelect.value == 'SELECT' || typeSelect.value == 'SELECT_MULTIPLE') {
				attrValsInterface.style.display='block';
				requiredVals.style.display='inline';
				if(allowOther) allowOther.style.display='block';
				offMsg.style.display='none';
			} else {
				requiredVals.style.display='none';
				attrValsInterface.style.display='none';
				if(allowOther) allowOther.style.display='none';
				offMsg.style.display='block';
			}
		},

		deleteValue:function(val){
			if(confirm(ccmi18n.deleteAttributeValue)) {
				$('#akSelectValueWrap_'+val).remove();
			}
		},

		editValue:function(val){
			if($('#akSelectValueDisplay_'+val).css('display')!='none'){
				$('#akSelectValueDisplay_'+val).css('display','none');
				$('#akSelectValueEdit_'+val).css('display','block').find('input[type="text"]').focus();
			}else{
				$('#akSelectValueDisplay_'+val).css('display','block');
				$('#akSelectValueEdit_'+val).css('display','none');
				var txtValue =  $('#akSelectValueStatic_'+val).html();
				$('#akSelectValueField_'+val).val( $('<div/>').html(txtValue).text());
			}
		},

		changeValue:function(val){
			var txtValue = $('<div/>').text($('#akSelectValueField_'+val).val()).html();
			$('#akSelectValueStatic_'+val).html( txtValue );
			this.editValue(val)
		},

		makeSortable: function() {
			$("div#attributeValuesWrap").sortable({
				cursor: 'move',
				opacity: 0.5
			});
		},

		saveNewOption:function(){
			var newValF=$('#akSelectValueFieldNew');
			var val = $('<div/>').text(newValF.val()).html();
			if(val=='') {
				return;
			}
			var ts = 't' + new Date().getTime();
			var template=document.getElementById('akSelectValueWrapTemplate');
			var newRowEl=document.createElement('div');
			newRowEl.innerHTML=template.innerHTML.replace(/template_clean/ig,ts).replace(/template/ig,val);
			newRowEl.id="akSelectValueWrap_"+ts;
			newRowEl.className='akSelectValueWrap akSelectValueWrapSortable';
			$('#attributeValuesWrap').append(newRowEl);
			newValF.val('');
		},

		clrInitTxt:function(field,initText,removeClass,blurred){
			if(blurred && field.value==''){
				field.value=initText;
				$(field).addClass(removeClass);
				return;
			}
			if(field.value==initText) field.value='';
			if($(field).hasClass(removeClass)) $(field).removeClass(removeClass);
		},

		keydownHandler:function(event){
			var form = $("#ccm-attribute-key-form");
			switch (event.keyCode) {
				case 13: // enter
					event.preventDefault();
					if (event.currentTarget.id === 'akSelectValueFieldNew') { // if the event originates from the "add" input field, create the option
						ccmAttributesHelper.saveNewOption();
					} else { // otherwise just fire the existing option save
						ccmAttributesHelper.changeValue(event.currentTarget.getAttribute('data-select-value-id'));
					}
					break;
				case 38: // arrow up
				case 40: // arrow down
					ccmAttributesHelper.changeValue(event.currentTarget.getAttribute('data-select-value-id'));
					var find = (event.keyCode === 38) ? 'prev' : 'next';
					var $target = $(event.currentTarget).closest('.akSelectValueWrap')[find]();
					if ($target.length) {
						$target.find('.leftCol').click();
					} else if (find === 'next') {
						$('#akSelectValueFieldNew').focus();
					}
					break;
			}
		},

		// legacy stub method
		addEnterClick:function(){
			ccmAttributesHelper.keydownHandler.apply(this, arguments);
		}

	}

	$(function() {
		ccmAttributesHelper.makeSortable();
	});

</script>
