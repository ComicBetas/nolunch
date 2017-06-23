<?php
defined('C5_EXECUTE') or die("Access Denied.");

$app = Concrete\Core\Support\Facade\Facade::getFacadeApplication();

$dh = $app->make('helper/concrete/dashboard');

if (isset($cp) && $cp->canViewToolbar() && (!$dh->inDashboard())) {
    $cih = $app->make('helper/concrete/ui');
    $ihm = $app->make('helper/concrete/ui/menu');
    $valt = $app->make('helper/validation/token');
    $config = $app->make('config');
    $dateHelper = $app->make('helper/date');
    $token = '&' . $valt->getParameter();
    $cID = $c->getCollectionID();
    $permissions = new Permissions($c);
    
    $workflowList = \Concrete\Core\Workflow\Progress\PageProgress::getList($c);
    
    $show_titles = (bool) $config->get('concrete.accessibility.toolbar_titles');
    $show_tooltips = (bool) $config->get('concrete.accessibility.toolbar_tooltips');
    $large_font = (bool) $config->get('concrete.accessibility.toolbar_large_font');
    
    $canApprovePageVersions = $cp->canApprovePageVersions();
    $vo = $c->getVersionObject();
    $pageInUseBySomeoneElse = false;

    if ($c->isCheckedOut()) {
        if (!$c->isCheckedOutByMe()) {
            $pageInUseBySomeoneElse = true;
        }
    }

    if (!$c->isEditMode()) {
        echo $app->make('helper/concrete/ui/help')->displayHelpDialogLauncher();
    }

    
    if ($cih->showHelpOverlay()) {
        print '<div style="display: none">';
        View::element('help/dialog/introduction');
        print '</div>';
        $v = View::getInstance();
        $v->addFooterItem('<script type="text/javascript">$(function() { new ConcreteHelpDialog().open(); });</script>');
        $cih->trackHelpOverlayDisplayed();
    }

    ?>
    <div id="ccm-page-controls-wrapper" class="ccm-ui">
        <div id="ccm-toolbar" class="<?php echo $show_titles ? 'titles' : '' ?> <?php echo $large_font ? 'large-font' : '' ?>">
            <div class="ccm-mobile-menu-overlay">
                <div class="ccm-mobile-menu-main">
                    <ul class="ccm-mobile-menu-entries">
                        <?php
                        if (!$pageInUseBySomeoneElse && $c->getCollectionPointerID() == 0) {
                            if ($c->isEditMode()) {
                                ?>
                                <li class="ccm-toolbar-page-edit-mode-active ccm-toolbar-page-edit">
                                    <i class="fa fa-pencil mobile-leading-icon"></i>
                                    <a
                                        <?php if ($c->isMasterCollection()) { ?>data-disable-panel="check-in"<?php } ?>
                                        data-toolbar-action="check-in"
                                        <?php
                                        if ($vo->isNew() && !$c->isMasterCollection()) {
                                            ?>
                                            href="javascript:void(0)"
                                            data-launch-panel="check-in"
                                            ><?php echo t('Save Changes') ?><?php
                                        } else {
                                            ?>
                                            href="<?php echo URL::to('/ccm/system/page/check_in', $cID, $valt->generate()) ?>"
                                            data-panel-url="<?php echo URL::to('/ccm/system/panels/page/check_in') ?>"
                                            ><?php echo t('Save Changes') ?><?php
                                        }
                                        ?>
                                    </a>
                                </li>
                                <?php
                            } elseif ($permissions->canEditPageContents()) {
                                ?>
                                <li class="ccm-toolbar-page-edit">
                                    <i class="fa fa-pencil mobile-leading-icon"></i>
                                    <a
                                        <?php if ($c->isMasterCollection()) { ?>data-disable-panel="check-in"<?php } ?>
                                        data-toolbar-action="check-out"
                                        href="<?php echo DIR_REL ?>/<?php echo DISPATCHER_FILENAME ?>?cID=<?php echo $cID ?>&ctask=check-out<?php echo $token ?>"
                                    ><?php echo t('Edit this Page') ?></a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="parent-ul">
                                <i class="fa fa-cog mobile-leading-icon"></i>
                                <a href="#"><?php echo t('Page Properties') ?><i class="fa fa-caret-down"></i></a>
                                <ul class="list-unstyled">
                                    <?php
                                    $pagetype = PageType::getByID($c->getPageTypeID());
                                    if (is_object($pagetype) && $cp->canEditPageContents()) {
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="640"
                                                dialog-height="640"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('Composer') ?>"
                                                href="<?php echo URL::to('/ccm/system/panels/details/page/composer') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('Composer') ?></a>
                                        </li>
                                        <?php
                                    }
                                    if (
                                        $permissions->canEditPageProperties() ||
                                        $permissions->canEditPageTheme() ||
                                        $permissions->canEditPageTemplate() ||
                                        $permissions->canDeletePage() ||
                                        $permissions->canEditPagePermissions()
                                    ) {
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="640"
                                                dialog-height="360"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('SEO') ?>"
                                                href="<?php echo URL::to('/ccm/system/panels/details/page/seo') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('SEO') ?></a>
                                        </li>
                                        <?php
                                    }
                                    if ($permissions->canEditPageProperties()) {
                                        if ($cID > 1) {
                                            ?>
                                            <li>
                                                <a
                                                    class="dialog-launch"
                                                    dialog-width="500"
                                                    dialog-height="500"
                                                    dialog-modal="false"
                                                    dialog-title="<?php echo t('Location') ?>"
                                                    href="<?php echo URL::to('/ccm/system/panels/details/page/location') ?>?cID=<?php echo $cID ?>"
                                                ><?php echo t('Location'); ?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="90%"
                                                dialog-height="70%"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('Attributes') ?>"
                                                href="<?php echo URL::to('/ccm/system/dialogs/page/attributes') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('Attributes') ?></a>
                                        </li>
                                        <?php
                                    }
                                    if ($permissions->canEditPageSpeedSettings()) {
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="550"
                                                dialog-height="280"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('Caching') ?>"
                                                href="<?php echo URL::to('/ccm/system/panels/details/page/caching') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('Caching') ?></a>
                                        </li>
                                        <?php
                                    }
                                    if ($permissions->canEditPagePermissions()) {
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="500"
                                                dialog-height="630"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('Permissions') ?>"
                                                href="<?php echo URL::to('/ccm/system/panels/details/page/permissions') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('Permissions') ?></a>
                                        </li>
                                        <?php
                                    }
                                    if ($permissions->canEditPageTheme() || $permissions->canEditPageTemplate()) {
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="350"
                                                dialog-height="250"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('Design') ?>"
                                                href="<?php echo URL::to('/ccm/system/dialogs/page/design') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('Design') ?></a>
                                        </li>
                                        <?php
                                    }
                                    if ($permissions->canViewPageVersions()) {
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="640"
                                                dialog-height="340"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('Versions') ?>"
                                                href="<?php echo URL::to('/ccm/system/panels/page/versions') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('Versions') ?></a>
                                        </li>
                                        <?php
                                    }
                                    if ($permissions->canDeletePage()) {
                                        ?>
                                        <li>
                                            <a
                                                class="dialog-launch"
                                                dialog-width="360"
                                                dialog-height="250"
                                                dialog-modal="false"
                                                dialog-title="<?php echo t('Delete') ?>"
                                                href="<?php echo URL::to('/ccm/system/dialogs/page/delete') ?>?cID=<?php echo $cID ?>"
                                            ><?php echo t('Delete') ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        if ($dh->canRead()) {
                            ?>
                            <li class="parent-ul">
                                <?php
                                $dashboardMenu = new \Concrete\Controller\Element\Navigation\DashboardMobileMenu();
                                $dashboardMenu->render();
                                ?>
                            </li>
                            <?php
                        }
                        ?>
                        <li>
                            <i class="fa fa-sign-out mobile-leading-icon"></i>
                            <a href="<?php echo URL::to('/login', 'logout', $valt->generate('logout')); ?>"><?php echo t('Sign Out'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="ccm-toolbar-item-list">
                <li class="ccm-logo pull-left"><span><?php echo $cih->getToolbarLogoSRC() ?></span></li>
                <?php
                if ($c->isMasterCollection()) {
                    ?>
                    <li class="pull-left">
                        <a href="<?php echo URL::to('/dashboard/pages/types/output', $c->getPageTypeID()); ?>">
                            <i class="fa fa-arrow-left"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-edit-mode"><?php echo tc('toolbar', 'Exit Edit Defaults'); ?></span>
                         </a>
                     </li>
                     <?php
                }
                if (!$pageInUseBySomeoneElse && $c->getCollectionPointerID() == 0) {
                    if ($c->isEditMode()) {
                        ?>
                        <li data-guide-toolbar-action="check-in" class="ccm-toolbar-page-edit-mode-active ccm-toolbar-page-edit pull-left hidden-xs">
                            <a
                                <?php if ($c->isMasterCollection()) { ?>data-disable-panel="check-in"<?php } ?>
                                data-toolbar-action="check-in"
                                <?php
                                if ($vo->isNew() || $c->isPageDraft()) {
                                    ?>href="javascript:void(0)" data-launch-panel="check-in"<?php
                                } else {
                                    ?>href="<?php echo URL::to('/ccm/system/page/check_in', $cID, $valt->generate()) ?>"<?php
                                }
                                ?>
                                data-panel-url="<?php echo URL::to('/ccm/system/panels/page/check_in') ?>"
                                title="<?php echo t('Exit Edit Mode') ?>"
                            >
                                <i class="fa fa-pencil"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-edit-mode"><?php echo tc('toolbar', 'Exit Edit Mode') ?></span>
                            </a>
                        </li>
                        <?php
                    } elseif ($permissions->canEditPageContents()) {
                        ?>
                        <li data-guide-toolbar-action="edit-page" class="ccm-toolbar-page-edit pull-left hidden-xs">
                            <a <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?> data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }'
                                <?php if ($c->isMasterCollection()) { ?>data-disable-panel="check-in"<?php } ?>
                                data-toolbar-action="check-out"
                                href="<?php echo DIR_REL ?>/<?php echo DISPATCHER_FILENAME ?>?cID=<?php echo $cID ?>&ctask=check-out<?php echo $token ?>"
                                title="<?php echo t('Edit This Page') ?>"
                            >
                                <i class="fa fa-pencil"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-edit-mode"><?php echo tc('toolbar', 'Edit Mode') ?></span>
                            </a>
                        </li>
                        <?php
                    }
                    if (
                        !$c->isMasterCollection() && (
                            $permissions->canEditPageProperties() ||
                            $permissions->canEditPageTheme() ||
                            $permissions->canEditPageTemplate() ||
                            $permissions->canDeletePage() ||
                            $permissions->canEditPagePermissions()
                        )
                    ) {
                        $hasComposer = is_object($pagetype) && $cp->canEditPageContents();
                        ?>
                        <li data-guide-toolbar-action="page-settings" class="pull-left hidden-xs">
                            <a <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?> data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }'
                                href="#"
                                data-launch-panel="page"
                                data-panel-url="<?php echo URL::to('/ccm/system/panels/page') ?>"
                                <?php
                                if ($hasComposer) {
                                    ?>title="<?php echo t('Composer, Page Design, Location, Attributes and Settings') ?>"><?php
                                } else {
                                    ?>title="<?php echo t('Page Design, Location, Attributes and Settings') ?>"><?php
                                }
                                ?>

                                <i class="fa fa-cog"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-settings"><?php
                                    if ($hasComposer) {
                                        ?><?php echo tc('toolbar', 'Composer') ?> / <?php
                                    }
                                    ?><?php echo tc('toolbar', 'Page Settings') ?></span>
                            </a>
                        </li>
                        <?php
                    }
                }

                if ($cp->canEditPageContents() && (!$pageInUseBySomeoneElse)) {
                    ?>
                    <li data-guide-toolbar-action="add-content" class="ccm-toolbar-add pull-left hidden-xs">
                        <?php if ($c->isEditMode()) { ?>
                            <a href="#" data-launch-panel="add-block" data-panel-url="<?php echo URL::to('/ccm/system/panels/add') ?>" title="<?php echo t('Add Content to The Page') ?>">
                                <i class="fa fa-plus"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-add"><?php echo tc('toolbar', 'Add Content') ?></span>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo DIR_REL ?>/<?php echo DISPATCHER_FILENAME ?>?cID=<?php echo $cID ?>&ctask=check-out-add-block<?php echo $token ?>" <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?> data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }' title="<?php echo t('Add Content to The Page') ?>">
                                <i class="fa fa-plus"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-add"><?php echo tc('toolbar', 'Add Content') ?></span>
                            </a>
                        <?php } ?>
                    </li>
                    <?php
                }

                $items = $ihm->getPageHeaderMenuItems('left');
                foreach ($items as $ih) {
                    $cnt = $ih->getController();
                    if ($cnt->displayItem()) {
                        $cnt->registerViewAssets();
                        ?>
                        <li class="pull-left hidden-xs"><?php echo $cnt->getMenuItemLinkElement() ?></li>
                        <?php
                    }
                }

                if ($cih->showWhiteLabelMessage()) {
                    ?>
                    <li class="pull-left visible-xs visible-lg" id="ccm-white-label-message"><?php echo t('Powered by <a href="%s">concrete5</a>.', $config->get('concrete.urls.concrete5')) ?></li>
                    <?php
                }
                ?>
                <li class="pull-right ccm-toolbar-mobile-menu-button visible-xs hidden-sm hidden-md hidden-lg<?php echo $c->isEditMode() ? ' ccm-toolbar-mobile-menu-button-active' : ''?>">
                    <i class="fa fa-bars fa-2"></i>
                </li>
                <?php
                if ($dh->canRead()) {
                    ?>
                    <li data-guide-toolbar-action="dashboard" class="pull-right hidden-xs ">
                        <a <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?> data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }' href="<?php echo URL::to('/dashboard') ?>" data-launch-panel="dashboard" title="<?php echo t('Dashboard – Change Site-wide Settings') ?>">
                            <i class="fa fa-sliders"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-site-settings"><?php echo tc('toolbar', 'Dashboard') ?></span>
                        </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="pull-right hidden-xs">
                        <a <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?> data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }' href="<?php echo URL::to('/login', 'logout', $valt->generate('logout'))?>" title="<?php echo t('Sign Out')?>">
                            <i class="fa fa-sign-out"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-site-settings"><?php echo tc('toolbar', 'Sign Out') ?></span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li data-guide-toolbar-action="sitemap" class="pull-right hidden-xs">
                    <a <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?> data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }' href="#" data-panel-url="<?php echo URL::to('/ccm/system/panels/sitemap') ?>" title="<?php echo t('Add Pages and Navigate Your Site') ?>" data-launch-panel="sitemap">
                        <i class="fa fa-files-o"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-add-page"><?php echo tc('toolbar', 'Pages') ?></span>
                    </a>
                </li>
                <?php
                $items = $ihm->getPageHeaderMenuItems('right');
                foreach ($items as $ih) {
                    $cnt = $ih->getController();
                    if ($cnt->displayItem()) {
                        $cnt->registerViewAssets();
                        ?>
                        <li class="pull-right hidden-xs"><?php echo $cnt->getMenuItemLinkElement() ?></li>
                        <?php
                    }
                }
                ?>
                <li data-guide-toolbar-action="intelligent-search" class="ccm-toolbar-search pull-right hidden-xs">
                    <i class="fa fa-search"></i>
                    <input type="search" id="ccm-nav-intelligent-search" autocomplete="off" tabindex="1"/>
                </li>
            </ul>
        </div>
        <?php

        echo $dh->getIntelligentSearchMenu();

        if ($pageInUseBySomeoneElse) {
            echo $cih->notify(array(
                'title' => t('Editing Unavailable.'),
                'text' => t("%s is currently editing this page.", $c->getCollectionCheckedOutUserName()),
                'type' => 'info',
                'icon' => 'fa fa-exclamation-circle',
            ));
        } else {
            if ($c->getCollectionPointerID() > 0) {
                $buttons = array();
                $buttons[] = '<a href="' . DIR_REL . '/' . DISPATCHER_FILENAME . '?cID=' . $cID . '" class="btn btn-default btn-xs">' . t('View/Edit Original') . '</a>';
                if ($canApprovePageVersions) {
                    $url = URL::to('/ccm/system/dialogs/page/delete_alias?cID=' . $c->getCollectionPointerOriginalID());
                    $buttons[] = '<a href="' . $url . '" dialog-title="' . t('Remove Alias') . '" class="dialog-launch btn btn-xs btn-danger">' . t('Remove Alias') . '</a>';
                }
                echo $cih->notify(array(
                    'title' => t('Page Alias.'),
                    'text' => t("This page is an alias of one that actually appears elsewhere."),
                    'type' => 'info',
                    'icon' => 'fa fa-info-circle',
                    'buttons' => $buttons,
                ));
            }
            $hasPendingPageApproval = false;

            if (is_array($workflowList) && !empty($workflowList)) {
                ?>
                    <?php
                    foreach ($workflowList as $i => $wl) {
                        $wr = $wl->getWorkflowRequestObject();
                        $wf = $wl->getWorkflowObject();
                        $form = '<form data-form="workflow" method="post" action="' . $wl->getWorkflowProgressFormAction() . '">';
                        $text = $wf->getWorkflowProgressCurrentDescription($wl);

                        $actions = $wl->getWorkflowProgressActions();
                        $buttons = [];
                        if (!empty($actions)) { ?>
                            <?php
                            foreach ($actions as $act) {
                                $parameters = 'class="btn btn-xs ' . $act->getWorkflowProgressActionStyleClass() . '" ';
                                if (!empty($act->getWorkflowProgressActionExtraButtonParameters())) {
                                    foreach ($act->getWorkflowProgressActionExtraButtonParameters() as $key => $value) {
                                        $parameters .= $key . '="' . $value . '" ';
                                    }
                                }

                                $inner = $act->getWorkflowProgressActionStyleInnerButtonLeftHTML() . ' ' .
                                $act->getWorkflowProgressActionLabel() . ' ' .
                                $act->getWorkflowProgressActionStyleInnerButtonRightHTML();

                                if ($act->getWorkflowProgressActionURL() != '') {
                                    $button = '<a href="' . $act->getWorkflowProgressActionURL() . '" ' . $parameters . '>' . $inner . '</a>';
                                } else {
                                    $button = '<button type="submit" name="action_' . $act->getWorkflowProgressActionTask() . '" ' . $parameters . '>' . $inner . '</button>';
                                }

                                $buttons[] = $button;
                            }
                        }

                        echo $cih->notify(array(
                            'text' => $text,
                            'type' => 'info',
                            'form' => $form,
                            'icon' => 'fa fa-info-circle',
                            'buttons' => $buttons
                        ));
                    }
                    ?>
                <?php
            }

            if (!$c->getCollectionPointerID() && (!is_array($workflowList) || empty($workflowList))) {
                if (is_object($vo)) {
                    if (!$vo->isApproved() && !$c->isEditMode()) {
                        if ($c->isPageDraft()) {
                            echo $cih->notify(array(
                                'title' => t('Page Draft.'),
                                'text' => t("This is an un-published draft."),
                                'type' => 'info',
                                'icon' => 'fa fa-exclamation-circle',
                            ));
                        } else {
                            $buttons = array();
                            if ($canApprovePageVersions && !$c->isCheckedOut()) {
                                $pk = \Concrete\Core\Permission\Key\PageKey::getByHandle('approve_page_versions');
                                $pk->setPermissionObject($c);
                                $pa = $pk->getPermissionAccessObject();
                                $workflows = array();
                                if (is_object($pa)) {
                                    $workflows = $pa->getWorkflows();
                                }
                                $canApproveWorkflow = true;
                                foreach ($workflows as $wf) {
                                    if (!$wf->canApproveWorkflow()) {
                                        $canApproveWorkflow = false;
                                    }
                                }
                                if (!empty($workflows) && !$canApproveWorkflow) {
                                    $appLabel = t('Submit to Workflow');
                                }
                                if (!isset($appLabel) || !$appLabel) {
                                    $appLabel = t('Approve Version');
                                }
                                $buttons[] = '<a href="' . DIR_REL . '/' . DISPATCHER_FILENAME . '?cID=' . $cID . '&ctask=approve-recent' . $token . '" class="btn btn-primary btn-xs">' . $appLabel . '</a>';
                            }
                            echo $cih->notify(array(
                                'title' => t('Page is Pending Approval.'),
                                'text' => t("This page is newer than what appears to visitors on your live site."),
                                'type' => 'info',
                                'icon' => 'fa fa-cog',
                                'buttons' => $buttons,
                            ));
                        }
                    } else {
                        $publishDate = $vo->getPublishDate();
                        if ($publishDate) {
                            $date = $dateHelper->formatDate($publishDate);
                            $time = $dateHelper->formatTime($publishDate);
                            $message = t(/*i18n: %1$s is a date, %2$s is a time */'This version of the page is scheduled to be published on %1$s at %2$s.', $date, $time);
                            $button = '<a href="' . DIR_REL . '/' . DISPATCHER_FILENAME . '?cID=' . $cID . '&ctask=publish-now' . $token . '" class="btn btn-primary btn-xs">' . t('Publish Now') . '</a>';
                            echo $cih->notify(array(
                                'title' => t('Publish Pending.'),
                                'text' => $message,
                                'type' => 'info',
                                'icon' => 'fa fa-cog',
                                'buttons' => array($button),
                            ));
                        }
                    }
                }
            }
        }
    ?>
    </div>
    <?php
}
