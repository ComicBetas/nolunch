<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<legend><?php echo $category->getItemCategoryDisplayName()?></legend>

<dl class="dl-horizontal">
    <?php foreach ($category->getItems($package) as $at) {
        $controller = $at->getController();
        $formatter = $controller->getIconFormatter();
        ?>
        <dt><?php echo $formatter->getListIconElement()?></dt>
        <dd>
            <?php echo $at->getAttributeTypeName()?>
            <?php
            foreach ($categories as $cat) {
                if (!$at->isAssociatedWithCategory($cat)) {
                    continue;
                }
                ?>
                <span class="badge"><?php echo $text->unhandle($cat->getAttributeKeyCategoryHandle())?></span>
                <?php
            }
            ?>
        </dd>
        <?php
    }
    ?>
</dl>