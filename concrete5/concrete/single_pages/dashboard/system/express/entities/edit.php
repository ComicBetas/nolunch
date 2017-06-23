<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<div class="ccm-dashboard-header-buttons">

    <?php
    $manage = new \Concrete\Controller\Element\Dashboard\Express\Menu($entity);
    $manage->render();
    ?>

</div>


<div class="row">
    <?php View::element('dashboard/express/detail_navigation', array('entity' => $entity))?>
    <div class="col-md-8">

        <form method="post" action="<?php echo $view->action('update', $entity->getID())?>">
            <?php echo $token->output('update_entity')?>

            <fieldset>
                <legend><?php echo t("Basics")?></legend>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Name')?></label>
                    <div class="input-group">
                        <?php echo $form->text('name', $entity->getName())?>
                        <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Handle')?></label>
                    <div class="input-group">
                        <?php echo $form->text('handle', $entity->getHandle())?>
                        <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Plural Handle')?></label>
                    <div class="input-group">
                        <?php echo $form->text('plural_handle', $entity->getPluralHandle())?>
                        <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Description')?></label>
                    <?php echo $form->textarea('description', $entity->getDescription(), array('rows' => 5))?>
                </div>
            </fieldset>

            <fieldset>
                <legend><?php echo t('Advanced')?></legend>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Custom Display Order') ?></label>
                    <div class="checkbox"><label>
                            <?php echo $form->checkbox('supports_custom_display_order', 1, $entity->supportsCustomDisplayOrder()) ?>
                            <?php echo t('This entity supports custom display ordering via Dashboard interfaces.') ?>
                        </label></div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo t('Views')?></legend>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Default Edit Form')?></label>
                    <?php echo $form->select('default_edit_form_id', $forms, $defaultEditFormID)?>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Default View Form')?></label>
                    <?php echo $form->select('default_view_form_id', $forms, $defaultViewFormID)?>
                </div>

            </fieldset>
            <fieldset>
                <legend><?php echo t('Results Folder')?></legend>
                <input type="hidden" name="entity_results_node_id" value="<?php echo $folder->getTreeNodeID()?>">

                <div data-tree="<?php echo $tree->getTreeID()?>">
                </div>

                <script type="text/javascript">
                    $(function() {

                        $('[data-tree]').concreteTree({
                            treeID: '<?php echo $tree->getTreeID()?>',
                            ajaxData: {
                                displayOnly: 'express_entry_category'
                            },
                            <?php if (is_object($folder)) { ?>
                                selectNodesByKey: [<?php echo $folder->getTreeNodeID()?>],
                                onSelect : function(nodes) {
                                    if (nodes.length) {
                                        $('input[name=entity_results_node_id]').val(nodes[0]);
                                    } else {
                                        $('input[name=entity_results_node_id]').val('');
                                    }
                                },
                            <?php } ?>
                            'chooseNodeInForm': 'single'
                        });

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


                    });
                </script>

            </fieldset>
            <div class="ccm-dashboard-form-actions-wrapper">
                <div class="ccm-dashboard-form-actions">
                    <button type="button" data-dialog="delete-entity" class="pull-left btn btn-danger"><?php echo t('Delete')?></button>
                    <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
                </div>
            </div>
        </form>

    </div>
</div>

<div style="display: none">
    <div id="ccm-dialog-delete-entity" class="ccm-ui">
        <form method="post" action="<?php echo $view->action('delete')?>">
            <?php echo Core::make("token")->output('delete_entity')?>
            <input type="hidden" name="entity_id" value="<?php echo $entity->getID()?>">
            <p><?php echo t('Are you sure you want to delete this entity? All data entries and all its associations to other entities will be removed. This cannot be undone.')?></p>
            <div class="dialog-buttons">
                <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                <button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-delete-entity form').submit()"><?php echo t('Delete Entity')?></button>
            </div>
        </form>
    </div>

</div>
