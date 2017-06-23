<?php
defined('C5_EXECUTE') or die("Access Denied.");
$form = Loader::helper('form');
    ?>

	<div class="ccm-ui">
		<form method="post" data-dialog-form="edit-topic-category-node" class="form-horizontal" action="<?php echo $controller->action('update_category_node')?>">
			<?php echo Loader::helper('validation/token')->output('update_category_node')?>
			<input type="hidden" name="treeNodeID" value="<?php echo $node->getTreeNodeID()?>" />
			<div class="form-group">
				<?php echo $form->label('treeNodeCategoryName', t('Category Name'))?>
				<?php echo $form->text('treeNodeCategoryName', $node->getTreeNodeName(), array('class' => 'span4'))?>
			</div>
			<div class="dialog-buttons">
				<button class="btn btn-default" data-dialog-action="cancel"><?php echo t('Cancel')?></button>
				<button class="btn btn-primary pull-right" data-dialog-action="submit" type="submit"><?php echo t('Update')?></button>
			</div>
		</form>

		<script type="text/javascript">
			$(function() {
				ConcreteEvent.unsubscribe('AjaxFormSubmitSuccess.updateTreeNode');
				ConcreteEvent.subscribe('AjaxFormSubmitSuccess.updateTreeNode', function(e, data) {
					if (data.form == 'edit-topic-category-node') {
						ConcreteEvent.publish('ConcreteTreeUpdateTreeNode', {'node': data.response});
					}
				});
			});
		</script>

	</div>
