<?php defined('C5_EXECUTE') or die("Access Denied.");

$ih = Loader::helper('concrete/ui');
$enabledVals = array('0' => t('No'), '1' => t('Yes'));
$secureVals = array('' => t('None'), 'SSL' => tc('Encryption', 'SSL'), 'TLS' => tc('Encryption', 'TLS'));
$form = Loader::helper('form');
?>

<form method="post" action="<?php echo $view->url('/dashboard/system/mail/method', 'save_settings')?>" id="mail-settings-form">
    <?php Loader::helper('validation/token')->output('save_settings') ?>

    <fieldset>
        <div class="form-group">
            <div class="radio">
                <label><?php echo $form->radio('MAIL_SEND_METHOD', 'PHP_MAIL', strtoupper(Config::get('concrete.mail.method')))?><span><?php echo t('Default PHP Mail Function')?></span></label>
            </div>
            <div class="radio">
                <label><?php echo $form->radio('MAIL_SEND_METHOD', 'SMTP', strtoupper(Config::get('concrete.mail.method')))?><span><?php echo t('External SMTP Server')?></span></label>
            </div>
        </div>
    </fieldset>

    <fieldset id="ccm-settings-mail-smtp" style="display:none">
        <legend><?php echo t('SMTP Settings')?></legend>
        <div class="form-group">
            <?php echo $form->label('MAIL_SEND_METHOD_SMTP_SERVER', t('Mail Server'));?>
            <?php echo $form->text('MAIL_SEND_METHOD_SMTP_SERVER', Config::get('concrete.mail.methods.smtp.server'))?>
        </div>

        <div class="form-group">
            <?php echo $form->label('MAIL_SEND_METHOD_SMTP_USERNAME', t('Username'));?>
            <?php echo $form->text('MAIL_SEND_METHOD_SMTP_USERNAME', Config::get('concrete.mail.methods.smtp.username'))?>
        </div>

        <div class="form-group">
            <?php echo $form->label('MAIL_SEND_METHOD_SMTP_PASSWORD', t('Password'));?>
            <?php echo $form->password('MAIL_SEND_METHOD_SMTP_PASSWORD', Config::get('concrete.mail.methods.smtp.password'), array('autocomplete' => 'off'))?>
        </div>

        <div class="form-group">
            <?php echo $form->label('MAIL_SEND_METHOD_SMTP_ENCRYPTION', t('Encryption'));?>
            <?php echo $form->select('MAIL_SEND_METHOD_SMTP_ENCRYPTION', $secureVals, Config::get('concrete.mail.methods.smtp.encryption'))?>
        </div>

        <div class="form-group">
            <?php echo $form->label('MAIL_SEND_METHOD_SMTP_PORT', t('Port (Leave blank for default)'));?>
            <?php echo $form->text('MAIL_SEND_METHOD_SMTP_PORT', Config::get('concrete.mail.methods.smtp.port'))?>
        </div>
    </fieldset>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <a href="<?php echo $view->url('/dashboard/system/mail/method/test')?>" class="btn btn-default pull-left"><?php echo t('Test Settings')?></a>
            <?php echo $ih->submit(t('Save'), 'mail-settings-form', 'right', 'btn-primary')?>
        </div>
    </div>
</form>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);?>

<script type="text/javascript">
ccm_checkMailSettings = function() {
    obj = $("input[name=MAIL_SEND_METHOD]:checked");
    if (obj.val() == 'SMTP') {
        $("#ccm-settings-mail-smtp").show();
    } else {
        $("#ccm-settings-mail-smtp").hide();
    }
};

$("input[name=MAIL_SEND_METHOD]").click(function() {
    ccm_checkMailSettings();
});
ccm_checkMailSettings();
</script>
