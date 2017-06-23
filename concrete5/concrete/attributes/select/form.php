<?php defined('C5_EXECUTE') or die("Access Denied.");

/*
 * Checkbox list.
 */
if ($akSelectAllowMultipleValues && !$akSelectAllowOtherValues) {
    $form = Loader::helper('form');
    $options = $controller->getOptions();
    foreach ($options as $opt) {
        ?>

		<div class="checkbox"><label>
				<?php echo $form->checkbox($view->field('atSelectOptionValue') . '[]', $opt->getSelectAttributeOptionID(), in_array($opt->getSelectAttributeOptionID(), $selectedOptionIDs));
        ?>
				<?php echo $opt->getSelectAttributeOptionDisplayValue()?>
			</label>
		</div>


	<?php
    }
}

/*
 * Select Menu.
 */
if (!$akSelectAllowMultipleValues && !$akSelectAllowOtherValues) {
    $form = Loader::helper('form');
    $options = array('' => t('** None'));
    foreach ($controller->getOptions() as $option) {
        $options[$option->getSelectAttributeOptionID()] = $option->getSelectAttributeOptionDisplayValue();
    }
    ?>
	<?php echo $form->select($view->field('atSelectOptionValue'), $options, empty($selectedOptionIDs) ? '' : $selectedOptionIDs[0]);
    ?>


<?php
}

/*
 * Select2
 */
if ($akSelectAllowOtherValues) {


    ?>
	<input type="hidden" data-select-and-add="<?php echo $akID?>" style="width: 100%" name="<?php echo $view->field('atSelectOptionValue')?>" value="<?php echo $value?>" />
	<script type="text/javascript">
		$(function() {
			$('input[data-select-and-add=<?php echo $akID?>]').selectize({
                plugins: ['remove_button'],
				valueField: 'id',
				labelField: 'text',
				options: <?php echo json_encode($selectedOptions)?>,
				items: <?php echo json_encode($selectedOptionIDs)?>,
				openOnFocus: false,
				create: true,
				createFilter: function(input) {
					return input.length >= 1;
				},

				maxOptions: 10,

				<?php if ($akSelectAllowMultipleValues) {
    ?>
					delimiter: ',',
					maxItems: 500,
				<?php
} else {
    ?>
					maxItems: 1,
				<?php
}
    ?>
				load: function(query, callback) {
					if (!query.length) return callback();
					$.ajax({
						url: "<?php echo $view->action('load_autocomplete_values')?>",
						dataType: 'json',
						error: function() {
							callback();
						},
						success: function(res) {
							callback(res);
						}
					});
				}
			});
		});
	</script>

<?php
}
