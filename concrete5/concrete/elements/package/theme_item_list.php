<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<legend><?php echo $category->getItemCategoryDisplayName()?></legend>

<ul class="list-unstyled">
    <?php foreach ($category->getItems($package) as $theme) {
        ?>
        <li>
            <div><a href="<?php echo $view->url('/dashboard/pages/themes/inspect', $theme->getThemeID())?>"><?php echo $theme->getThemeDisplayName()?></a></div>
            <div> <?php echo $theme->getThemeDisplayDescription();
                ?> </div>
        </li>
        <?php
    }
    ?>
</ul>
