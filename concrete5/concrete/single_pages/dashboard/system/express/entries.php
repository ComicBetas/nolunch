<?php defined('C5_EXECUTE') or die("Access Denied.");

$jh = Core::make('helper/json');
?>

<?php if (is_object($tree)) {
    ?>
	<div data-tree="<?php echo $tree->getTreeID()?>">
	</div>

	<script type="text/javascript">
	$(function() {

		$('[data-tree]').concreteTree({
			'treeID': '<?php echo $tree->getTreeID()?>'
		});

	});
	</script>

    <?php
} ?>