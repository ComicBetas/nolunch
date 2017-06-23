<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
?>

<header class="ccm-dashboard-page-header">
    <?php if (isset($_bookmarked)) { ?>
        <a href="#" class="ccm-dashboard-page-header-bookmark" data-page-id="<?php echo $c->getCollectionID()?>" data-token="<?php echo $token->generate('access_bookmarks')?>" data-bookmark-action="<?php if ($_bookmarked) { ?>remove-favorite<?php } else { ?>add-favorite<?php } ?>">
            <?php if ($_bookmarked) { ?>
                <i class="fa fa-lg fa-bookmark"></i>
            <?php } else { ?>
                <i class="fa fa-lg fa-bookmark-o"></i>
            <?php } ?>
        </a>
    <?php } ?>
    <h1><?php echo (isset($pageTitle) && $pageTitle) ? t($pageTitle) : '&nbsp;' ?></h1>
</header>

<?php
$_error = array();
if (isset($error)) {
    if ($error instanceof Exception) {
        $_error[] = $error->getMessage();
    } elseif ($error instanceof \Concrete\Core\Error\ErrorList\ErrorList) {
        if ($error->has()) {
            $_error = $error->getList();
        }
    } else {
        $_error = $error;
    }
}
if (!empty($_error)) {
    ?>
	<div class="ccm-ui"  id="ccm-dashboard-result-message">
		<?php View::element('system_errors', array('format' => 'block', 'error' => $_error));
    ?>
	</div>
	<?php

}

if (isset($message)) {
    ?>
	<div class="ccm-ui" id="ccm-dashboard-result-message">
		<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button><?php echo nl2br(h($message))?></div>
	</div>
	<?php

} elseif (isset($success)) {
    ?>
	<div class="ccm-ui" id="ccm-dashboard-result-message">
		<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?php echo nl2br(h($success))?></div>
	</div>
	<?php 
}

echo $innerContent;

echo Core::make('helper/concrete/ui/help')->display('dashboard', $c->getCollectionPath());

if (isset($headerMenu) && $headerMenu instanceof \Concrete\Core\Controller\ElementController) {
    $headerMenu->render();
}

if (isset($breadcrumb) && (!empty($breadcrumb))) {
    ?>
    <div class="ccm-search-results-breadcrumb">
        <ol class="breadcrumb">
            <?php
            foreach ($breadcrumb as $value) {
                ?><li class="<?php echo $value['active'] ? 'ccm-undroppable-search-item active' : 'ccm-droppable-search-item'?>" data-collection-id="<?php echo $value['id']?>"><?php
                if (isset($value['children'])) {
                    ?><span class="dropdown">
                    <button type="button" class="btn btn-default btn-xs" data-toggle="dropdown">
                        <?php echo $value['name']?>
                        <span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            foreach ($value['children'] as $child) {
                                ?><li><a href="<?php echo h($child['url'])?>"><?php echo $child['name']?></a></li><?php
                            }
                            ?>
                        </ul>
                    </span><?php
                } else {
                    if (!$value['active']) {
                        ?><a href="<?php echo h($value['url'])?>"><?php
                    }
                    echo $value['name'];
                    if (!$value['active']) {
                        ?></a><?php
                    }
                }
                ?></li><?php
            }
            ?>
        </ol>
    </div>
    <?php
}

$this->inc('elements/footer.php');
