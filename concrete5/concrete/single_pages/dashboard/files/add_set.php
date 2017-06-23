<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $ih = Loader::helper('concrete/ui'); ?>

    <form method="post" id="file-sets-add" action="<?php echo $view->url('/dashboard/files/add_set', 'do_add')?>">

	<?php echo $validation_token->output('file_sets_add');?>

	<div class="form-group">
		<?php echo Loader::helper("form")->label('file_set_name', t('Name'))?>
		<?php echo $form->text('file_set_name', '', array('autofocus' => 'autofocus'))?>
	</div>


	<div class="ccm-dashboard-form-actions-wrapper">
	<div class="ccm-dashboard-form-actions">
		<a href="<?php echo View::url('/dashboard/files/sets')?>" class="btn btn-default pull-left"><?php echo t('Cancel')?></a>
		<?php echo Loader::helper("form")->submit('add', t('Add'), array('class' => 'btn btn-primary pull-right'))?>
	</div>
	</div>
	</form>
