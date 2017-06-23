<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<?php
$color = Core::make('helper/form/color');
echo Core::make('helper/concrete/ui')->tabs(array(
    array('search', t('Source & Search'), true),
    array('results', t('Results')),
    array('design', t('Design'))
));
?>

<div class="ccm-tab-content" id="ccm-tab-content-search">

    <div class="form-group">
        <?php echo $form->label('exEntityID', t('Entity'))?>
        <?php echo $form->select('exEntityID', $entities, $exEntityID, [
            'data-action' => $view->action('load_entity_data')
        ]);?>
    </div>

    <div class="form-group">
        <div class="checkbox"><label>
                <?php echo $form->checkbox('enableSearch', 1, $enableSearch, array('data-options-toggle' => 'search'))?>
                <?php echo t('Enable Search')?>
            </label>
        </div>
    </div>

    <fieldset data-options="search">

        <div class="form-group">
            <label class="control-label"><?php echo t("Keyword Search")?></label>
            <div class="checkbox"><label>
                    <?php echo $form->checkbox('enableKeywordSearch', 1, $enableKeywordSearch)?>
                    <?php echo t('Search by Keywords')?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo t("Enable Searching by Attributes")?></label>

            <div data-container="advanced-search">

            </div>
        </div>
    </fieldset>

</div>

<div class="ccm-tab-content" id="ccm-tab-content-results">

    <div class="form-group">
        <?php echo $form->label('displayLimit', t('Items Per Page'))?>
        <?php echo $form->text('displayLimit', $displayLimit)?>
    </div>

    <div class="form-group">
        <label class="control-label" for="detailPage"><?php echo t("Link to Detail Page")?></label>
        <?php echo Core::make('helper/form/page_selector')->selectPage('detailPage', $detailPage)?>

        <div data-container="linked-attributes">

        </div>
    </div>


    <div data-container="customize-results">
        <?php if ($customizeElement) { ?>
            <?php $customizeElement->render() ?>
        <?php } else {  ?>
            <?php echo t('You must choose an entity before you can customize its search results.') ?>
        <?php } ?>
    </div>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-design">

    <fieldset>
        <div class="form-group">
            <?php echo $form->label('tableName', t('Name'))?>
            <?php echo $form->text('tableName', $tableName, array('maxlength' => '128'))?>
        </div>
        <div class="form-group">
            <?php echo $form->label('tableDescription', t('Description'))?>
            <?php echo $form->text('tableDescription', $tableDescription, array('maxlength' => '128'))?>
        </div>
    </fieldset>

    <fieldset>
        <legend><?php echo t('Design')?></legend>
        <div class="form-group">
            <?php echo $form->label('headerBackgroundColor', t('Header Background'))?>
            <div>
                <?php echo $color->output('headerBackgroundColor', $headerBackgroundColor)?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label('headerBackgroundColorActiveSort', t('Header Background (Active Sort)'))?>
            <div>
                <?php echo $color->output('headerBackgroundColorActiveSort', $headerBackgroundColorActiveSort)?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label('headerTextColor', t('Header Text Color'))?>
            <div>
                <?php echo $color->output('headerTextColor', $headerTextColor)?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label('', t('Table Striping'))?>
            <div class="radio">
                <label>
                    <?php echo $form->radio('tableStriped', 0, $tableStriped)?>
                    <?php echo t('Off (all rows the same color)')?>
                </label>
            </div>
            <div class="radio">
                <label>
                    <?php echo $form->radio('tableStriped', 1, $tableStriped)?>
                    <?php echo t('On (change color of alternate rows)')?>
                </label>
            </div>
        </div>

        <div class="form-group" data-options="table-striped">
            <?php echo $form->label('rowBackgroundColorAlternate', t('Alternate Row Background Color'))?>
            <div>
                <?php echo $color->output('rowBackgroundColorAlternate', $rowBackgroundColorAlternate)?>
            </div>
        </div>
    </fieldset>

</div>

<script type="text/template" data-template="express-attribute-search-list">
    <% _.each(attributes, function(attribute) { %>
    <div class="checkbox"><label>
        <input type="checkbox" name="searchProperties[]" value="<%=attribute.akID%>"
           <% var akID = attribute.akID + ''; %>
            <% if (_.contains(selected, akID)) { %> checked<% } %>>
        <%=attribute.akName%>
        </label>
    </div>
    <% }); %>
</script>

<script type="text/template" data-template="express-attribute-link-list">
    <% _.each(attributes, function(attribute) { %>
    <div class="checkbox"><label>
            <input type="checkbox" name="linkedProperties[]" value="<%=attribute.akID%>"
            <% var akID = attribute.akID + ''; %>
            <% if (_.contains(selected, akID)) { %> checked<% } %>>
            <%=attribute.akName%>
        </label>
    </div>
    <% }); %>
</script>


<script type="application/javascript">
    Concrete.event.publish('block.express_entry_list.open', {
        'searchProperties': <?php echo json_encode($searchProperties)?>,
        'searchPropertiesSelected': <?php echo json_encode($searchPropertiesSelected)?>,
        'linkedPropertiesSelected': <?php echo json_encode($linkedPropertiesSelected)?>
    });
</script>