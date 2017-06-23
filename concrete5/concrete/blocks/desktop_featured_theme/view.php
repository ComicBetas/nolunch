<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php if (is_object($remoteItem)) { ?>

	<div class="ccm-block-desktop-featured-theme">
		<div class="ccm-block-desktop-featured-theme-inner">

			<img src="<?php echo $remoteItem->getLargeThumbnail()->src?>" style="height: 250px" />

			<div class="ccm-block-desktop-featured-theme-description">

				<h6><?php echo t('Featured Theme')?></h6/>

				<h3><?php echo $remoteItem->getName()?></h3>
				<p><?php echo $remoteItem->getDescription()?></p>
				<div class="btn-group">
					<a href="<?php echo $remoteItem->getRemoteURL()?>" class="btn btn-info"><?php echo $remoteItem->getDisplayPrice()?></a>
					<a href="<?php echo $remoteItem->getRemoteURL()?>" class="btn btn-info"><?php echo t('Learn More')?></a>
				</div>
			</div>

		</div>
	</div>

<?php } ?>