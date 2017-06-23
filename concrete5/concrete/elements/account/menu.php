<?php
use Concrete\Core\Page\Desktop\DesktopList;
use Concrete\Core\Support\Facade\Application;

defined('C5_EXECUTE') or die('Access Denied.');

$u = new User();
if (!$u->isRegistered()) {
    return;
}

$ui = $u->getUserInfoObject();

$account = Page::getByPath('/account');
if (!is_object($account) || $account->isError()) {
    return;
}

$desktop = DesktopList::getMyDesktop();
if (!is_object($desktop) || $desktop->isError()) {
    return;
}
$cp = new Permissions($desktop);
if (!$cp->canRead()) {
    return;
}
$app = Application::getFacadeApplication();
$url = $app->make('url/manager');
?>
<div style="display: none">
    <div class="btn-group" id="ccm-account-menu">
        <a class="btn btn-default" href="<?php echo $desktop->getCollectionLink()?>"><i class="fa fa-user"></i> <?php echo $ui->getUserDisplayName()?></a>
        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="<?php echo $url->resolve([$desktop])?>"><?php echo t('My Account')?></a></li>
            <li class="divider"></li>
            <?php
                $categories = [];
                $children = $account->getCollectionChildrenArray(true);
                foreach ($children as $cID) {
                    $nc = Page::getByID($cID, 'ACTIVE');
                    $ncp = new Permissions($nc);
                    if ($ncp->canRead() && (!$nc->getAttribute('exclude_nav'))) {
                        $categories[] = $nc;
                    }
                }
                foreach ($categories as $cc) {
                    ?><li><a href="<?php echo $url->resolve([$cc])?>"><?php echo h(t($cc->getCollectionName()))?></a></li><?php
                }
            ?>
            <li class="divider"></li>
            <li><a href="<?php echo $url->resolve(['/'])?>"><i class="fa fa-home"></i> <?php echo t('Home')?></a></li>
            <li><a href="<?php echo $url->resolve(['/login', 'logout', $app->make('token')->generate('logout')])?>"><i class="fa fa-sign-out"></i> <?php echo t('Sign Out')?></a></li>
        </ul>
    </div>
</div>

