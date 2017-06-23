<?php
defined('C5_EXECUTE') or die("Access Denied.");

$image = date('Ymd') . '.jpg';
$c = Page::getCurrentPage();
$token = Core::make('token');

if ($c->getCollectionPath() != '/dashboard/welcome') {
    $welcome = Page::getByPath('/dashboard/welcome');
} else {
    $welcome = $c;
}
$nav = $welcome->getCollectionChildren();

$controller = new \Concrete\Controller\Panel\Page\CheckIn();
$controller->setPageObject($c);
$approveAction = $controller->action('submit');


if (Config::get('concrete.white_label.background_image') !== 'none' && !Config::get('concrete.white_label.background_url')) {
    $imagePath = Config::get('concrete.urls.background_feed') . '/' . $image;
    $imageData = Core::getApplicationURL() . '/' . DISPATCHER_FILENAME . '/tools/required/dashboard/get_image_data';

} else if (Config::get('concrete.white_label.background_url')) {
    $imagePath = Config::get('concrete.white_label.background_url');
}

?>


<div class="ccm-dashboard-welcome">
    <h1><div class="ccm-dashboard-welcome-inner"><?php echo t('Welcome Back')?>
            <?php if (isset($imageData)) { ?>
                <a href="#" class="launch-tooltip" title="<?php echo t('View Original Image')?>"><i class="fa fa-image"></i></a>
            <?php } ?>
        </div>
    </h1>
</div>

<nav class="ccm-dashboard-desktop-navbar navbar navbar-default">
    <div class="container-fluid">

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form method="post" data-form="check-in" action="<?php echo $approveAction?>">
            <ul class="nav navbar-nav">
                <li><p class="navbar-text"><?php echo Core::make('date')->formatDateTime('now', true, true)?></p></li>
                <li>
                    <?php if ($c->isEditMode()) {
                        ?>
                        <a href="#" id="ccm-dashboard-welcome-check-in"><?php echo t('Save Changes')?></a>
                        <?php
                    }
                    ?>
                    <?php if (!$c->isEditMode()) {
                        ?><a href="<?php echo DIR_REL?>/<?php echo DISPATCHER_FILENAME?>?cID=<?php echo $c->getCollectionID()?>&ctask=check-out&<?php echo $token->getParameter()?>" id="ccm-nav-check-out"><?php echo t('Customize')?></a><?php
                    }
                    ?>
                </li>
            </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php if ($c->getCollectionPath() == '/dashboard/welcome') {?>class="active"<?php } ?>><a href="<?php echo URL::to('/dashboard/welcome')?>"><?php echo t('Welcome')?></a></li>
                    <?php
                    foreach($nav as $page) { ?>

                        <li <?php if ($page->getCollectionID() == $c->getCollectionID()) {?>class="active"<?php } ?>>
                            <a href="<?php echo $page->getCollectionLink()?>"><?php echo t($page->getCollectionName())?></a>
                        </li>
                    <?php } ?>
                    <li><a href="<?php echo URL::to('/account')?>"><?php echo t('My Account')?></a></li>
                </ul>
            <input type="hidden" name="cID" value="<?php echo $c->getCollectionID()?>">
            <input type="hidden" name="action" value="publish">
            </form>
        </div>
    </div>
</nav>

<?php if (isset($imagePath)) { ?>
    <style type="text/css">
        div.ccm-dashboard-welcome {
            background-image: url(<?php echo $imagePath?>);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }
    </style>
<?php } ?>

<script type="text/javascript">
    $(function() {
        <?php if (isset($imageData)) { ?>
        $.getJSON('<?php echo $imageData?>', { image: '<?php echo $image ?>' }, function (data) {
            $('.ccm-dashboard-welcome-inner a').attr('href', data.link);
        });
        <?php } ?>
        $('#ccm-dashboard-welcome-check-in').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').submit();
        });

        $('form[data-form=check-in]').concreteAjaxForm();

        ConcreteEvent.on('AddBlockListAddBlock', function(event, data) {
            var editor = Concrete.getEditMode();
            var area = editor.getNextBlockArea();
            blockType = new Concrete.BlockType(data.$launcher, editor);
            blockType.addToDragArea(_.last(area.getDragAreas()));
        });

        ConcreteEvent.on('EditModeAfterInit', function(event, data) {
            var areas = data.editMode.getAreas();
            _.each(areas, function(area) {
                area.bindEvent("EditModeAddBlocksToArea.area",
                    function(e, myData) {
                        if (myData.area === area) {
                            var arHandle = myData.area.getHandle();
                            $.fn.dialog.open({
                                width: 550,
                                height: 380,
                                title: '<?php echo t('Add Block')?>',
                                href: CCM_DISPATCHER_FILENAME + '/ccm/system/dialogs/page/add_block_list?cID=<?php echo $c->getCollectionID()?>&arHandle=' + encodeURIComponent(arHandle)});
                        }
                    }
                )
            });
        });

    });
</script>



