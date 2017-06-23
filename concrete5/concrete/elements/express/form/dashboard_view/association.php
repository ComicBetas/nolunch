<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="form-group">
    <div>
    <label class="control-label"><?php echo $label?></label>
    </div>
    <?php
    if (count($entities)) {
        ?>
        <?php foreach ($entities as $entity) {
    ?>
            <div><a href="<?php echo URL::to('/dashboard/express/entries', 'view_entry', $entity->getID())?>"><?php echo $formatter->getEntryDisplayName($control, $entity)?></a></div>
        <?php 
}
        ?>
    <?php 
    } ?>
</div>