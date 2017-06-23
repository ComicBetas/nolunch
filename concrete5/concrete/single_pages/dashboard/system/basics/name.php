<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<div class="ccm-dashboard-header-buttons">
	<a href="<?php echo View::url('/dashboard/system/basics/attributes')?>" class="btn btn-default"><?php echo t("Manage Attributes")?></a>
</div>

<form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('update_sitename')?>">
	<?php echo $this->controller->token->output('update_sitename')?>

	<fieldset>
		<legend><?php echo t('Core Properties') ?></legend>
		<div class="form-group">
			<label for="SITE" class="launch-tooltip control-label" data-placement="right" title="<?php echo t('By default, site name is displayed in the browser title bar. It is also the default name for your project on concrete5.org')?>"><?php echo t('Site Name')?></label>
			<?php echo $form->text('SITE', $site->getSiteName(), array('class' => 'span4'))?>
		</div>
	</fieldset>

	<fieldset>
		<legend><?php echo t('Custom Attributes')?></legend>
		<?php
		if (count($attributes) > 0) {
			$af = Loader::helper('form/attribute');
			$af->setAttributeObject($site);
			foreach ($attributes as $ak) {
				echo $af->display($ak);
			}
		} else { ?>
			<p><?php echo t('You have not defined any <a href="%s">custom attributes</a> for this site.', URL::to('/dashboard/system/basics/attributes'))?></p>
		<?php } ?>

	</fieldset>

	<div class="ccm-dashboard-form-actions-wrapper">
	<div class="ccm-dashboard-form-actions">
		<button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
	</div>
	</div>

</form>
