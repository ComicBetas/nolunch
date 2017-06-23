<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-header-search-form ccm-ui" data-header="user-search">
    <form method="get" action="<?php echo URL::to('/ccm/system/search/users/basic')?>">
        <div class="input-group">

            <div class="ccm-header-search-form-input">
                <a class="ccm-header-reset-search" href="#" data-button-action-url="<?php echo URL::to('/ccm/system/search/users/clear')?>" data-button-action="clear-search"><?php echo t('Reset Search')?></a>
                <a class="ccm-header-launch-advanced-search" href="<?php echo URL::to('/ccm/system/dialogs/user/advanced_search')?>" data-launch-dialog="advanced-search"><?php echo t('Advanced')?></a>
                <input type="text" class="form-control" autocomplete="off" name="uKeywords" placeholder="<?php echo t('Search')?>">
            </div>

              <span class="input-group-btn">'
                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              </span>
        </div>

        <?php if ($showAddButton) { ?>
        <ul class="ccm-header-search-navigation">
            <li><a href="<?php echo View::url('/dashboard/users/add') ?>" class="link-primary"><i class="fa fa-user"></i> <?php echo t("Add User") ?></a></li>
        </ul>
        <?php } ?>

    </form>
</div>