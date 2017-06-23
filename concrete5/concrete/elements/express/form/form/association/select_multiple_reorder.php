<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="form-group">
    <label class="control-label"><?php echo $label?></label>
    <?php
    if (!empty($selectedEntities) && count($selectedEntities)) { ?>
        <ul class="item-select-list" data-sortable-list="items">
            <?php foreach($selectedEntities as $entry) { ?>
                <li>
                    <input type="hidden" name="express_association_<?php echo $control->getID()?>[]" value="<?php echo $entry->getID()?>">
                    <?php echo $formatter->getEntryDisplayName($control, $entry)?>
                    <i class="ccm-item-select-list-sort"></i>

                </li>
            <?php } ?>
        </ul>
        <?php
    }
    ?>
</div>

<script type="text/javascript">
    $(function() {
        $('ul[data-sortable-list=items]').sortable();
    });
</script>