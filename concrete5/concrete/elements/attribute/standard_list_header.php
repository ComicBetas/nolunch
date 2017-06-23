<?php
defined('C5_EXECUTE') or die("Access Denied.");
if ($category && $category->getController()->getSetManager()->allowAttributeSets()) {
    ?>


    <a href="<?php echo URL::to('/dashboard/system/attributes/sets', 'category', $category->getAttributeKeyCategoryID())?>" class="btn btn-default"><?php echo t('Manage Sets')?></a>

<?php 
} ?>