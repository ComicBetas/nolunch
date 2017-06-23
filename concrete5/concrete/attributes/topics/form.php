<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="ccm-topic-attribute-wrapper">
	<script type="text/javascript">
	$(function() {
		var treeObj = $('.tree-view-template_<?php echo $akID ?>');
		treeObj.concreteTree({
			'treeID': '<?php echo $treeID ?>',
			'treeNodeParentID': '<?php echo $parentNode ?>',
			'chooseNodeInForm': 'multiple',
			'allowFolderSelection': false,
			'selectNodesByKey': [<?php echo $valueIDs ?>],
			'selectMode': '2',
			'minExpandLevel': '1',
			'checkbox': true,
			'onSelect' : function(nodes) {
				var element = $('.topics_<?php echo $akID ?> .hidden-value-container');
				element.html('');
				$.each(nodes, function(i, node) {
					$('.topics_<?php echo $akID ?> .hidden-value-container').append('<input data-node-id="' + node + '" name="topics_<?php echo $akID ?>[]" type="hidden" value="'+node+'">');
				});
             }
		});
	});
	</script>
	<div class="topics_<?php echo $akID ?>">
		<div class="tree-view-template_<?php echo $akID?>">
		</div>
		<div class="dynamic-container">
		</div>
		<div class="hidden-value-container">
		<?php
        if (is_array($valueIDArray)) {
            foreach ($valueIDArray as $vID) {
                ?>
				<input data-node-id="<?php echo $vID?>" type="hidden" name="topics_<?php echo $akID ?>[]" value="<?php echo $vID ?>">
		<?php 
            }
        } ?>
		</div>
	</div>
</div>