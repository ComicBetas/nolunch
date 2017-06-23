<?php

defined('C5_EXECUTE') or die("Access Denied.");

?>

<div class="ccm-dashboard-content-full">
    <div class="table-responsive">
        <table class="ccm-search-results-table">
            <thead>
            <tr>
                <th></th>
                <th class=""><span><?php echo t('Name')?></span></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($nodes as $node) {
                $formatter = $node->getListFormatter();
                ?>
                <tr data-details-url="<?php echo $view->action('view', $node->getTreeNodeID())?>"
                    class="<?php echo $formatter->getSearchResultsClass()?>">
                    <td class="ccm-search-results-icon"><?php echo $formatter->getIconElement()?></td>
                    <td class="ccm-search-results-name"><?php echo $node->getTreeNodeDisplayName()?></td>
                    <td></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>