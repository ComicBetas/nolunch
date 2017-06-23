<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="form-group">
    <label class="control-label"><?php echo $label?></label>
    <?php
    if (!empty($entities)) {
        foreach ($entities as $entity) {
            ?>
            <div class="checkbox">
                <label>
                    <input
                        type="checkbox"
                        <?php
                        if (isset($selectedEntities)) {
                            foreach($selectedEntities as $selectedEntity) {
                                if ($selectedEntity->getID() == $entity->getID()) {
                                    print 'checked';
                                }
                            }
                        }
                        ?>
                        name="express_association_<?php echo $control->getId()?>[]"
                        value="<?php echo $entity->getId()?>"
                    >
                    <?php echo $formatter->getEntryDisplayName($control, $entity)?>
                </label>
            </div>
            <?php
        }
    } else {
        ?><p><?php echo t('No entity found.')?></p><?php
    }
    ?>
</div>
