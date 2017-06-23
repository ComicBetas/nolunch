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
        <form method="post" action="<?php echo $view->action('save', $entity->getID())?>">
            <?php echo $token->output('save')?>
        <?php
        print $customizeElement->render();
        ?>
            <div class="ccm-dashboard-form-actions-wrapper">
                <div class="ccm-dashboard-form-actions">
                    <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
                </div>
            </div>

        </form>
    </div>
</div>