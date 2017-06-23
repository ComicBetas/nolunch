<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('add') ?>">
    <?php echo $token->output('add_entity') ?>

    <div class="form-group <?php if ($error->containsField('name')) { ?>has-error<?php } ?>">
        <label for="name" class="control-label"><?php echo t('Name') ?></label>
        <div class="input-group">
            <?php echo $form->text('name', '', ['autofocus' => 'autofocus']) ?>
            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
        </div>
        <p class="help-block"><?php echo t('The name is how your entity will appear in the Dashboard.') ?></p>
    </div>
    <div class="form-group <?php if ($error->containsField('handle')) { ?>has-error<?php } ?>">
        <label for="name" class="control-label"><?php echo t('Handle') ?></label>
        <div class="input-group">
            <?php echo $form->text('handle') ?>
            <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
        </div>
        <p class="help-block"><?php echo t('A unique string consisting of lowercase letters and underscores only.') ?></p>
    </div>
    <div class="form-group">
        <label for="name" class="control-label"><?php echo t('Plural Handle') ?></label>
        <?php echo $form->text('plural_handle') ?>
        <p class="help-block"><?php echo t('The plural representation of the handle above. Used to retrieve this entity if it is used in associations.') ?></p>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#advanced"><?php echo t('Advanced Options') ?>
                </a>
            </h4>
        </div>
        <div id="advanced"
             class="panel-collapse collapse <?php if ($controller->getRequest()->request->get('description') || $controller->getRequest()->request('supports_custom_display_order') || $controller->getRequest()->request->get('owned_by')) { ?>in <?php } ?>">
            <div class="panel-body">
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Description')?></label>
                    <?php echo $form->textarea('description', array('rows' => 5))?>
                    <p class="help-block"><?php echo t('An internal description. This is not publicly displayed.')?></p>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Custom Display Order') ?></label>
                    <div class="checkbox"><label>
                            <?php echo $form->checkbox('supports_custom_display_order', 1) ?>
                            <?php echo t('This entity supports custom display ordering via Dashboard interfaces.') ?>
                        </label></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo t('Owned By') ?></label>
                    <?php echo $form->select('owned_by', $entities) ?>
                </div>
                <div class="form-group" style="display: none" data-group="owned_by_type">
                    <label for="name" class="control-label"><?php echo t('Owning Type') ?></label>
                    <?php echo $form->select('owning_type', array(
                       'many' => t('Many'),
                    'one' => t('One')
                    )); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <a href="<?php echo URL::to('/dashboard/system/express/entities') ?>" class="pull-left btn btn-default"
               type="button"><?php echo t('Back to List') ?></a>
            <button class="pull-right btn btn-primary" type="submit"><?php echo t('Save') ?></button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function() {
        $('select[name=owned_by]').on('change', function() {
            if ($(this).val()) {
                $('div[data-group=owned_by_type]').show();
            } else {
                $('div[data-group=owned_by_type]').hide();
            }
        }).trigger('change');
    });
</script>