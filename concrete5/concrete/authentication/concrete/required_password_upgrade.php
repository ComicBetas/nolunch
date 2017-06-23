<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div class="required-password-upgrade">
    <form method="post"
          action="<?php echo URL::to('/login', 'callback', $authType->getAuthenticationTypeHandle(), 'required_password_upgrade') ?>">
        <h4><?php echo t('Required password upgrade') ?></h4>
        <div class="ccm-message"></div>
        <div class='help-block'>
            <?php echo isset($intro_msg) ? $intro_msg : t('Your user account is being upgraded and requires a new password. Please enter your email address below to create this now.') ?>
        </div>
        <div class="form-group">
            <input name="uEmail" type="email" placeholder="<?php echo t('Email Address') ?>" class="form-control"/>
        </div>
        <button name="required-password-upgrade" class="btn btn-primary btn-block"><?php echo t('Reset and Email Password') ?></button>
    </form>
</div>
