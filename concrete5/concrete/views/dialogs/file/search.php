<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div data-search="files" class="ccm-ui">

	<?php
	$header->render();
	?>

	<?php Loader::element('files/search', array('result' => $result))?>

</div>

<script type="text/javascript">
$(function() {
	$('div[data-search=files]').concreteFileManager({
		result: <?php echo json_encode($result->getJSONObject())?>,
		selectMode: 'choose',
		upload_token: '<?php echo Core::make('token')->generate()?>'
	});
});
</script>