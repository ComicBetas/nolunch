<?php
    defined('C5_EXECUTE') or die("Access Denied.");
    $al = Loader::helper('concrete/asset_library');
    $bf = null;
    if ($controller->getFileID() > 0) {
        $bf = $controller->getFileObject();
    }
?>
<div class="form-group">
	<?php echo $form->label('fID', t('File'))?>
	<?php echo $al->file('ccm-b-file', 'fID', t('Choose File'), $bf);?>
</div>
<div class="form-group">
	<?php echo $form->label('fileLinkText', t('Link Text'))?>
	<?php echo $form->text('fileLinkText', $controller->getLinkText())?>
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('forceDownload', '1', $forceDownload); ?>
            <?php echo t('Force file to download')?>
        </label>
    </div>
</div>
