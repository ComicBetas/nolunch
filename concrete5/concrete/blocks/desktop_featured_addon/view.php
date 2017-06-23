<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php if (is_object($remoteItem)) { ?>

<div class="ccm-block-desktop-featured-addon">
	<div class="ccm-block-desktop-featured-addon-inner">

	<h6><?php echo t('Featured Add-On')?></h6/>

	<img src="<?php echo $remoteItem->getRemoteIconURL()?>" width="80" height="80" />
	<h3><?php echo $remoteItem->getName()?></h3>
	<p><?php echo $remoteItem->getDescription()?></p>
	<a href="<?php echo $remoteItem->getRemoteURL()?>" class="btn btn-default btn-lg"><?php echo t('Learn More')?></a>

	</div>
</div>

<?php } ?>