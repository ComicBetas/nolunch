<?php defined('C5_EXECUTE') or die('Access Denied.');

$resetText = tc(/*i18n: a text to be asked to the users to confirm the global password reset operation */'GlobalPasswordReset', 'RESET');

?>
<form id="global-password-reset-form" action="<?php echo $view->action('reset_passwords') ?>" method="post">
    <?php echo Core::make('helper/validation/token')->output('global_password_reset_token') ?>

    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <div class="form-group">
                    <p>
                        <?php echo t('Global Password Reset allows Administrators to force reset all user passwords.')?>
                        <?php echo t('The system signs out all users, resets their passwords and forces them to choose a new one.')?>
                    </p>
                    <div class="alert alert-info">
                        <strong><?php echo t('Note:')?></strong> <?php echo t('If you have overridden the standard concrete5 authentication system or you have created your own, you may not need to reset all passwords.')?>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?php echo t('Edit message')?></legend>
                <div class="form-group">
                    <p>
                        <?php echo t('This message will be shown to users the next time they log in.')?>
                    </p>
                    <div class="input">
                        <?php echo $form->textarea('resetMessage', $resetMessage, array('rows' => 4, 'cols' => 10)) ?>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?php echo t('Confirmation')?></legend>
                <div class="form-group">
                    <p>
                        <?php echo t('Type "%s" in the following box to proceed.', h($resetText))?>
                    </p>
                    <div class="input">
                        <?php echo $form->text('confirmation') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="alert alert-danger">
                        <strong><?php echo t('Warning:')?></strong> <?php echo t('This action will automatically log out all users (including yourself) and reset their passwords.')?>
                    </div>
                </div>
            </fieldset>

            <div class="ccm-dashboard-form-actions-wrapper">
                <div class="ccm-dashboard-form-actions">
                    <button type="submit" class="btn btn-danger pull-right disabled" name="global-password-reset-form"><?php echo t('Reset all passwords') ?></button>
                </div>
            </div>

        </div>
    </div>
</form>

<script type="text/javascript">
    $(function () {
        var disableForm = <?php echo json_encode($disableForm) ?>;
        if (disableForm) {
            $("#global-password-reset-form :input").prop("disabled", true);
        }

        $('input[name=confirmation]').on('keyup', function () {
            if ($(this).val() === <?php echo json_encode($resetText)?>) {
                $('button[name=global-password-reset-form]').removeClass("disabled");
            } else {
                $('button[name=global-password-reset-form]').addClass("disabled");
            }
        });
    });
</script>