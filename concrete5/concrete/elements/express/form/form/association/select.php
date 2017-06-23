<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="form-group">
    <label class="control-label"><?php echo $label?></label>
    <?php
    if (!empty($entities)) {
        $selectedEntity = $selectedEntities[0];
        ?>
        <select class="form-control" name="express_association_<?php echo $control->getId()?>">
            <option value=""><?php echo t('** Choose %s', $control->getControlLabel())?></option>
            <?php
            foreach ($entities as $entity) {
                ?>
                <option
                    value="<?php echo $entity->getId()?>"
                    <?php if (is_object($selectedEntity) && $selectedEntity->getID() == $entity->getID()) { ?>selected<?php } ?>
                >
                    <?php echo $formatter->getEntryDisplayName($control, $entity)?>
                </option>
                <?php
            }
            ?>
        </select>
    <?php
    } else {
        ?><p><?php echo t('No entity found.')?></p><?php
    } ?>
</div>
