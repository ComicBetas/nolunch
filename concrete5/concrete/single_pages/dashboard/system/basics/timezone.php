<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>
<form method="POST" id="user-timezone-form" action="<?php echo $view->action('update') ?>">
    <?php $token->output('update_timezone') ?>

    <fieldset>
        <legend><?php echo t('Server Configuration')?></legend>

        <div class="form-group">
            <label class="control-label">
                <?php echo t('PHP Setting') ?>
            </label>

            <div><?php echo h($serverTimezonePHP)?></div>
        </div>
        <div class="form-group">
            <label class="control-label">
                <?php echo t('Database Setting') ?>
            </label>

            <div><?php echo h($serverTimezoneDB)?></div>
        </div>

        <div class="form-group">
            <label class="control-label launch-tooltip" data-placement="right" title="<?php echo t(
                'These two values must match, otherwise there will be date inconsistencies.'
            ) ?>">
                <?php echo t('Status') ?>
            </label>
            <div>
                <?php if (!$dbTimezoneOk) { ?>
                    <p class="text-warning"><i class="fa fa-warning"></i>
                        <?php echo $dbDeltaDescription ?>
                    </p>
                    <p>
                        <a href="#" id="user-timezone-autofix" class="btn btn-warning btn-sm"><?php echo t('Fix PHP timezone')?></a>
                    </p>
                <?php } else { ?>
                    <div class="text-success"><i class="fa fa-check"></i>
                        <?php echo t('Success. These time zone values match.')?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo t('Settings')?></legend>
        <div class="form-group">
            <label class="control-label launch-tooltip" data-placement="right" title="<?php echo t(
                'This will control the default timezone that will be used to display date/times.'
            ) ?>">
                <?php echo t('Default Timezone') ?>
            </label>
            <select class="form-control" name="timezone">
                <?php
                foreach ($timezones as $areaName => $namedTimezones) {
                    ?>
                    <optgroup label="<?php echo h($areaName) ?>">
                        <?php
                        foreach ($namedTimezones as $tzID => $tzName) {
                            ?>
                            <option value="<?php echo h($tzID) ?>"<?php echo strcasecmp($tzID, $timezone) === 0 ? ' selected="selected"' : '' ?>>
                                <?php echo h($tzName) ?>
                            </option>
                            <?php
                        } ?>
                    </optgroup>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">
                <?php echo t('User-Specific Timezones') ?>
            </label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="user_timezones" value="1"<?php echo $user_timezones ? ' checked="checked"' : '' ?> />
                <span class="launch-tooltip control-label" data-placement="right" title="<?php echo t(
                    'With this setting enabled, users may specify their own time zone in their user profile, and content timestamps will be adjusted accordingly. Without this setting enabled, content timestamps appear in server time.'
                ) ?>"><?php echo t('Enable user defined time zones.') ?></span>
                </label>
            </div>
        </div>
    </fieldset>


    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php echo $interface->submit(t('Save'), 'user-timezone-form', 'right', 'btn-primary'); ?>
        </div>
    </div>

</form>
<?php
if (isset($compatibleTimezones) && !empty($compatibleTimezones)) {
    ?>
    <div id="user-timezone-autofix-dialog" style="display: none" class="ccm-ui" title="<?php echo t('Select time zone')?>">
        <form method="POST" action="<?php echo $view->action('setSystemTimezone') ?>" class="ccm-ui" id="user-timezone-autofix-form">
            <?php $token->output('set_system_timezone') ?>
            <div class="form-group">
                <select class="form-control" size="15" name="new-timezone">
                    <?php
                    foreach ($compatibleTimezones as $timezoneID => $timezoneName) {
                        ?><option value="<?php echo h($timezoneID)?>"><?php echo h($timezoneName)?></option><?php
                    }
                    ?>
                </select>
            </div>
        </form>
        <div class="dialog-buttons">
            <button type="button" onclick="jQuery.fn.dialog.closeTop()" class="btn btn-default pull-left"><?php echo t('Cancel')?></button>
            <button type="button" onclick="$('#user-timezone-autofix-form').submit()" class="btn btn-primary pull-right"><?php echo t('Save')?></button>
        </div>
    </div>
    <?php
}
?>
<script>
$(document).ready(function() {
    $('#user-timezone-autofix').on('click', function(e) {
        e.preventDefault();
        var $dlg = $('#user-timezone-autofix-dialog');
        if ($dlg.length === 0) {
            window.alert(<?php echo json_encode("No PHP compatible time zone is compatible with the database time zone.\nYou should change the database default timezone.")?>);
            return;
        }
        jQuery.fn.dialog.open({
            element: $dlg,
            resizable: false,
            height: 370
        });
    });
});
</script>