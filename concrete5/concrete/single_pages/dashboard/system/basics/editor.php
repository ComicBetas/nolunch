<?php defined('C5_EXECUTE') or die("Access Denied.");?>
<form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('submit')?>">
	<?php echo $this->controller->token->output('submit')?>
	<fieldset>
		<label class="control-label"><?php echo t('concrete5 Extensions')?></label>
		<div class="checkbox">
			<label>
				<?php echo $form->checkbox('enable_filemanager', 1, $filemanager)?> <?php echo t('Enable file selection from file manager.')?>
			</label>
		</div>
		<div class="checkbox">
			<label>
				<?php echo $form->checkbox('enable_sitemap', 1, $sitemap)?> <?php echo t('Enable page selection from sitemap.')?>
			</label>
		</div>
	</fieldset>
	<hr/>
	<fieldset>
		<label class="control-label"><?php echo t('Editor Plugins')?></label>
		<?php
		foreach ($plugins as $key => $plugin) {
			if (!in_array($key, $selected_hidden)) {
		?>
		<div class="checkbox">
			<label>
				<?php echo $form->checkbox('plugin[]', $key, $manager->isSelected($key))?> <?php echo $plugin->getName()?>
			</label>
		</div>
		<?php
			}
		}
		?>
	</fieldset>
	<div class="ccm-dashboard-form-actions-wrapper">
		<div class="ccm-dashboard-form-actions">
			<button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
		</div>
	</div>
</form>
