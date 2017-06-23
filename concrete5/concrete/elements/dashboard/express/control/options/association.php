<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="form-group">
    <?php echo $form->label('label_mask', t('Association Entity Display Format'))?>
    <?php echo $form->text('label_mask', $control->getAssociationEntityLabelMask())?>
</div>

<div class="alert alert-info"><?php echo t('Example: %first_name% %last_name%')?></div>