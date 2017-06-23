<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-dashboard-header-buttons">
    <a href="<?php echo URL::to('/dashboard/system/express/entities/add')?>" class="btn btn-primary"><?php echo t('Add Object')?></a>
</div>

<h3><?php echo t('Express Objects')?></h3>

<?php if (count($entities)) { ?>
<ul class="item-select-list">
<?php foreach ($entities as $entity) {
?>
    <li><a href="<?php echo $this->action('view', $entity->getID())?>"><i class="fa fa-database"></i> <?php echo $entity->getName()?></a></li>
<?php
}
?>
</ul>
<?php } else { ?>

    <p><?php echo t('No entities created yet. First, create an Express object, then you can add entries to it.')?></p>

<?php }
