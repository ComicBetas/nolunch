<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

	<?php $root = (new \Concrete\Core\File\Filesystem())->getRootFolder(); ?>

	<form method="post" action="<?php echo $view->action('save')?>" id="ccm-permission-list-form">

		<?php echo Loader::helper('validation/token')->output('save_permissions')?>
		<?php
		$tp = new TaskPermission();
		if ($tp->canAccessTaskPermissions()) {
			?>
			<?php Loader::element('permission/lists/tree/node', array('node' => $root, 'disableDialog' => true))?>
		<?php
		} else {
			?>
			<p><?php echo t('You cannot access task permissions.')?></p>
		<?php
		} ?>

	<div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
        </div>
    </div>
	</form>
