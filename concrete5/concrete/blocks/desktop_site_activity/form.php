<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="form-group">
    <?php echo $form->label('types', t('Types to Display'));?>
    <div class="checkbox"><label><?php echo $form->checkbox('types[]', 'form_submissions', in_array('form_submissions', $types))?> <?php echo t('Form Submissions')?></label></div>
    <div class="checkbox"><label><?php echo $form->checkbox('types[]', 'survey_results', in_array('survey_results', $types))?> <?php echo t('Survey Results')?></label></div>
    <div class="checkbox"><label><?php echo $form->checkbox('types[]', 'signups', in_array('signups', $types))?> <?php echo t('New Users')?></label></div>
    <div class="checkbox"><label><?php echo $form->checkbox('types[]', 'conversation_messages', in_array('conversation_messages', $types))?> <?php echo t('Conversation Messages')?></label></div>
    <div class="checkbox"><label><?php echo $form->checkbox('types[]', 'workflow', in_array('workflow', $types))?> <?php echo t('Workflow Approvals')?></label></div>
</div>
