<?php
defined('C5_EXECUTE') or die("Access Denied.");
$form = Core::make("helper/form");
?>

	<div class="ccm-ui">
		<form method="post" data-dialog-form="add-topic-node" class="form-horizontal" action="<?php echo $controller->action('add_topic_node')?>">
			<input type="hidden" name="treeNodeID" value="<?php echo $node->getTreeNodeID()?>">
				<?php echo Loader::helper('validation/token')->output('add_topic_node')?>
			<div class="form-group">
				<?php echo $form->label('treeNodeTopicName', t('Topic'))?>
				<?php echo $form->text('treeNodeTopicName', '', array('class' => 'span4'))?>
			</div>

			<div class="dialog-buttons">
				<button class="btn btn-default" data-dialog-action="cancel"><?php echo t('Cancel')?></button>
				<button class="btn btn-primary pull-right" data-dialog-action="submit" type="submit"><?php echo t('Add')?></button>
			</div>

		</form>

		<script type="text/javascript">
			$(function() {
				ConcreteEvent.unsubscribe('AjaxFormSubmitSuccess.addTreeNode');
				ConcreteEvent.subscribe('AjaxFormSubmitSuccess.addTreeNode', function(e, data) {
					if (data.form == 'add-topic-node') {
						ConcreteEvent.publish('ConcreteTreeAddTreeNode', {'node': data.response});
					}
				});
			});
		</script>

	</div>