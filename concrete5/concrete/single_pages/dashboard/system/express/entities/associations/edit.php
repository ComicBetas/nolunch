<?php defined('C5_EXECUTE') or die("Access Denied.");?>
<form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('save_association', $entity->getID())?>">
    <input type="hidden" name="association_id" value="<?php echo $association->getID()?>">

    <?php echo $token->output()?>

    <div class="form-group">
        <label for="name" class="control-label"><?php echo t('Target Property Name')?></label>
        <?php echo $form->text('target_property_name', $association->getTargetPropertyName())?>
    </div>

    <div class="form-group">
        <label for="name" class="control-label"><?php echo t('Inversed Property Name')?></label>
        <?php echo $form->text('inversed_property_name', $association->getInversedByPropertyName())?>
    </div>

    <div class="form-group">
        <label class="control-label"><?php echo t('Owning Association')?></label>
        <div class="radio">
            <label><?php echo $form->radio('is_owning_association', 1, $association->isOwningAssociation())?> <?php echo t('Yes')?></label>
        </div>
        <div class="radio">
            <label><?php echo $form->radio('is_owning_association', 0, $association->isOwningAssociation())?> <?php echo t('No')?></label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label"><?php echo t('Owned By Association')?></label>
        <div class="radio">
            <label><?php echo $form->radio('is_owned_by_association', 1, $association->isOwnedByAssociation())?> <?php echo t('Yes')?></label>
        </div>
        <div class="radio">
            <label><?php echo $form->radio('is_owned_by_association', 0, $association->isOwnedByAssociation())?> <?php echo t('No')?></label>
        </div>
    </div>



    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <a href="<?php echo URL::to('/dashboard/system/express/entities/associations', 'view_association_details', $association->getID())?>" class="pull-left btn btn-default" type="button" ><?php echo t('Back to Association')?></a>
            <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
        </div>
    </div>
</form>