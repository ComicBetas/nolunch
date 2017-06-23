<?php
defined('C5_EXECUTE') or die("Access Denied.");
$al = Loader::helper('concrete/asset_library');
?>
<div class="form-group">
	<?php echo $form->label('fID', t('File'))?>
	<?php echo $al->file('ccm-b-file', 'fID', t('Choose File'));?>
</div>
<div class="form-group">
	<?php echo $form->label('fileLinkText', t('Link Text'))?>
	<?php echo $form->text('fileLinkText')?>
</div>
<div class="form-group">
	<div class="checkbox">
		<label>
			<?php echo $form->checkbox('forceDownload', '1'); ?>
			<?php echo t('Force file to download')?>
		</label>
	</div>
</div>
