<?php
    defined('C5_EXECUTE') or die("Access Denied.");
    $bObj = $controller;
    $al = Loader::helper('concrete/asset_library');
    $bf = null;
    if ($controller->getWebmFileID() > 0) {
        $webm = $controller->getWebMFileObject();
    }
    if ($controller->getOggFileID() > 0) {
        $ogg = $controller->getOggFileObject();
    }
    if ($controller->getMp4FileID() > 0) {
        $mp4 = $controller->getMp4FileObject();
    }

    if ($controller->getPosterFileID() > 0) {
        $poster = $controller->getPosterFileObject();
    }
?>

<fieldset>
    <legend><?php echo t('Video Files')?></legend>

        <div class="form-group">
            <label class="control-label"><?php echo t('Video Placeholder Image'); ?></label>
            <?php echo $al->image('ccm-b-poster-file', 'posterfID', t('Choose Video Placeholder Image (Optional)'), $poster);?>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo t('WebM')?></label>
            <?php echo $al->video('ccm-b-webm-file', 'webmfID', t('Choose WebM Video File'), $webm);?>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo t('OGG')?></label>
            <?php echo $al->video('ccm-b-ogg-file', 'oggfID', t('Choose Video File'), $ogg);?>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo t('MP4')?></label>
            <?php echo $al->video('ccm-b-mp4-file', 'mp4fID', t('Choose Video File'), $mp4);?>
        </div>
</fieldset>
<?php $this->inc('form_setup_html.php'); ?> 