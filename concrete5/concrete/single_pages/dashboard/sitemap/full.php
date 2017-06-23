<?php defined('C5_EXECUTE') or die("Access Denied.");

$sh = Loader::helper('concrete/dashboard/sitemap');
?>

<?php if ($sh->canRead()) { ?>

<?php
$u = new User();
if ($u->isSuperUser()) {
    if (Queue::exists('copy_page')) {
        $q = Queue::get('copy_page');
        if ($q->count() > 0) { ?>
		<div class="alert alert-warning">
			<?php echo t('Page copy operations pending.')?>
			<button class="btn btn-xs btn-default pull-right" onclick="ConcreteSitemap.refreshCopyOperations()"><?php echo t('Resume Copy')?></button>
		</div>
	<?php }
    }
}
    ?>

<div id="ccm-full-sitemap-container"></div>
<hr/>

<section>
	<div class="checkbox">
    	<label>
    		<input type="checkbox" name="includeSystemPages" <?php if ($includeSystemPages) { ?>checked<?php } ?> value="1" />
    		<?php echo t('Include System Pages in Sitemap')?>
    	</label>
	</div>
</section>

<?php
} else {
?>
<p><?php echo t("You do not have access to the sitemap."); ?></p>
<?php
}
?>

<script>
$(function() {
    $('div#ccm-full-sitemap-container').concreteSitemap({
        siteTreeID: <?php echo $site->getSiteTreeID()?>,
        includeSystemPages: $('input[name=includeSystemPages]').is(':checked')
    });

    $('input[name=includeSystemPages]').on('click', function() {
        var $tree = $('div#ccm-full-sitemap-container div.ccm-sitemap-tree');
        $tree.fancytree('destroy');

        $('#ccm-full-sitemap-container').html('').concreteSitemap({
            siteTreeID: <?php echo $site->getSiteTreeID()?>,
            includeSystemPages: $('input[name=includeSystemPages]').is(':checked')
        });
    });
});
</script>
