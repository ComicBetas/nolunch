<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php if ($control->getHeadline()) { ?>
    <h3><?php echo $control->getHeadline()?></h3>
<?php } ?>
<?php if ($control->getBody()) { ?>
    <?php echo $control->getBody()?>
<?php } ?>
