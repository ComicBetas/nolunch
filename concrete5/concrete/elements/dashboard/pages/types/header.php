<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>
<div class="ccm-dashboard-header-buttons btn-group">
    <?php if (count($siteTypes) > 1) { ?>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-button="attribute-type" data-toggle="dropdown">
            <?php echo $currentSiteType->getSiteTypeName()?> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php foreach($siteTypes as $type) { ?>
                <li><a href="<?php echo $view->action('view', $type->getSiteTypeID())?>"><?php echo $type->getSiteTypeName()?></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
    <a href="<?php echo $view->url('/dashboard/pages/types/organize', $siteTypeID)?>" class="btn btn-default"><?php echo t('Order &amp; Group')?></a>
    <a href="<?php echo $view->url('/dashboard/pages/types/add', $siteTypeID)?>" class="btn btn-primary"><?php echo t('Add Page Type')?></a>
</div>




