<?php
defined('C5_EXECUTE') or die("Access Denied.");
$form = \Core::make('helper/form');
?>

<div class="ccm-ui">
	<form method="post" data-dialog-form="add-category-node" class="form-horizontal" action="<?php echo $controller->action('add_category_node')?>">
		<input type="hidden" name="treeNodeID" value="<?php echo $node->getTreeNodeID()?>">
		<?php echo Loader::helper('validation/token')->output('add_category_node')?>
		<div class="form-group">
			<?php echo $form->label('treeNodeCategoryName', t('Category Name'))?>
			<?php echo $form->text('treeNodeCategoryName', '', array('class' => 'span4'))?>
		</div>

		<div class="dialog-buttons">
			<button class="btn btn-default" data-dialog-action="cancel"><?php echo t('Cancel')?></button>
			<button class="btn btn-primary pull-right" data-dialog-action="submit" type="button"><?php echo t('Add')?></button>
		</div>
	</form>

	<script type="text/javascript">
		$(function() {
			ConcreteEvent.unsubscribe('AjaxFormSubmitSuccess.addTreeNode');
			ConcreteEvent.subscribe('AjaxFormSubmitSuccess.addTreeNode', function(e, data) {
				if (data.form == 'add-category-node') {
					ConcreteEvent.publish('ConcreteTreeAddTreeNode', {'node': data.response});
				}
			});
		});
	</script>

</div>