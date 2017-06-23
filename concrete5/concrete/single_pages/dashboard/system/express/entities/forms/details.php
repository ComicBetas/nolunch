<?php defined('C5_EXECUTE') or die("Access Denied.");?>
<form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('save')?>">
    <input type="hidden" name="entity_id" value="<?php echo $entity->getID()?>">

    <?php if (isset($expressForm)) {
    ?>
        <input type="hidden" name="form_id" value="<?php echo $expressForm->getID()?>">
    <?php 
} ?>

    <?php echo $token->output()?>

    <fieldset>
        <div class="form-group">
            <label for="name"><?php echo t('Name')?></label>
            <?php echo $form->text('name', $name)?>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <a href="<?php echo URL::to('/dashboard/system/express/entities/forms', $entity->getID())?>" class="pull-left btn btn-default" type="button" ><?php echo t('Back to Forms')?></a>
            <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
        </div>
    </div>
</form>