<?php
defined('C5_EXECUTE') or die("Access Denied.");

$final_label = $control->getDisplayLabel();
$original_label = $control->getControlLabel();
$type_name = $control->getControlType()->getDisplayName();
$c = Page::getCurrentPage();
?>

<tr class="ccm-item-set-item" data-field-set-control="<?php echo $control->getID()?>">
	<td style="width: 20%; white-space: nowrap"><?php echo $final_label ?></td>
	<td style="width: 100%;">
		<span class="text-muted"><?php echo $type_name ?></span>
		<?php

        if ($final_label != $original_label) {
            ?>
			<span class="text-muted">(<?php echo $original_label ?>)</span>
		<?php 
        } ?>
	</td>
        <td>
		<span class="text-muted"><?php if ($control->isRequired()) { echo t('Required'); } ?></span>
	</td>
	<td>
		<ul class="ccm-item-set-controls">
			<li><a href="#" data-command="move-control" style="cursor: move"><i class="fa fa-arrows"></i></a></li>
			<li><a data-command="edit-control" href="<?php echo URL::to('/dashboard/system/express/entities/forms', 'edit_control', $control->getId())?>" dialog-height="450" dialog-width="600" dialog-title="<?php echo t('Edit Control')?>" class="dialog-launch"><i class="fa fa-pencil"></i></a></li>
			<li><a href="#" data-dialog="delete-set-control-<?php echo $control->getId()?>" data-dialog-title="<?php echo t('Delete Control')?>"><i class="fa fa-trash-o"></i></a></li>
		</ul>

		<div style="display: none">
		<div id="ccm-dialog-delete-set-control-<?php echo $control->getID()?>" class="ccm-ui">
			<form method="post" action="<?php echo URL::to($c, 'delete_set_control', $control->getFieldSet()->getForm()->getID())?>">
				<?php echo Core::make("token")->output('delete_set_control')?>
				<input type="hidden" name="field_set_control_id" value="<?php echo $control->getID()?>">
				<p><?php echo t('Are you sure you want to delete this control? This cannot be undone.')?></p>
				<div class="dialog-buttons">
					<button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
					<button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-delete-set-control-<?php echo $control->getId()?> form').submit()"><?php echo t('Delete Set')?></button>
				</div>
			</form>
		</div>
		</div>

	</td>
</tr>

