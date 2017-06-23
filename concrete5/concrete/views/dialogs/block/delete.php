<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ccm-ui">

	<form method="post" data-form="delete-block" data-action-delete-all="<?php echo $deleteAllAction?>" data-action="<?php echo $deleteAction?>">

		<div class="dialog-buttons">
		<button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()""><?php echo t('Cancel')?></button>
		<button type="button" data-submit="delete-block-form" class="btn btn-danger pull-right"><?php echo t('Delete')?></button>
		</div>

		<p class="lead"><?php echo t('Are you sure you wish to delete this block?')?></p>

		<?php if ($isMasterCollection) { ?>

			<div class="alert alert-danger"><?php echo t('Warning! This block is contained in the page type defaults. Any blocks aliased from this block in the site will be deleted. This cannot be undone.') ?></div>

			<div class="form-group">
				<label class="control-label"><?php echo t('Instances on Child Pages')?></label>
				<div class="radio"><label><input type="radio" name="deleteAll" value="0" checked> <?php echo t('Delete only unforked instances on child pages.')?></label></div>
				<div class="radio"><label><input type="radio" name="deleteAll" value="1"> <?php echo t('Delete even forked instances on child pages.')?></label></div>
			</div>


			<div data-dialog-form-element="progress-bar"></div>

		<?php
} else {
    ?>

		<p><?php echo t('Deleted blocks can usually be found approving a previous version of the page.')?></p>

<?php } ?>

	</form>

	<script type="text/javascript">
	$(function() {
		var $form = $('form[data-form=delete-block]'),
			options = {};
		$('button[data-submit=delete-block-form]').on('click', function() {
			var mode = parseInt($form.find('input[name=deleteAll]:checked').val());
			if (mode == 1) {
				options = {
					url: $form.attr('data-action-delete-all'),
					data: $form.formToArray(true),
					progressiveOperation: true,
					progressiveOperationElement: 'div[data-dialog-form-element=progress-bar]'
				}
			} else {
				options = {
					url: $form.attr('data-action'),
					data: $form.formToArray(true)
				}
			}

			options.success = function(r) {
				var editor = Concrete.getEditMode();
				var area = editor.getAreaByID(parseInt(r.aID));
				var block = area.getBlockByID(parseInt(r.bID));

				ConcreteEvent.fire('EditModeBlockDeleteComplete', {
					block: block
				});
				jQuery.fn.dialog.closeTop();
				ConcreteAlert.notify({
					'message': r.message,
					'title': r.title
				});
			}
			$form.concreteAjaxForm(options);
			$form.trigger('submit');
		});
	});
	</script>

</div>
