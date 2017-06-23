<fieldset class="ccm-attribute ccm-attribute-date-time">
<legend><?php echo t('Date/Time Options')?></legend>

<div class="form-group">
<?php echo $form->label('akDateDisplayMode', t('Ask User For'))?>
<?php
    $akDateDisplayModeOptions = array(
        'date_time' => t('Both Date and Time'),
        'date' => t('Date Only'),
        'text' => t('Text Input Field'),

    );
    ?>
<?php echo $form->select('akDateDisplayMode', $akDateDisplayModeOptions, $akDateDisplayMode)?>
</div>

</fieldset>
