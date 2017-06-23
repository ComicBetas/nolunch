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
        <h3><?php echo t('Name')?></h3>
        <p><?php echo $entity->getName()?></p>

        <h3><?php echo t('Handle')?></h3>
        <p><?php echo $entity->getHandle()?></p>

        <h3><?php echo t('Description')?></h3>
        <p><?php echo $entity->getDescription()?></p>

        <?php if ($owned_by = $entity->getOwnedBy()) { ?>
            <h3><?php echo t('Owned By')?></h3>
            <p><a href="<?php echo URL::to('/dashboard/system/express/entities', 'view_entity', $owned_by->getID())?>"><?php echo $owned_by->getName()?></a></p>
        <?php } ?>

    </div>
</div>
