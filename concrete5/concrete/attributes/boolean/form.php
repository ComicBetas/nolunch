<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="checkbox">
    <label>
        <input
            type="checkbox"
            value="1"
            name="<?php echo $view->field('value')?>"
            <?php if ($checked) { ?> checked <?php } ?>
        >
        <?php /* ?>
        <?=$controller->getAttributeKey()->getAttributeKeyDisplayName()?>
 */ ?>
        <?php echo t('Yes')?>
    </label>
</div>