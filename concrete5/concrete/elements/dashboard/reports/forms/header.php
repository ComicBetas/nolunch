<?php
defined('C5_EXECUTE') or die("Access Denied.");


if ($supportsLegacy) { ?>

    <a href="<?php echo URL::to('/dashboard/reports/forms/legacy')?>" class="btn btn-default"><?php echo t('Legacy Forms')?></a>

<?php } ?>