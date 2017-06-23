<?php
defined('C5_EXECUTE') or die("Access Denied.");

$headline = '';
$body = '';
if (isset($control)) {
    $headline = $control->getHeadline();
    $body = $control->getBody();
}
?>

<div class="form-group">
    <?php echo $form->label('headline', t('Headline'))?>
    <?php echo $form->text('headline', $headline)?>
</div>
<div class="form-group">
    <?php echo $form->label('body', t('Body'))?>
    <?php
    $editor = Core::make('editor');
    print $editor->outputStandardEditor('body', $body);
    ?>
</div>
