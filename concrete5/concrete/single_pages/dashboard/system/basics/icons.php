<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" class="form-horizontal" id="favicon-form" action="<?php echo $view->action('update_icons')?>" >
    <?php echo $this->controller->token->output('update_icons')?>
    <fieldset>
        <legend><?php echo t('Favicon')?></legend>
            <div class="help-block"><?php echo t('Your image should be 16x16 pixels, and should be a gif or a png with a .ico file extension.')?></div>
            <?php
            $faviconFID = intval($config->get('misc.favicon_fid'));
            $f = File::getByID($faviconFID);
            ?>
            <div class="form-group">
                <?php echo $concrete_asset_library->file('ccm-favicon-file', 'faviconFID', t('Choose File'), $f);?>
            </div>
    </fieldset>

    <fieldset>
        <legend><?php echo t('iPhone Thumbnail')?></legend>
        <div class="help-block"><?php echo t('iPhone home screen icons should be 57x57 and be in the .png format.')?></div>
        <?php
        $iosHomeFID = intval($config->get('misc.iphone_home_screen_thumbnail_fid'));
        $f = File::getByID($iosHomeFID);
        ?>
        <div class="form-group">
            <?php echo $concrete_asset_library->file('ccm-iphone-file', 'iosHomeFID', t('Choose File'), $f);?>
        </div>
    </fieldset>

    <fieldset>
        <legend><?php echo t('Windows 8 Thumbnail'); ?></legend>
        <div class="help-block"><?php echo t('Windows 8 start screen tiles should be 144x144 and be in the .png format.'); ?></div>
        <?php
        $modernThumbFID = intval($config->get('misc.modern_tile_thumbnail_fid'));
        $f = File::getByID($modernThumbFID);
        $modernThumbBG = strval($config->get('misc.modern_tile_thumbnail_bgcolor'));
        ?>
        <div class="form-group">
            <label class="control-label"><?php echo t('File')?></label>
            <?php echo $concrete_asset_library->file('ccm-modern-file', 'modernThumbFID', t('Choose File'), $f);?>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo t('Background Color')?></label>
            <div>
            <?php
            $widget = Core::make('helper/form/color');
            echo $widget->output('modernThumbBG', $modernThumbBG);
            ?>
            </div>
        </div>

    </fieldset>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
        </div>
    </div>

</form>
