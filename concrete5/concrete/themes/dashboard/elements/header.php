<?php defined('C5_EXECUTE') or die('Access Denied.');

if (Request::getInstance()->get('_ccm_dashboard_external')) {
    return;
}
$html = Core::make('helper/html');
/* @var Concrete\Core\Html\Service\Html $html */

$valt = Core::make('helper/validation/token');
/* @var Concrete\Core\Validation\CSRF\Token $valt */

if (!isset($hideDashboardPanel)) {
    $hideDashboardPanel = false;
}

?><!DOCTYPE html>
<html<?php echo $hideDashboardPanel ? '' : ' class="ccm-panel-open ccm-panel-right"'; ?>>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/main.css" />
<?php
$v = View::getRequestInstance();
$v->requireAsset('dashboard');
$v->requireAsset('javascript-localized', 'core/localization');
$v->addFooterItem('<script type="text/javascript">$(function() { ConcreteToolbar.start(); });</script>');
if (Config::get('concrete.misc.enable_progressive_page_reindex') && Config::get('concrete.misc.do_page_reindex_check')) {
    $v->addFooterItem('<script type="text/javascript">$(function() { ccm_doPageReindexing(); });</script>');
}
if (Localization::activeLanguage() != 'en') {
    $v->addFooterItem($html->javascript('i18n/ui.datepicker-'.Localization::activeLanguage().'.js'));
}

$v->addHeaderItem('<meta name="viewport" content="width=device-width, initial-scale=1">');
View::element('header_required', array('disableTrackingCode' => true));
$v->addFooterItem('<script type="text/javascript">$(function() { ConcreteDashboard.start(); });</script>');

$u = new User();
$frontendPageID = $u->getPreviousFrontendPageID();
if (!$frontendPageID) {
    $backLink = DIR_REL . '/';
} else {
    $backLink = DIR_REL . '/' . DISPATCHER_FILENAME . '?cID=' . $frontendPageID;
}

$show_titles = (bool) Config::get('concrete.accessibility.toolbar_titles');
$show_tooltips = (bool) Config::get('concrete.accessibility.toolbar_tooltips');
$large_font = (bool) Config::get('concrete.accessibility.toolbar_large_font');

?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:900' rel='stylesheet' type='text/css'>
</head>
<body <?php if (isset($bodyClass)) { ?>class="<?php echo $bodyClass?>"<?php } ?>>

<div id="ccm-dashboard-page" class="<?php if ($view->section('/account')) { ?>ccm-dashboard-my-account<?php } ?> ccm-ui">
    <div class="ccm-mobile-menu-overlay ccm-mobile-menu-overlay-dashboard hidden-md hidden-lg">
        <div class="ccm-mobile-menu-main">
            <ul class="ccm-mobile-menu-entries">
                <li>
                    <?php
                    $dashboardMenu = new \Concrete\Controller\Element\Navigation\DashboardMobileMenu($c);
                    $dashboardMenu->render();
                    ?>
                </li>
                <li>
                    <i class="fa fa-sign-out mobile-leading-icon"></i><a href="<?php echo URL::to('/login', 'logout', $valt->generate('logout')); ?>"><?php echo t('Sign Out'); ?></a>
                </li>
            </ul>
        </div>
    </div>
<div id="ccm-toolbar" class="<?php echo $show_titles ? 'titles' : '' ?> <?php echo $large_font ? 'large-font' : '' ?>">
    <ul>
        <li class="ccm-logo pull-left"><span><?php echo Loader::helper('concrete/ui')->getToolbarLogoSRC()?></span></li>
        <li class="ccm-toolbar-account pull-left">
            <a <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?> data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }' title="<?php echo t('Back to Website') ?>"
               href="<?php echo $backLink?>">
                <i class="fa fa-arrow-left"></i><span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-return"><?php echo tc('toolbar', 'Return to Website') ?></span>
            </a>
        </li>
        <?php
        $ihm = Core::make("helper/concrete/ui/menu");
        $cih = Core::make('helper/concrete/ui');
        $items = $ihm->getPageHeaderMenuItems('left');
        foreach ($items as $ih) {
            $cnt = $ih->getController();
            if ($cnt->displayItem()) {
                $cnt->registerViewAssets();
                ?>
                <li class="pull-left"><?php echo $cnt->getMenuItemLinkElement() ?></li>
                <?php
            }
        }

        if ($cih->showWhiteLabelMessage()) {
            ?>
            <li class="pull-left visible-xs visible-lg" id="ccm-white-label-message"><?php echo t('Powered by <a href="%s">concrete5</a>.', Config::get('concrete.urls.concrete5')) ?></li>
            <?php
        }
        ?>

        <li class="pull-right hidden-xs hidden-sm">
            <?php
                $dashboardPanelClasses = array();
                if ($show_tooltips) {
                    $dashboardPanelClasses[] = 'launch-tooltip';
                }
                if (!$hideDashboardPanel) {
                    $dashboardPanelClasses[] = 'ccm-launch-panel-active';
                }
                $dashboardPanelClass = implode(' ', $dashboardPanelClasses);
            ?>
            <a class="<?php echo $dashboardPanelClass?>" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }' href="<?php echo URL::to('/dashboard') ?>" title="<?php echo t('Dashboard – Change Site-wide Settings') ?>"
                data-launch-panel="dashboard"
                data-panel-url="<?php echo URL::to('/system/panels/dashboard')?>">
                <i class="fa fa-sliders"></i>
                <span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-site-settings">
                    <?php echo tc('toolbar', 'Dashboard') ?>
                </span>
            </a>
        </li>
        <li class="pull-right hidden-xs hidden-sm">
            <a <?php if ($show_tooltips) { ?>class="launch-tooltip"<?php } ?>  data-toggle="tooltip" data-placement="bottom" data-delay='{ "show": 500, "hide": 0 }' href="#" data-panel-url="<?php echo URL::to('/ccm/system/panels/sitemap') ?>" title="<?php echo t('Add Pages and Navigate Your Site') ?>" data-launch-panel="sitemap">
                <i class="fa fa-files-o"></i>
                <span class="ccm-toolbar-accessibility-title ccm-toolbar-accessibility-title-add-page">
                    <?php echo tc('toolbar', 'Pages') ?>
                </span>
            </a>
        </li>
        <li class="ccm-toolbar-search pull-right hidden-xs hidden-sm">
            <i class="fa fa-search"></i>
            <input type="search" autocomplete="off" id="ccm-nav-intelligent-search" tabindex="1" />
        </li>
        <li class="pull-right ccm-toolbar-mobile-menu-button visible-xs visible-sm hidden-md hidden-lg">
            <i class="fa fa-bars"></i>
        </li>
        <?php
        $items = $ihm->getPageHeaderMenuItems('right');
        foreach ($items as $ih) {
            $cnt = $ih->getController();
            if ($cnt->displayItem()) {
                $cnt->registerViewAssets();
                ?>
                <li class="pull-right"><?php echo $cnt->getMenuItemLinkElement() ?></li>
                <?php
            }
        }
        ?>
    </ul>
</div>
<?php
$dh = Core::make('helper/concrete/dashboard');
echo $dh->getIntelligentSearchMenu();

if (!$hideDashboardPanel) {
    ?>
    <div id="ccm-panel-dashboard" class="hidden-xs hidden-sm ccm-panel ccm-panel-right ccm-panel-transition-slide ccm-panel-active ccm-panel-loaded">
        <div class="ccm-panel-content-wrapper ccm-ui">
            <div class="ccm-panel-content ccm-panel-content-visible">
                <?php
                $cnt = new \Concrete\Controller\Panel\Dashboard();
    $cnt->setPageObject($c);
    $cnt->view();
    $nav = $cnt->get('nav');
    $tab = $cnt->get('tab');
    $ui = $cnt->get('ui');
    View::element(
                    'panels/dashboard',
                    array(
                        'nav' => $nav,
                        'tab' => $tab,
                        'ui' => $ui,
                        'c' => $c,
                    )
                );
    ?>
            </div>
        </div>
    </div>
    <?php
}
?>

<div id="ccm-dashboard-content" class="container-fluid">
