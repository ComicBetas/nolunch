<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<div id="ccm-block-express-entry-detail-edit">

    <div class="form-group">
        <?php echo $form->label('entryMode', t('Entry'))?>
        <?php echo $form->select('entryMode', [
            'E' => t('Get entry from list block on another page'),
            'S' => t('Display specific entry'),
            'A' => t('Get entry from custom attribute on this page'),
            ], $entryMode);
        ?>
    </div>

    <div class="form-group" data-container="express-entity">
        <?php echo $form->label('exEntityID', t('Entity'))?>
        <?php echo $form->select('exEntityID', $entities, $exEntityID, [
            'data-action' => $view->action('load_entity_data')
        ]);?>
    </div>


    <div class="form-group" data-container="express-entry-specific-entry">
        <?php if (is_object($entity)) {
            $form_selector = \Core::make('form/express/entry_selector');
            print $form_selector->selectEntry($entity, 'exSpecificEntryID', $entry);
        } else { ?>
            <p><?php echo t('You must select an entity before you can choose a specific entry from it.')?></p>
        <?php } ?>
    </div>

    <div class="form-group" data-container="express-entry-custom-attribute">
        <?php echo $form->label('akID', t('Express Entry Attribute'))?>
        <?php if (count($expressAttributes)) { ?>
        <select name="exEntryAttributeKeyHandle" class="form-control">
            <option value=""><?php echo t('** Select Attribute')?></option>
            <?php foreach($expressAttributes as $ak) {
                $settings = $ak->getAttributeKeySettings();
                ?>
                <option data-entity-id="<?php echo $settings->getEntity()->getID()?>" <?php if ($ak->getAttributeKeyHandle() == $exEntryAttributeKeyHandle) { ?>selected="selected" <?php } ?> value="<?php echo $ak->getAttributeKeyHandle()?>"><?php echo $ak->getAttributeKeyDisplayName()?></option>
            <?php } ?>
        </select>
        <?php } else { ?>
            <p><?php echo t('There are no express entity page attributes defined.')?></p>
        <?php } ?>
    </div>

    <div class="form-group">
        <?php echo $form->label('exFormID', t('Display Data in Entity Form'))?>
        <div data-container="express-entry-detail-form">
            <?php if (is_object($entity)) { ?>
                <select name="exFormID" class="form-control">
                    <?php foreach($entity->getForms() as $form) { ?>
                        <option <?php if ($exFormID == $form->getID()) { ?>selected="selected" <?php } ?> value="<?php echo $form->getID()?>"><?php echo $form->getName()?></option>
                    <?php } ?>
                </select>
            <?php } else { ?>
                <?php echo t('You must select an entity before you can choose its display form.')?>
            <?php } ?>
        </div>

    </div>


</div>

<script type="text/template" data-template="express-attribute-form-list">
    <select name="exFormID" class="form-control">
    <% _.each(forms, function(form) { %>
        <option value="<%=form.exFormID%>" <% if (exFormID == form.exFormID) { %>selected<% } %>><%=form.exFormName%></option>
    <% }); %>
    </select>
</script>



<script type="application/javascript">
    Concrete.event.publish('block.express_entry_detail.open', {
        exFormID: '<?php echo $exFormID?>'
    });
</script>