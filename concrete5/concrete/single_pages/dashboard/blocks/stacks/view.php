<?php
defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Workflow\Progress\PageProgress as PageWorkflowProgress;
use Concrete\Core\Block\View\BlockView;
use Concrete\Core\Page\Stack\Stack;

/* @var Concrete\Core\Html\Service\Html $html */
/* @var Concrete\Core\Application\Service\UserInterface $interface */
/* @var Concrete\Core\Application\Service\Dashboard $dashboard */
/* @var Concrete\Core\Validation\CSRF\Token $token */
/* @var Concrete\Core\Form\Service\Form $form */
/* @var Concrete\Core\Page\View\PageView $view */
/* @var Concrete\Controller\SinglePage\Dashboard\Blocks\Stacks $controller */
/* @var Concrete\Core\Page\Page $c */


if (isset($neutralStack)) {
    /* @var Stack $neutralStack */
    /* @var Stack|null $stackToEdit */
    /* @var bool $isGlobalArea */
    ?>
    <div class="ccm-dashboard-header-buttons">
        <?php if ($isGlobalArea) { ?>
            <a href="<?php echo URL::to('/dashboard/blocks/stacks', 'view_global_areas')?>" class="btn btn-default"><i class="fa fa-angle-double-left"></i> <?php echo t("Back to Global Areas")?></a>
        <?php } else { ?>
            <a href="<?php echo $view->action('view_details', $neutralStack->getCollectionParentID())?>" class="btn btn-default"><i class="fa fa-angle-double-left"></i> <?php echo t("Back to Stacks")?></a>
        <?php } ?>
    </div>
    <p class="lead"><?php echo h($neutralStack->getCollectionName())?></p>
    <?php
    if ($stackToEdit === null) {
        ?>
        <form method="post" action="<?php echo $view->action('add_localized_stack')?>">
            <?php echo $token->output('add_localized_stack')?>
            <?php echo $form->hidden('stackID', $neutralStack->getCollectionID());?>
            <?php echo $form->hidden('locale', $localeCode);?>
            <div class="alert alert-info">
                <p>
                    <?php echo t(/*i18n: %1$s is a language name, %2$s is a language code*/'This stack is not defined for %1$s (%2$s): the default version will be used.', $localeName, $localeCode); ?>
                </p>
                <p>
                    <button class="btn btn-primary" type="submit"><?php echo $isGlobalArea ? t('Create localized global area version') : t('Create localized stack version')?></button><br />
                </p>
            </div>
        </form>
        <?php
    } else {
        $cpc = new Permissions($stackToEdit);
        $showApprovalButton = false;
        $hasPendingPageApproval = false;
        $workflowList = PageWorkflowProgress::getList($stackToEdit);
        foreach ($workflowList as $wl) {
            $wr = $wl->getWorkflowRequestObject();
            $wrk = $wr->getWorkflowRequestPermissionKeyObject();
            if ($wrk->getPermissionKeyHandle() == 'approve_page_versions') {
                $hasPendingPageApproval = true;
                break;
            }
        }

        if (!$hasPendingPageApproval) {
            $vo = $stackToEdit->getVersionObject();
            $composer = Core::make('helper/concrete/composer');
            if ($cpc->canApprovePageVersions()) {
                $publishTitle = $composer->getPublishButtonTitle($stackToEdit);
                $showApprovalButton = true;
            }
        }
        $deleteLabels = null;
        ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo t('Add Block')?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dialog-launch" dialog-modal="false" dialog-width="550" dialog-height="380" dialog-title="<?php echo t('Add Block')?>" href="<?php echo URL::to('/ccm/system/dialogs/page/add_block_list')?>?cID=<?php echo $stackToEdit->getCollectionID()?>&arHandle=<?php echo STACKS_AREA_NAME?>"><?php echo t('Add Block')?></a></li>
                            <li><a class="dialog-launch" dialog-modal="false" dialog-width="550" dialog-height="380" dialog-title="<?php echo t('Paste From Clipboard')?>" href="<?php echo URL::to('/ccm/system/dialogs/page/clipboard')?>?cID=<?php echo $stackToEdit->getCollectionID()?>&arHandle=<?php echo STACKS_AREA_NAME?>"><?php echo t('Paste From Clipboard')?></a></li>
                        </ul>
                    </li>
                    <li><a dialog-width="640" dialog-height="340" class="dialog-launch" id="stackVersions" dialog-title="<?php echo t('Version History')?>" href="<?php echo URL::to('/ccm/system/panels/page/versions')?>?cID=<?php echo $stackToEdit->getCollectionID()?>"><?php echo t('Version History')?></a></li>
                    <?php if (!$isGlobalArea && $cpc->canEditPageProperties()) { ?>
                        <li><a href="<?php echo $view->action('rename', $neutralStack->getCollectionID())?>"><?php echo t('Rename')?></a></li>
                    <?php } ?>
                    <?php if (!$isGlobalArea && $cpc->canEditPagePermissions() && Config::get('concrete.permissions.model') == 'advanced') { ?>
                        <li><a dialog-width="580" class="dialog-launch" dialog-append-buttons="true" dialog-height="420" dialog-title="<?php echo t('Stack Permissions')?>" id="stackPermissions" href="<?php echo REL_DIR_FILES_TOOLS_REQUIRED?>/edit_area_popup?cID=<?php echo $stackToEdit->getCollectionID()?>&arHandle=<?php echo STACKS_AREA_NAME?>&atask=groups"><?php echo t('Permissions')?></a></li>
                    <?php } ?>
                    <?php if (!$isGlobalArea && $cpc->canMoveOrCopyPage()) { ?>
                        <li><a href="<?php echo $view->action('duplicate', $neutralStack->getCollectionID())?>" style="margin-right: 4px;"><?php echo t('Duplicate Stack')?></a></li>
                    <?php } ?>
                    <li>
                        <a dialog-width="640" dialog-height="340" class="dialog-launch" id="stackUsage" dialog-title="<?php echo t('Stack Usage')?>" href="<?php echo $view->action('usage', $stackToEdit->getCollectionID()) ?>">
                   <?php echo t('Stack Usage')?>
                    </a>
                    </li>
                    <?php
                    if ($cpc->canDeletePage()) {
                        if ($isGlobalArea) {
                            if ($stackToEdit !== $neutralStack) {
                                $deleteLabels = ['title' => t('Delete localized version'), 'button' => t('Delete')];
                                ?><li><a href="javascript:void(0)" data-dialog="delete-stack"><span class="text-danger"><?php echo t('Delete localized Global Area')?></span></a></li><?php
                            } else {
                                $deleteLabels = ['title' => t('Clear Global Area contents'), 'button' => t('Clear area'), 'canUndo' => true];
                                ?><li><a href="javascript:void(0)" data-dialog="delete-stack"><span class="text-danger"><?php echo t('Clear Global Area')?></span></a></li><?php
                            }
                        } else {
                            if ($stackToEdit !== $neutralStack) {
                                $deleteLabels = ['title' => t('Delete localized version'), 'button' => t('Delete')];
                                ?><li><a href="javascript:void(0)" data-dialog="delete-stack"><span class="text-danger"><?php echo t('Delete localized Stack')?></span></a></li><?php
                            } else {
                                $deleteLabels = ['title' => t('Delete Stack'), 'button' => t('Delete')];
                                ?><li><a href="javascript:void(0)" data-dialog="delete-stack"><span class="text-danger"><?php echo t('Delete Stack')?></span></a></li><?php
                            }
                        }
                    }
                    ?>
                </ul>
                <?php if ($showApprovalButton) { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li id="ccm-stack-list-approve-button" class="navbar-form" <?php if ($vo->isApproved()) { ?> style="display: none;" <?php } ?>>
                            <button class="btn btn-success" onclick="window.location.href='<?php echo URL::to('/dashboard/blocks/stacks', 'approve_stack', $stackToEdit->getCollectionID(), $token->generate('approve_stack'))?>'"><?php echo $publishTitle?></button>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </nav>

        <div id="ccm-stack-container">
            <?php
            $a = Area::get($stackToEdit, STACKS_AREA_NAME);
            $a->forceControlsToDisplay();
            View::element('block_area_header', array('a' => $a));
            foreach ($blocks as $b) {
                $bv = new BlockView($b);
                $bv->setAreaObject($a);
                $p = new Permissions($b);
                if ($p->canViewBlock()) {
                    $bv->render('view');
                }
            }
            //View::element('block_area_footer', array('a' => $a));
            print '</div>';
            // No, we don't include the footer because we don't want all area controls available.
            // But the footer element has a closing DIV we need.
            ?>
        </div>

        <?php
        if ($deleteLabels !== null) {
            ?>
            <div style="display: none">
                <div id="ccm-dialog-delete-stack" class="ccm-ui">
                    <form method="post" class="form-stacked" style="padding-left: 0px" action="<?php echo $view->action('delete_stack')?>">
                        <?php echo $token->output('delete_stack')?>
                        <input type="hidden" name="stackID" value="<?php echo $stackToEdit->getCollectionID()?>" />
                        <p><?php
                            if (isset($deleteLabels['canUndo']) && $deleteLabels['canUndo']) {
                                echo t('Are you sure you want to proceed?');
                            } else {
                                echo t('Are you sure? This action cannot be undone.');
                            }
                        ?></p>
                    </form>
                    <div class="dialog-buttons">
                        <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                        <button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-delete-stack form').submit()"><?php echo $deleteLabels['button']?></button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <script type="text/javascript">
var showApprovalButton = function() {
    $('#ccm-stack-list-approve-button').show().addClass("animated fadeIn");
};

$(function() {
    var ConcreteEvent = Concrete.event;

    ConcreteEvent.on('ClipboardAddBlock', function(event, data) {
        var editor = Concrete.getEditMode();
        var area = editor.getAreaByID(<?php echo $a->getAreaID()?>);
        block = new Concrete.DuplicateBlock(data.$launcher, editor);
        block.addToDragArea(_.last(area.getDragAreas()));
        return false;
    });

    ConcreteEvent.on('AddBlockListAddBlock', function(event, data) {
        var editor = Concrete.getEditMode();
        var area = editor.getAreaByID(<?php echo $a->getAreaID()?>);
        blockType = new Concrete.BlockType(data.$launcher, editor);
        blockType.addToDragArea(_.last(area.getDragAreas()));
        return false;
    });

    ConcreteEvent.on('EditModeAddClipboardComplete', function(event, data) {
        showApprovalButton();
        Concrete.getEditMode().scanBlocks();
    });

    ConcreteEvent.on('EditModeAddBlockComplete', function(event, data) {
        showApprovalButton();
        Concrete.getEditMode().scanBlocks();
    });

    ConcreteEvent.on('EditModeUpdateBlockComplete', function(event, data) {
        showApprovalButton();
        Concrete.getEditMode().scanBlocks();
    });

    ConcreteEvent.on('EditModeBlockDeleteAfterComplete', function(event, data) {
        showApprovalButton();
        _.defer(function() {
            Concrete.getEditMode().scanBlocks();
        });
    });

    ConcreteEvent.on('EditModeBlockMove', function(event, data) {
        showApprovalButton();
        Concrete.getEditMode().scanBlocks();
    });

    <?php
    if ($deleteLabels !== null) {
        ?>
        $('a[data-dialog=delete-stack]').on('click', function() {
            jQuery.fn.dialog.open({
               element: '#ccm-dialog-delete-stack',
               modal: true,
               width: 320,
               title: <?php echo json_encode($deleteLabels['title'])?>,
               height: 'auto'
            });
        });
        <?php
    }
    ?>
});
        </script>
        <?php
    }
} elseif (isset($duplicateStack)) {
    /* @var Stack $duplicateStack */
    $sv = CollectionVersion::get($duplicateStack, 'ACTIVE');
    ?>
    <form name="duplicate_form" action="<?php echo $view->action('duplicate', $duplicateStack->getCollectionID())?>" method="POST">
        <?php echo $token->output('duplicate_stack')?>
        <legend><?php echo t('Duplicate Stack')?></legend>
        <div class="form-group">
            <?php echo $form->label('stackName', t("Name"))?>
            <?php echo $form->text('stackName', $duplicateStack->getStackName())?>
        </div>
        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <a href="<?php echo $view->action('view_details', $duplicateStack->getCollectionID())?>" class="btn btn-default"><?php echo t('Cancel')?></a>
                <button type="submit" class="btn pull-right btn-primary"><?php echo t('Duplicate')?></button>
            </div>
        </div>
    </form>
    <?php
} elseif (isset($renamePage)) {
    /* @var Concrete\Core\Page\Page $renamePage */
    /* @var bool $isFolder */
    /* @var string $oldName */
    $sv = CollectionVersion::get($renamePage, 'ACTIVE');
    ?>
    <form action="<?php echo $view->action('rename', $renamePage->getCollectionID())?>" method="POST">
        <legend><?php echo $isFolder ? t('Rename Stack Folder') : t('Rename Stack')?></legend>
        <?php echo $token->output('rename_stack')?>
        <div class="form-group">
            <?php echo $form->label('newName', t("Name"))?>
            <?php echo $form->text('newName', $oldName)?>
        </div>
        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <a href="<?php echo $view->action('view_details', $renamePage->getCollectionID())?>" class="btn btn-default"><?php echo t('Cancel')?></a>
                <button type="submit" class="btn pull-right btn-primary"><?php echo t('Rename')?></button>
            </div>
        </div>
    </form>
    <?php
} else {
    if (!isset($showGlobalAreasFolder)) {
        $showGlobalAreasFolder = false;
    }
    if (!isset($canMoveStacks)) {
        $canMoveStacks = false;
    }
    /* @var Concrete\Core\Page\Stack\StackList $list */
    /* @var Concrete\Core\Page\Page[] $stacks */
    if ($showGlobalAreasFolder || !empty($stacks)) {
        $dh = Core::make('date');
        /* @var Concrete\Core\Localization\Service\Date $dh */
        ?>
        <div class="ccm-dashboard-content-full">
            <div class="table-responsive">
                <table class="ccm-search-results-table ccm-search-results-table-icon">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="<?php echo $list->getSortClassName('cv.cvName')?>"><a href="<?php echo $list->getSortURL('cv.cvName')?>"><?php echo t('Name')?></a></th>
                            <th class="<?php echo $list->getSortClassName('c.cDateAdded')?>"><a href="<?php echo $list->getSortURL('c.cDateAdded')?>"><?php echo t('Date Added')?></a></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($showGlobalAreasFolder) {
                            ?>
                            <tr class="ccm-search-results-folder ccm-search-results-globalareafolder" data-details-url="<?php echo $view->url('/dashboard/blocks/stacks', 'view_global_areas')?>">
                                <td class="ccm-search-results-icon"><i class="fa fa-object-group"></i></td>
                                <td class="ccm-search-results-name"><?php echo t('Global Areas')?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                        foreach ($stacks as $st) {
                            $formatter = new Concrete\Core\Page\Stack\Formatter($st);
                            ?>
                            <tr class="<?php echo $formatter->getSearchResultsClass()?>" data-details-url="<?php echo $view->url('/dashboard/blocks/stacks', 'view_details', $st->getCollectionID())?>" data-collection-id="<?php echo $st->getCollectionID()?>">
                                <td class="ccm-search-results-icon"><?php echo $formatter->getIconElement()?></td>
                                <td class="ccm-search-results-name"><?php echo h($st->getCollectionName())?></td>
                                <td><?php echo $dh->formatDateTime($st->getCollectionDateAdded())?></td>
                                <td class="ccm-search-results-menu-launcher">
                                    <?php if ($st->getCollectionTypeHandle() == STACK_CATEGORY_PAGE_TYPE) { ?>
                                        <a href="#" data-launch-stack-menu="<?php echo $st->getCollectionID()?>"><i class="fa fa-share"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
$(function() {
    var $tbody = $('table.ccm-search-results-table tbody');
    $tbody.find('>tr').each(function() {
        var $this = $(this), className = $this.attr('class');
        $this
            .hover(
                function() {
                    $this.addClass('ccm-search-select-hover');
                },
                function() {
                    $this.removeClass('ccm-search-select-hover');
                }
            )
            .on('click', function() {
                window.location.href = $this.data('details-url');
            })
            <?php if ($canMoveStacks) { ?>
                .not('.ccm-search-results-globalareafolder')
                    .draggable({
                        delay: 300,
                        start: function() {
                            $this.addClass('ccm-stack-folder-dragging');
                            $('.ccm-undroppable-search-item').css('opacity', '0.4');
                        },
                        stop: function() {
                            $('.ccm-undroppable-search-item').css('opacity', '');
                        },
                        revert: 'invalid',
                        helper: function() {
                            var $selected = $this.add($tbody.find('.ccm-stack-folder-dragging'));
                            return $('<div class="' + className + ' ccm-draggable-search-item"><span>' + $selected.length + '</span></div>').data('$selected', $selected);
                        },
                        cursorAt: {
                            left: -20,
                            top: 5
                        }
                    })
                .end()
            <?php } ?>
        ;
    });
    <?php if ($canMoveStacks) { ?>
        $('.ccm-droppable-search-item').droppable({
            accept: '.ccm-search-results-stackfolder, .ccm-search-results-stack',
            //activeClass: 'ui-state-highlight',
            hoverClass: 'ccm-search-select-active-droppable',
            drop: function(event, ui) {
                var $sourceItems = ui.helper.data('$selected'),
                    sourceIDs = [],
                    destinationID = $(this).data('collection-id')
                ;
                $sourceItems.each(function() {
                    var $sourceItem = $(this);
                    var sourceID = $sourceItem.data('collection-id');
                    if (sourceID == destinationID) {
                        $sourceItems = $sourceItems.not(this);
                    } else {
                        sourceIDs.push($(this).data('collection-id'));
                    }
                });
                if (sourceIDs.length === 0) {
                    return;
                }
                $sourceItems.hide();
                new ConcreteAjaxRequest({
                    url: <?php echo json_encode($view->action('move_to_folder'))?>,
                    data: {
                        ccm_token:<?php echo json_encode($token->generate('move_to_folder'))?>,
                        sourceIDs: sourceIDs,
                        destinationID: destinationID
                    },
                    success: function(msg) {
                        $sourceItems.remove();
                        ConcreteAlert.notify({
                            message: msg
                        });
                    },
                    error: function(xhr) {
                        $sourceItems.show();
                        var msg = xhr.responseText;
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            msg = xhr.responseJSON.errors.join("<br/>");
                        }
                        ConcreteAlert.dialog(<?php echo json_encode(t('Error'))?>, msg);
                    }
                });
            }
        });
    <?php } ?>
   	$('[data-launch-stack-menu]').concreteStackMenu({menu: '#ccm-stackfolders-menu'});
});
        </script>

        <div class="ccm-popover-page-menu popover fade" id="ccm-stackfolders-menu">
        	<div class="arrow"></div>
        	<div class="popover-inner">
        		<ul class="dropdown-menu">
					<li><a data-action="rename" href="#" data-href-template="<?php echo $view->action('rename', '__folderID__')?>"><?php echo t('Rename Folder')?></a></li>
					<li><a data-action="delete" href="javascript:void(0)"><?php echo t('Delete Folder')?></a></li>
				</ul>
			</div>
		</div>

		<div style="display: none">
    		<div id="ccm-dialog-delete-stackfolder" class="ccm-ui" title="<?php echo t('Delete Folder')?>">
    			<form method="post" class="form-stacked" style="padding-left: 0px" action="<?php echo $view->action('delete_stackfolder')?>">
    				<?php echo $token->output('delete_stackfolder')?>
    				<input type="hidden" name="stackfolderID" />
    				<p><?php echo t('Are you sure? This action cannot be undone.');?></p>
    			</form>
    			<div class="dialog-buttons">
    				<button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
    				<button class="btn btn-danger pull-right" onclick="$('#ccm-dialog-delete-stackfolder form').submit()"><?php echo t('Delete Folder')?></button>
    			</div>
    		</div>
    	</div>

        <?php
    } else {
        ?><div class="alert alert-info"><?php
            if ($controller->getTask() == 'view_global_areas') {
                echo t('No global areas have been added.');
            } else {
                echo t('No stacks found in this folder.');
            }
        ?></div><?php
    }
    ?>
    <div class="ccm-dashboard-header-buttons">
        <?php
        if ($controller->getTask() != 'view_global_areas') {
            ?>
            <div class="btn-group">
                <button data-dialog="add-stack" class="btn btn-default"><i class="fa fa-bars"></i> <?php echo t("New Stack")?></button>
                <button data-dialog="add-folder" class="btn btn-default"><i class="fa fa-folder"></i> <?php echo t("New Folder")?></button>
            </div>
            <?php
        }
        ?>
    </div>

    <div style="display: none">
        <div id="ccm-dialog-add-stack" class="ccm-ui">
            <form method="post" class="form-stacked" style="padding-left: 0px" action="<?php echo $view->action('add_stack')?>">
                <?php echo $token->output('add_stack')?>
                <?php echo $form->hidden('stackFolderID', isset($currentStackFolderID) ? $currentStackFolderID : '');?>
                <div class="form-group">
                    <?php echo $form->label('stackName', t('Stack Name'))?>
                    <?php echo $form->text('stackName')?>
                </div>
            </form>
            <div class="dialog-buttons">
                <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                <button class="btn btn-primary pull-right" onclick="$('#ccm-dialog-add-stack form').submit()"><?php echo t('Add Stack')?></button>
            </div>
        </div>
        <div id="ccm-dialog-add-folder" class="ccm-ui">
            <form method="post" class="form-stacked" style="padding-left: 0px" action="<?php echo $view->action('add_folder')?>">
                <?php echo $token->output('add_folder')?>
                <?php echo $form->hidden('stackFolderID', isset($currentStackFolderID) ? $currentStackFolderID : '');?>
                <div class="form-group">
                    <?php echo $form->label('folderName', t('Folder Name'))?>
                    <?php echo $form->text('folderName')?>
                </div>
            </form>
            <div class="dialog-buttons">
                <button class="btn btn-default pull-left" onclick="jQuery.fn.dialog.closeTop()"><?php echo t('Cancel')?></button>
                <button class="btn btn-primary pull-right" onclick="$('#ccm-dialog-add-folder form').submit()"><?php echo t('Add Folder')?></button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
$(function() {

    $('button[data-dialog=add-stack]').on('click', function() {
        jQuery.fn.dialog.open({
            element: '#ccm-dialog-add-stack',
            modal: true,
            width: 320,
            title: <?php echo json_encode(t("Add Stack"))?>,
            height: 'auto'
        });
    });
    $('button[data-dialog=add-folder]').on('click', function() {
        jQuery.fn.dialog.open({
            element: '#ccm-dialog-add-folder',
            modal: true,
            width: 320,
            title: <?php echo json_encode(t("Add Folder"))?>,
            height: 'auto'
        });
    });
});
    </script>
    <?php
}

if (isset($flashMessage)) {
    ?><script>
    $(document).ready(function() {
        ConcreteAlert.notify({
            message: <?php echo json_encode($flashMessage)?>
        });
    });
    </script><?php
}
