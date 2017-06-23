<?php defined('C5_EXECUTE') or die("Access Denied.");
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>
<div class="ccm-ui">

<?php if ($total == 0) { ?>

    <?php echo t("There are no pages of this type added to your website.")?>

<?php } else { ?>

    <form method="post" id="ccmBlockMasterCollectionForm" data-dialog-form-processing="progressive" data-dialog-form="master-collection-alias" action="<?php echo $controller->action('submit')?>">

    <p><?php echo t('This block will be added to all pages of this type. If it has been previously added it will be updated – even if the block on the child page has been forked from this block.')?></p>

    <div class="form-group">
        <label class="control-label"><?php echo t('If this block does not appear on a page of this type')?></label>
        <div class="radio"><label><input type="radio" name="addBlock" value="1" checked> <?php echo t('Add a new instance of the block to the page.')?></label></div>
        <div class="radio"><label><input type="radio" name="addBlock" value="0"> <?php echo t('Keep this block off that page.')?></label></div>
    </div>

        <div data-dialog-form-element="progress-bar"></div>


    <div class="dialog-buttons">
        <button class="btn btn-default pull-left" data-dialog-action="cancel"><?php echo t('Cancel')?></button>
        <button class="btn btn-primary pull-right" data-dialog-action="submit"><?php echo t('Save')?></button>
    </div>

    </form>

<?php } ?>

</div>