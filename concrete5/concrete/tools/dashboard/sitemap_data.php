<?php

defined('C5_EXECUTE') or die("Access Denied.");

$dh = Core::make('helper/concrete/dashboard/sitemap');
if (!$dh->canRead()) {
    die(t("Access Denied."));
}

/*
if (isset($_REQUEST['selectedPageID'])) {
    if (strstr($_REQUEST['selectedPageID'], ',')) {
        $sanitizedPageID = preg_replace('/[^0-9,]/', '', $_REQUEST['selectedPageID']);
        $sanitizedPageID = preg_replace('/\s/', '', $sanitizedPageID);
    } else {
        $sanitizedPageID = intval($_REQUEST['selectedPageID']);
    }
    $dh->setSelectedPageID($sanitizedPageID);
}

if (isset($_REQUEST['task']) && $_REQUEST['task'] == 'save_sitemap_display_mode') {
    $u = new User();
    $u->saveConfig('SITEMAP_OVERLAY_DISPLAY_MODE', $_REQUEST['display_mode']);
    exit;
}
*/

if (isset($_REQUEST['displayNodePagination']) && $_REQUEST['displayNodePagination']) {
    $dh->setDisplayNodePagination(true);
} else {
    $dh->setDisplayNodePagination(false);
}

if (isset($_GET['includeSystemPages']) && $_GET['includeSystemPages']) {
    $dh->setIncludeSystemPages(true);
} else {
    $dh->setIncludeSystemPages(false);
}

$cParentID = (isset($_REQUEST['cParentID'])) ? $_REQUEST['cParentID'] : 0;
if (isset($_REQUEST['displaySingleLevel']) && $_REQUEST['displaySingleLevel']) {
    $c = Page::getByID($cParentID);
    $parent = Page::getByID($c->getCollectionParentID());
    if (is_object($parent) && !$parent->isError()) {
        $n = $dh->getNode($parent->getCollectionID());
        $n->icon = 'fa fa-angle-double-up';
        $n->expanded = true;
        $n->displaySingleLevel = true;

        $p = $dh->getNode($cParentID);
        $p->expanded = true;
        $p->children = $dh->getSubNodes($cParentID);
        $n->children = array($p);
    } else {
        $n = $dh->getNode($cParentID);
        $n->children = $dh->getSubNodes($cParentID);
    }
    $nodes[] = $n;
    echo json_encode([
        'children' => $nodes,
    ]);
} else {
    if (isset($_COOKIE['ConcreteSitemap-expand'])) {
        $openNodeArray = explode(',', str_replace('_', '', $_COOKIE['ConcreteSitemap-expand']));
        if (is_array($openNodeArray)) {
            $dh->setExpandedNodes($openNodeArray);
        }
    }
    if ($cParentID || (isset($_REQUEST['reloadNode']) && $_REQUEST['reloadNode'])) {
        $nodes = $dh->getSubNodes($cParentID);
        echo json_encode($nodes);
    } else {
        $service = \Core::make('site');
        if (isset($_REQUEST['siteTreeID']) && $_REQUEST['siteTreeID'] > 0) {
            $tree = $service->getSiteTreeByID($_REQUEST['siteTreeID']);
        } else {
            $tree = $service->getActiveSiteForEditing()->getSiteTreeObject();
        }
        $nodes = $dh->getSubNodes($tree);
        $locales = null;
        if ($tree instanceof \Concrete\Core\Entity\Site\SiteTree) {
            $locales = $tree->getLocaleCollection();
        }

        echo json_encode([
            'children' => $nodes,
            'locales' => $locales
        ]);
    }
}

