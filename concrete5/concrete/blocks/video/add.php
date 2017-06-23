<?php
defined('C5_EXECUTE') or die("Access Denied.");

$bObj = $controller;
$includeAssetLibrary = true;
$al = Loader::helper('concrete/asset_library');
?>

<fieldset>
    <legend><?php echo t('Video Files')?></legend>
    <div class="form-group">
        <label class="control-label"><?php echo t('Video Placeholder Image'); ?></label>
        <?php echo $al->image('ccm-b-poster-file', 'posterfID', t('Choose Video Placeholder Image (Optional)'));?>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo t('WebM')?></label>
        <?php echo $al->video('ccm-b-webm-file', 'webmfID', t('Choose Video File'));?>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo t('OGG')?></label>
        <?php echo $al->video('ccm-b-ogg-file', 'oggfID', t('Choose Video File'));?>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo t('MP4')?></label>
        <?php echo $al->video('ccm-b-mp4-file', 'mp4fID', t('Choose Video File'));?>
    </div>
</fieldset>
<?php $this->inc('form_setup_html.php'); ?> 
