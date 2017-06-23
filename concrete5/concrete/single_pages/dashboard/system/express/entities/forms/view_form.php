<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-dashboard-header-buttons btn-group">
    <a href="<?php echo URL::to('/dashboard/system/express/entities/forms', $entity->getID())?>" class="btn btn-default"><?php echo t("Back to Object")?></a>
    <a href="<?php echo URL::to('/dashboard/system/express/entities/forms', 'edit', $expressForm->getID())?>" class="btn btn-default"><?php echo t("Edit Details")?></a>
    <button type="button" class="btn btn-default" data-dialog="add-set"><?php echo t('Add Field Set') ?></button>
    <button type="button" class="btn btn-danger" data-dialog="delete-form"><?php echo t('Delete Form') ?></button>
</div>

<div style="display: none">
    <div id="ccm-dialog-delete-form" class="ccm-ui">
        <form method="post" action="<?php echo $view->action('delete_form', $entity->getID())?>">
            <?php echo Core::make("token")->output('delete_form')?>
            <input type="hidden" name="form_id" value="<?php echo $expressForm->getID()?>">
            <p><?php echo t('Are you sure you want to delete this form? This cannot be undone.')?></p>
            <div class="dialog-buttons">
                <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                <button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-delete-form form').submit()"><?php echo t('Delete Form')?></button>
            </div>
        </form>
    </div>

    <div id="ccm-dialog-add-set" class="ccm-ui">
        <form method="post" action="<?php echo $view->action('add_set', $expressForm->getID())?>">
            <?php echo Loader::helper('validation/token')->output('add_set')?>
            <div class="form-group">
                <?php echo $form->label('name', tc('Name of a set', 'Set Name'))?>
                <?php echo $form->text('name')?>
            </div>
        </form>
        <div class="dialog-buttons">
            <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
            <button class="btn btn-primary pull-right" onclick="$('#ccm-dialog-add-set form').submit()"><?php echo t('Add Set')?></button>
        </div>
    </div>

</div>

<p class="lead"><?php echo $expressForm->getName(); ?></p>

<?php if (count($fieldSets)) {
    ?>

    <?php foreach ($fieldSets as $set) {
    ?>

        <div style="display: none">
            <div id="ccm-dialog-delete-set-<?php echo $set->getID()?>" class="ccm-ui">
                <form method="post" action="<?php echo $view->action('delete_set', $expressForm->getID())?>">
                    <?php echo Core::make("token")->output('delete_set')?>
                    <input type="hidden" name="field_set_id" value="<?php echo $set->getID()?>">
                    <p><?php echo t('Are you sure you want to delete this field set? This cannot be undone.')?></p>
                    <div class="dialog-buttons">
                        <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                        <button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-delete-set-<?php echo $set->getId()?> form').submit()"><?php echo t('Delete Set')?></button>
                    </div>
                </form>
            </div>

            <div id="ccm-dialog-update-set-<?php echo $set->getID()?>" class="ccm-ui">
                <form method="post" action="<?php echo $view->action('update_set', $expressForm->getID())?>">
                    <?php echo Core::make("token")->output('update_set')?>
                    <input type="hidden" name="field_set_id" value="<?php echo $set->getID()?>">
                    <div class="form-group">
                        <?php echo $form->label('name', tc('Name of a set', 'Set Name'))?>
                        <?php echo $form->text('name', $set->getTitle())?>
                    </div>
                </form>
                <div class="dialog-buttons">
                    <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                    <button class="btn btn-primary pull-right" onclick="$('#ccm-dialog-update-set-<?php echo $set->getID()?> form').submit()"><?php echo t('Update Set')?></button>
                </div>
            </div>

        </div>


        <div class="ccm-item-set panel panel-default" data-field-set="<?php echo $set->getID()?>">
            <div class="panel-heading">
                <ul class="ccm-item-set-controls">
                    <li><a href="<?php echo $view->action('add_control', $set->getID())?>" class="dialog-launch" dialog-title="<?php echo t('Add Form Control')?>" dialog-width="640" dialog-height="400" data-command="add-form-set-control"><i class="fa fa-plus"></i></a></li>
                    <li><a href="#" data-command="move-set" style="cursor: move"><i class="fa fa-arrows"></i></a></li>
                    <li><a href="#" data-dialog="update-set-<?php echo $set->getId()?>" data-dialog-title="<?php echo t('Update Set')?>"><i class="fa fa-pencil"></i></a></li>
                    <li><a href="#" data-dialog="delete-set-<?php echo $set->getId()?>" data-dialog-title="<?php echo t('Delete Set')?>"><i class="fa fa-trash-o"></i></a></li>
                </ul>

                <div><?php echo $set->getTitle() ? $set->getTitle() : t('(No Title)')?></div>

            </div>

            <table class="table table-hover" style="width: 100%;">
                <tbody>

                <?php

                foreach ($set->getControls() as $control) {
                    $element = new \Concrete\Controller\Element\Dashboard\Express\Control($control);
                    echo $element->render();
                }

    ?>

                </tbody>
            </table>

        </div>

    <?php 
}
    ?>

<?php

} else {
    ?>
    <p><?php echo t('You have not created any field sets.')?></p>
<?php

} ?>


<script type="text/javascript">
    $(function() {
        $('[data-dialog]').on('click', function() {
            var $element = $('#ccm-dialog-' + $(this).attr('data-dialog'));
            if ($(this).attr('data-dialog-title')) {
                var title = $(this).attr('data-dialog-title');
            } else {
                var title = $(this).text();
            }
            jQuery.fn.dialog.open({
                element: $element,
                modal: true,
                width: 320,
                title: title,
                height: 'auto'
            });
        });

        $('#ccm-dashboard-content').sortable({
            handle: 'a[data-command=move-set]',
            items: '.ccm-item-set',
            cursor: 'move',
            axis: 'y',
            stop: function() {
                var formData = [{
                    'name': 'token',
                    'value': '<?php echo Core::make("token")->generate("update_set_display_order")?>'
                }];
                $('.ccm-item-set').each(function() {
                    formData.push({'name': 'set[]', 'value': $(this).attr('data-field-set')});
                });
                $.ajax({
                    type: 'post',
                    data: formData,
                    url: '<?php echo $view->action("update_set_display_order", $expressForm->getID())?>',
                    success: function() {

                    }
                });
            }
        });


        $('div.ccm-item-set').sortable({
            handle: 'a[data-command=move-control]',
            items: '.ccm-item-set-item',
            cursor: 'move',
            axis: 'y',
            helper: function(e, ui) { // prevent table columns from collapsing
                ui.addClass('active');
                ui.children().each(function () {
                    $(this).width($(this).width());
                });
                return ui;
            },
            stop: function(e, ui) {
                var $set = $(ui.item).closest('div[data-field-set]');
                var formData = [{
                    'name': 'token',
                    'value': '<?php echo Loader::helper("validation/token")->generate("update_set_control_display_order")?>'
                }, {
                    'name': 'set',
                    'value': $set.attr('data-field-set')
                }];

                $set.find('.ccm-item-set-item').each(function() {
                    formData.push({'name': 'control[]', 'value': $(this).attr('data-field-set-control')});
                });


                $.ajax({
                    type: 'post',
                    data: formData,
                    url: '<?php echo $view->action("update_set_control_display_order", $expressForm->getID())?>',
                    success: function() {}
                });

            }
        });



    });
</script>

