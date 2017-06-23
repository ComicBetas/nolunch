<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<legend><?php echo $category->getItemCategoryDisplayName()?></legend>

<ul id="ccm-block-type-package-list" class="item-select-list">
    <?php foreach ($category->getItems($package) as $bt) {
        ?>
        <li>
            <a href="<?php echo $view->url('/dashboard/blocks/types', 'inspect', $bt->getBlockTypeID());
            ?>"><img src="<?php echo $ci->getBlockTypeIconURL($bt)?>" /> <?php echo t($bt->getBlockTypeName());
                ?></a>
        </li>
        <?php
    }
    ?>
</ul>
