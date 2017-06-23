<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php

if (is_object($renderer)) {
    ?>

    <form method="post" action="<?php echo $view->action('submit', $entity->getId())?>">
        <input type="hidden" name="entry_id" value="<?php echo $entry->getID()?>">
    <?php
        echo $renderer->render($entry);
    ?>

        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <?php if ($backURL) { ?>
                    <a class="pull-left btn btn-default" href="<?php echo $backURL?>"><?php echo t('Back')?></a>
                <?php } ?>
                <button class="pull-right btn btn-primary" type="submit"><?php echo t('Save %s', $entity->getName())?></button>
            </div>
        </div>


<?php

} else {
    ?>
    <p><?php echo t('You have not created any forms for this data type.')?></p>
<?php 
} ?>
