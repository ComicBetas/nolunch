<?php
defined('C5_EXECUTE') or die("Access Denied.");
$datetime = loader::helper('form/date_time');

$publishDate = '';
if (isset($page) && is_object($page)) {
    $v = CollectionVersion::get($page, "RECENT");
    $publishDate = $v->getPublishDate();
}

$dateService = Core::make('date');
$timezone = $dateService->getUserTimeZoneID();
$timezone = $dateService->getTimezoneDisplayName($timezone);
?>

<div class="form-group form-group-last">
    <label class="control-label"><?php echo t('Date/Time')?></label>
    <?php echo $datetime->datetime('check-in-scheduler', $publishDate, false, true,
        'dark-panel-calendar'); ?>
    <span class="help-block" style="display: block"><?php echo t('Time Zone: %s', $timezone)?></span>
</div>
<div class="dialog-buttons">
    <button type="submit" name="action" value="schedule"
            class="btn btn-primary ccm-check-in-schedule">
        <?php echo t('Schedule')?>
    </button>
</div>

<style type="text/css">
    div.ui-dialog button.ccm-check-in-schedule {
        float: right;
    }
</style>
