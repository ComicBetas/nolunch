<fieldset class="ccm-attribute ccm-attribute-date-time">
<legend><?php echo t('Express Options')?></legend>

<div class="form-group">
<?php echo $form->label('exEntityID', t('Entity'))?>
<?php echo $form->select('exEntityID', $entities, $entityID)?>
</div>

</fieldset>
