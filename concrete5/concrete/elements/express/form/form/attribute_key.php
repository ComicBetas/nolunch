<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="form-group">
    <label class="control-label" for="<?php echo $key->getController()->getLabelID() ?>"><?php echo $label?>
        <?php

        if ($control->isRequired()) {
            print $renderer->getRequiredHtmlElement();
        }
        ?>
    </label>

    <?php echo $key->render(new \Concrete\Core\Attribute\Context\StandardFormContext(), $value)?>
</div>
