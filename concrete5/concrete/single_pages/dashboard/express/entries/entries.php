<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-dashboard-content-full">

<?php if ($list->getTotalResults()) { ?>


        <div class="table-responsive">
            <?php View::element('express/entries/search', array('controller' => $searchController)) ?>
        </div>

    <script type="text/javascript">
        $(function() {
            ConcreteEvent.subscribe('SelectExpressEntry', function(e, data) {
                var url = '<?php echo $view->action('view_entry', 'ENTRY_ID')?>';
                url = url.replace('ENTRY_ID', data.exEntryID);
                if (data.event.metaKey) {
                    window.open(url);
                } else {
                    window.location.href = url;
                }
            });
        });
    </script>

    <?php
} else {
    ?>

    <div class="ccm-dashboard-content-full-inner">

    <p><?php echo t('None created yet.') ?></p>

        </div>

    <?php
} ?>

</div>
