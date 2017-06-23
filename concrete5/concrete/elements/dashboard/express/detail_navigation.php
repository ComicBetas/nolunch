<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
?>
<div class="col-md-4">
    <div class="list-group">
        <a
            class="list-group-item <?php echo ($c->getCollectionPath() == '/dashboard/system/express/entities' && $view->controller->getTask() == 'view_entity') ? ' active' : ''?>"
            href="<?php echo URL::to('/dashboard/system/express/entities', 'view_entity', $entity->getId())?>"
        >
            <?php echo t('Details')?>
        </a>
        <a
            class="list-group-item<?php echo ($c->getCollectionPath() == '/dashboard/system/express/entities' && ($view->controller->getTask() == 'edit' || $view->controller->getTask() == 'update')) ? ' active' : ''?>"
            href="<?php echo URL::to('/dashboard/system/express/entities', 'edit', $entity->getId())?>"
        >
            <?php echo t('Edit Entity')?>
        </a>
        <a
            class="list-group-item<?php echo ($c->getCollectionPath() == '/dashboard/system/express/entities/attributes') ? ' active' : ''?>"
            href="<?php echo URL::to('/dashboard/system/express/entities/attributes', $entity->getId())?>"
        >
            <?php echo t('Attributes')?>
        </a>
        <a
            class="list-group-item<?php echo ($c->getCollectionPath() == '/dashboard/system/express/entities/associations') ? ' active' : ''?>"
            href="<?php echo URL::to('/dashboard/system/express/entities/associations', $entity->getId())?>"
        >
            <?php echo t('Associations')?>
        </a>
        <a
            class="list-group-item<?php echo ($c->getCollectionPath() == '/dashboard/system/express/entities/forms') ? ' active' : ''?>"
            href="<?php echo URL::to('/dashboard/system/express/entities/forms', $entity->getId())?>"
        >
            <?php echo t('Forms')?>
        </a>
        <a
            class="list-group-item<?php echo ($c->getCollectionPath() == '/dashboard/system/express/entities/customize_search') ? ' active' : ''?>"
            href="<?php echo URL::to('/dashboard/system/express/entities/customize_search', $entity->getId())?>"
        >
            <?php echo t('Customize Search/Listing')?>
        </a>
        <?php if ($entity->supportsCustomDisplayOrder()) { ?>
            <a
                class="list-group-item<?php echo ($c->getCollectionPath() == '/dashboard/system/express/entities/order_entries') ? ' active' : ''?>"
                href="<?php echo URL::to('/dashboard/system/express/entities/order_entries', $entity->getId())?>"
            >
                <?php echo t('Re-Order Entries')?>
            </a>
        <?php } ?>
        <a
            class="list-group-item"
            href="<?php echo URL::to('/dashboard/express/entries', $entity->getId())?>"
        >
            <i class="fa fa-share pull-right" style="margin-top: 4px"></i>
            <?php echo tc(/*i18n: %s is an entity name*/'Express', 'View %s Entries', $entity->getName())?>
        </a>
    </div>
</div>
