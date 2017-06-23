<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<legend><?php echo $category->getItemCategoryDisplayName()?></legend>

<ul class="list-unstyled">
    <?php foreach ($category->getItems($package) as $set) {
        ?>
            <li><?php echo ucfirst($set->getBlockTypeSetName())?></li>
        <?php
    }
    ?>
</ul>
