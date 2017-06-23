<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<legend><?php echo $category->getItemCategoryDisplayName()?></legend>

<ul class="list-unstyled">
    <?php foreach ($category->getItems($package) as $page) {
        ?>
        <li class="clearfix row">
            <span class="col-sm-2"><a href="<?php echo $page->getCollectionLink()?>"><?php echo $page->getCollectionName()?></a></span>
            <span class="col-sm-3"><code><?php echo $page->getCollectionPath()?></code></span>
            <span class="col-sm-5"><?php echo $page->getCollectionDescription()?></span>
        </li>
        <?php
    }
    ?>
</ul>
