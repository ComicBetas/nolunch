<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="form-group" data-group="composer-description">
	<label class="control-label"><?php echo $label?></label>
	<?php if ($description): ?>
	<i class="fa fa-question-circle launch-tooltip" title="" data-original-title="<?php echo $description?>"></i>
	<?php endif; ?>
	<?php echo $form->textarea($this->field('description'), $control->getPageTypeComposerControlDraftValue(), array('rows' => 3))?>
</div>

<script type="text/javascript">
	$(function() {
		autosize($('div[data-group=composer-description] textarea'));
	});
</script>