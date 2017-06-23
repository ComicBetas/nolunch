<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<p><?php echo t('You are currently logged in as <strong>%s</strong>', $profile->getUserDisplayName())?>. <a href="<?php echo URL::to('/')?>"><?php echo t('Return to Previous Page.')?></a></p>

<hr/>

<?php $a = new Area("Main"); $a->display($c); ?>

<?php
$profileURL = $profile->getUserPublicProfileURL();
if ($profileURL) {
    ?>
    <hr/>
    <div>
        <a href="<?php echo $profileURL?>"><?php echo t("View Public Profile")?></a>
        <p><?php echo t('View your public user profile and the information you are sharing.')?></p>
    </div>


    <?php
} ?>