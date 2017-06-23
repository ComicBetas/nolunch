<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<h2><?php echo $c->getCollectionName()?></h2>

<form method="post" action="<?php echo $view->action('save')?>" enctype="multipart/form-data">
	<?php  $attribs = UserAttributeKey::getEditableInProfileList();
    $valt->output('profile_edit');
    ?>
	<fieldset>
	<legend><?php echo t('Basic Information')?></legend>
	<div class="form-group">
		<?php echo $form->label('uEmail', t('Email'))?>
		<?php echo $form->text('uEmail', $profile->getUserEmail())?>
	</div>
	<?php  if (Config::get('concrete.misc.user_timezones')) {
     ?>
		<div class="form-group">
			<?php echo  $form->label('uTimezone', t('Time Zone'))?>
			<?php echo  $form->select('uTimezone',
                Core::make('helper/date')->getTimezones(),
                ($profile->getUserTimezone() ? $profile->getUserTimezone() : date_default_timezone_get())
        );
     ?>
		</div>
	<?php
 } ?>
	<?php  if (is_array($locales) && count($locales)) {
     ?>
		<div class="form-group">
			<?php echo $form->label('uDefaultLanguage', t('Language'))?>
			<?php echo $form->select('uDefaultLanguage', $locales, Localization::activeLocale())?>
		</div>
	<?php
 } ?>
	<?php
    if (is_array($attribs) && count($attribs)) {
        $af = Loader::helper('form/attribute');
        $af->setAttributeObject($profile);
        foreach ($attribs as $ak) {
            echo '<div class="ccm-profile-attribute">';
            echo $af->display($ak, $ak->isAttributeKeyRequiredOnProfile());
            echo '</div>';
        }
    }
    ?>
	</fieldset>
	<?php
    $ats = AuthenticationType::getList(true, true);

    $ats = array_filter($ats, function (AuthenticationType $type) {
        return $type->hasHook();
    });

    $count = count($ats);
    if ($count) {
        ?>
		<fieldset>
			<legend><?php echo t('Authentication Types')?></legend>
			<?php
            foreach ($ats as $at) {
                $at->renderHook();
            }
        ?>
		</fieldset>
		<?php

    }
    ?>
        <br/>
	<fieldset>
    	<legend><?php echo t('Change Password')?></legend>
        <div class="form-group">
            <?php echo $form->label('uPasswordNew', t('New Password'))?>
            <?php echo $form->password('uPasswordNew', array('autocomplete' => 'off'))?>
            <a href="javascript:void(0)" title="<?php echo t("Leave blank to keep current password.")?>"><i class="icon-question-sign"></i></a>
		</div>

        <div class="form-group">
            <?php echo $form->label('uPasswordNewConfirm', t('Confirm New Password'))?>
            <div class="controls">
                <?php echo $form->password('uPasswordNewConfirm', array('autocomplete' => 'off'))?>
            </div>
        </div>

	</fieldset>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
    		<input type="submit" name="save" value="<?php echo t('Save')?>" class="btn btn-primary pull-right" />
        </div>
	</div>

</form>
