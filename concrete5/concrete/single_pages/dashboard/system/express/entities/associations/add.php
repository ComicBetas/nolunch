<?php defined('C5_EXECUTE') or die("Access Denied.");?>
<form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('add', $entity->getID())?>">
    <?php echo $token->output('add_association')?>

    <fieldset>
        <div class="form-group">
            <label class="control-label" for="name"><?php echo t('Source Object')?></label>
            <p><?php echo $entity->getName()?></p>
        </div>
        <div class="form-group">
            <label class="control-label" for="name"><?php echo t('Type')?></label>
            <?php echo $form->select('type', $types)?>
        </div>
        <div class="form-group">
            <label class="control-label" for="name"><?php echo t('Target Object')?></label>
            <select name="target_entity" class="form-control">
                <?php foreach($entities as $targetEntity) { ?>
                    <option value="<?php echo $targetEntity->getID()?>" data-plural="<?php echo $targetEntity->getPluralHandle()?>" data-singular="<?php echo $targetEntity->getHandle()?>"><?php echo $targetEntity->getName()?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label" for="name"><?php echo t('Target Property Name')?></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <?php echo $form->checkbox('overrideTarget', 1, false, ['data-toggle' => 'association-property'])?>
                </span>
                <input name="target_property_name" type="hidden" value="" />
                <?php echo $form->text('target_property_name', '', ['disabled' => 'disabled'])?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="name"><?php echo t('Inversed Property Name')?></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <?php echo $form->checkbox('overrideInverse', 1, false, ['data-toggle' => 'association-property'])?>
                </span>
                <input name="inversed_property_name" type="hidden" value="<?php echo $entity->getHandle()?>" />
                <?php echo $form->text('inversed_property_name', $entity->getHandle(), ['disabled' => 'disabled'])?>
            </div>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <a href="<?php echo URL::to('/dashboard/system/express/entities/associations', $entity->getId())?>"
               class="pull-left btn btn-default" type="button" ><?php echo t('Back to Associations')?></a>
            <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function() {
        $('input[data-toggle=association-property]').on('change', function() {
            var disabled;
            if ($(this).is(':checked')) {
                disabled = false;
            } else {
                disabled = true;
                $('select[name=target_entity]').trigger('change');
            }
            $(this).closest('.form-group').find('.form-control').prop('disabled', disabled);
        }).trigger('change');
        $('select[name=target_entity],select[name=type]').on('change', function() {
            if ($('select[name=type]').val() == 'OneToMany' || $('select[name=type]').val() == 'ManyToMany') {
                var value = $('select[name=target_entity]').find('option:selected').attr('data-plural');
            } else {
                var value = $('select[name=target_entity]').find('option:selected').attr('data-singular');
            }
            $('input[name=target_property_name]').val(value);

            if ($('select[name=type]').val() == 'ManyToMany' || $('select[name=type]').val() == 'ManyToOne') {
                var value = '<?php echo $entity->getPluralHandle()?>';
            } else {
                var value = '<?php echo $entity->getHandle()?>';
            }
            $('input[name=inversed_property_name]').val(value);

        }).trigger('change');
    });
</script>