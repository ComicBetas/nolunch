<?php
defined('C5_EXECUTE') or die("Access Denied.");
$composer = Core::make("helper/concrete/composer");
?>

<div class="ccm-ui">
    <form data-dialog-form="add-page-compose" action="<?php echo $controller->action('submit')?>">
        <?php $pagetype->renderComposerOutputForm(null, $parent); ?>
        <input type="hidden" name="addPageComposeAction" value="preview" />
        <div class="dialog-buttons">
            <button type="button" data-dialog-action="cancel" class="btn btn-default pull-left"><?php echo t('Cancel')?></button>
            <div class="btn-group pull-right">
                <button style="margin-right: 0;" type="button" data-composer-dialog-action="publish" value="publish" class="btn btn-primary"><?php echo t('Publish Page')?>
                <button style="padding-right: 5px; padding-left: 5px; width: 35px;" data-page-type-composer-form-btn="schedule" type="button" class="btn btn-primary">
                    <i class="fa fa-clock-o"></i>
                </button>

            </button>
                </div>
            <button type="button" data-dialog-action="submit" value="preview" data-page-type-composer-form-btn="preview" class="btn btn-success pull-right"><?php echo t('Edit Mode')?></button>
        </div>
    </form>
</div>

<div style="display: none">
    <div data-dialog="schedule-page">

        <?php $composer->displayPublishScheduleSettings(); ?>

    </div>
</div>


<script type="text/javascript">
    $(function() {
        $('form[data-dialog-form=add-page-compose]').concreteAjaxForm();
        $('button[data-composer-dialog-action=publish]').on('click', function() {
            $('form[data-dialog-form=add-page-compose] input[name=addPageComposeAction]').val('publish');
            $('form[data-dialog-form=add-page-compose]').submit();
        });
        ConcreteEvent.unsubscribe('AjaxFormSubmitSuccess.addPageCompose');
        ConcreteEvent.subscribe('AjaxFormSubmitSuccess.addPageCompose', function(e, data) {
            if (data.response.cParentID) {
                ConcreteEvent.publish('SitemapAddPageRequestComplete', {'cParentID': data.response.cParentID});
            }
        });

        $('button[data-page-type-composer-form-btn=schedule]').on('click', function() {
            jQuery.fn.dialog.open({
                element: 'div[data-dialog=schedule-page]',
                modal: true,
                width: 460,
                title: '<?php echo t('Schedule Publishing')?>',
                height: 'auto',
                onOpen: function() {
                    $('.ccm-check-in-schedule').on('click', function() {
                        var data = $('form[data-dialog-form=add-page-compose]').serializeArray();

                        var data = data.concat($('div[data-dialog=schedule-page] :input').serializeArray());
                        data.push({'name': 'addPageComposeAction', 'value': 'schedule'});
                        $.concreteAjax({
                            data: data,
                            url: '<?php echo $controller->action('submit')?>',
                            success: function(r) {
                                ConcreteEvent.fire('AjaxFormSubmitSuccess', {
                                    response: r
                                });
                            }
                        });
                    });
                }
            });
        });

    });
</script>
