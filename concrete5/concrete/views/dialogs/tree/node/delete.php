<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ccm-ui">
    <form method="post" data-dialog-form="remove-tree-node" class="form-horizontal" action="<?php echo $controller->action('remove_tree_node')?>">
        <?php echo Loader::helper('validation/token')->output('remove_tree_node')?>
        <input type="hidden" name="treeNodeID" value="<?php echo $node->getTreeNodeID()?>" />
        <p><?php echo t('Are you sure you want to remove "%s"?', $node->getTreeNodeDisplayName())?></p>

        <div class="dialog-buttons">
            <button class="btn btn-default" data-dialog-action="cancel"><?php echo t('Cancel')?></button>
            <button class="btn btn-danger pull-right" data-dialog-action="submit" type="submit"><?php echo t('Remove')?></button>
        </div>
    </form>

    <script type="text/javascript">
        $(function() {
            ConcreteEvent.unsubscribe('AjaxFormSubmitSuccess.deleteTreeNode');
            ConcreteEvent.subscribe('AjaxFormSubmitSuccess.deleteTreeNode', function(e, data) {
                if (data.form == 'remove-tree-node') {
                    ConcreteEvent.publish('ConcreteTreeDeleteTreeNode', {'node': data.response});
                }
            });
        });
    </script>

</div>
