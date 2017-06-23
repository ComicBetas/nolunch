<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>


<div class="btn-group">

<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $currentType->getName()?>
    <span class="caret"></span>
</button>

<ul class="dropdown-menu">
    <li class="dropdown-header"><?php echo t('Types')?></li>
    <?php foreach ($types as $type) {
        if ($entityAction == 'view') {
            $action = URL::to('/dashboard/express/entries', $type->getID());
        } else {
            $action = URL::to('/dashboard/system/express/entities', 'view_entity', $type->getID());
        }
    ?>
        <li><a href="<?php echo $action?>"><?php echo $type->getName()?></a></li>
    <?php

}
    ?>
    <li class="divider"></li>
    <li><a href="<?php echo URL::to('/dashboard/system/express/entities', 'add')?>"><?php echo t('Add Data Object')?></a></li>
</ul>

</div>