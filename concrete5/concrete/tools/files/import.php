<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Core\File\StorageLocation\StorageLocation;

$u = new User();
/** @var Concrete\Core\File\Service\Application $ch */
$ch = Loader::helper('concrete/file');
$h = Loader::helper('concrete/ui');
$form = Loader::helper('form');

$ag = \Concrete\Core\Http\ResponseAssetGroup::get();
$ag->requireAsset('dropzone');


$folder = null;
if (isset($_REQUEST['currentFolder'])) {
    $node = Concrete\Core\Tree\Node\Node::getByID($_REQUEST['currentFolder']);
    if ($node instanceof \Concrete\Core\Tree\Node\Type\FileFolder) {
        $folder = $node;
    }
}

if ($folder) {
    $fp = new Permissions($folder);
} else {
    $fp = FilePermissions::getGlobal();
}

if (!$fp->canAddFiles()) {
    die(t("Unable to add files."));
}


$types = $fp->getAllowedFileExtensions();
$ocID = 0;
if (Loader::helper('validation/numbers')->integer($_REQUEST['ocID'])) {
    $ocID = $_REQUEST['ocID'];
}

$types = $ch->serializeUploadFileExtensions($types);
$valt = Loader::helper('validation/token');
?>
<div class="ccm-ui" id="ccm-file-manager-import-files">
<?php echo Core::make('helper/concrete/ui')->tabs([
    ['local', t('Your Computer'), true],
    ['incoming', t('Incoming Directory')],
    ['remote', t('Remote Files')],
]);
?>

<script type="text/javascript">

$('#check-all-incoming').click(function (event) {
    var checked = this.checked;
    $('.ccm-file-select-incoming').each(function () {
        this.checked = checked;
    });
});

$(function() {
    var $dropzone = $('#ccm-tab-content-local form').dropzone({
        sending: function() {
            $('[data-button=launch-upload-complete]').hide();
            totalStarted++;
        },
        success: function(data, r) {
            if (r[0]) {
                uploads.push(r[0]);
            }
        },
        complete: function() {
            totalCompleted++;
            if (totalCompleted == totalStarted && totalCompleted > 0) {
                $('[data-button=launch-upload-complete]').show();
            }
        }
    });

    $('a[data-tab=incoming], a[data-tab=local], a[data-tab=remote]').on('click', function() {
        var tab = $(this).attr('data-tab');
        var $dialog = $("#ccm-file-manager-import-files").closest('.ui-dialog-content');
        $dialog.jqdialog('option', 'buttons', [{}]);
        $dialog.parent().find(".ui-dialog-buttonset").remove();
        $dialog.parent().find(".ui-dialog-buttonpane").html('');
        $("#dialog-buttons-" + tab).clone().show().appendTo($dialog.parent().find('.ui-dialog-buttonpane').addClass('ccm-ui'));
    });

    $('a[data-tab=local]').trigger('click');
});

var uploads = [],
    totalStarted = 0,
    totalCompleted = 0;

ConcreteFileImportDialog = {

    loadDropzoneFiles: function() {
        jQuery.fn.dialog.closeTop();
        ConcreteEvent.trigger('FileManagerAddFilesComplete', {files: uploads});
    },

    addFiles: function() {
        var $form = $('#ccm-file-manager-import-files div.ccm-tab-content:visible form');
        if ($form.length) {
            $form.concreteAjaxForm({
                success: function(r) {
                    jQuery.fn.dialog.closeTop();
                    ConcreteEvent.trigger('FileManagerAddFilesComplete', {files: r.files});
                }
            }).submit();
        }
    }
}
</script>

<?php
    $valt = Loader::helper('validation/token');
    $fh = Loader::helper('validation/file');
    $error = false;

    try {
        $incoming_contents = $ch->getIncomingDirectoryContents();
    } catch (\Exception $e) {
        $error = t('Unable to get contents of incoming/ directory');
        $error .= '<br>';
        $error .= $e->getMessage();
    }
?>
<div id="ccm-tab-content-local" class="ccm-tab-content">
    <form action="<?php echo URL::to('/ccm/system/file/upload')?>"
          class="dropzone"
          >
        <?php echo Core::make('token')->output()?>

        <?php if (isset($_REQUEST['currentFolder'])) { ?>
            <input type="hidden" name="currentFolder" value="<?php echo h($_REQUEST['currentFolder'])?>">
        <?php } ?>
    </form>
</div>

<div class="ccm-tab-content" id="ccm-tab-content-incoming">
<?php if (!empty($incoming_contents) && is_array($incoming_contents)) {
    ?>
<form id="ccm-file-add-incoming-form" method="post" action="<?php echo REL_DIR_FILES_TOOLS_REQUIRED?>/files/importers/incoming">
    <input type="hidden" name="ocID" value="<?php echo $ocID?>" />
    <?php if ($folder) { ?>
        <input type="hidden" name="currentFolder" value="<?php echo $folder->getTreeNodeID()?>" />
    <?php } ?>
		<table id="incoming_file_table" class="table table-striped" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<th width="10%" valign="middle" class="center theader">
                    <input type="checkbox" id="check-all-incoming"/>
				</th>
				<th width="20%" valign="middle" class="center theader"></th>
				<th width="45%" valign="middle" class="theader"><?php echo t('Filename')?></th>
				<th width="25%" valign="middle" class="center theader"><?php echo t('Size')?></th>
			</tr>
		<?php foreach ($incoming_contents as $i => $file) {
    $ft = \Concrete\Core\File\Type\TypeList::getType($file['basename']);
    ?>
			<tr>
				<td width="10%" style="vertical-align: middle" class="center">
					<?php if ($fh->extension($file['basename'])) {
    ?>
						<input type="checkbox" name="send_file<?php echo $i?>" class="ccm-file-select-incoming" value="<?php echo $file['basename']?>" />
					<?php 
}
    ?>
				</td>
				<td width="20%" style="vertical-align: middle" class="center"><?php echo $ft->getThumbnail()?></td>
				<td width="45%" style="vertical-align: middle"><?php echo $file['basename']?></td>
				<td width="25%" style="vertical-align: middle" class="center"><?php echo Loader::helper('number')->formatSize($file['size'], 'KB')?></td>
			</tr>
		<?php 
}
    ?>
            <tr>
                <td><input type="checkbox" name="removeFilesAfterPost" value="1" /></td>
                <td colspan="3"><?php echo t('Remove files from incoming/ directory.')?></td>
            </tr>
		</table>



	<?php echo $valt->output('import_incoming');
    ?>

</form>
<?php 
} else {
    ?>
    <br/><br/>
    <?php if ($error) {
    ?>
        <div class="alert alert-danger">
            <?php echo $error;
    ?>
        </div>
    <?php 
} else {
    echo t('No files found in %s for the storage location "%s".', REL_DIR_FILES_INCOMING, StorageLocation::getDefault()->getName());
}
} ?>
</div>

    <div id="dialog-buttons-local" style="display: none">
        <button class="btn btn-default" onclick="jQuery.fn.dialog.closeTop()"><?php echo t("Close")?></button>
        <button class="btn btn-success pull-right" data-button="launch-upload-complete" onclick="ConcreteFileImportDialog.loadDropzoneFiles()" style="display: none"><?php echo t("Edit Properties and Sets")?></button>
    </div>

    <div id="dialog-buttons-incoming" style="display: none">
    <button class="btn btn-default" onclick="jQuery.fn.dialog.closeTop()"><?php echo t("Cancel")?></button>
    <button class="btn btn-success pull-right" onclick="ConcreteFileImportDialog.addFiles()"><?php echo t("Add Files")?></button>
</div>

<div id="dialog-buttons-remote"  style="display: none">
    <button class="btn btn-default" onclick="jQuery.fn.dialog.closeTop()"><?php echo t("Cancel")?></button>
    <button class="btn btn-success pull-right" onclick="ConcreteFileImportDialog.addFiles()"><?php echo t("Add Files")?></button>
</div>


<div id="ccm-tab-content-remote" class="ccm-tab-content">
<form method="POST" id="ccm-file-add-remote-form" action="<?php echo REL_DIR_FILES_TOOLS_REQUIRED?>/files/importers/remote">
    <?php if ($folder) { ?>
        <input type="hidden" name="currentFolder" value="<?php echo $folder->getTreeNodeID()?>" />
    <?php } ?>
    <input type="hidden" name="ocID" value="<?php echo $ocID?>" />
	<p><?php echo t('Enter URL to valid file(s)')?></p>
	<?php echo $valt->output('import_remote');?>

    <div class="form-group">
    	<?php echo $form->text('url_upload_1')?>
    </div>
    <div class="form-group">
        <?php echo $form->text('url_upload_2')?>
    </div>
    <div class="form-group">
        <?php echo $form->text('url_upload_3')?>
    </div>
    <div class="form-group">
        <?php echo $form->text('url_upload_4')?>
    </div>
    <div class="form-group">
        <?php echo $form->text('url_upload_5')?>
    </div>
</form>

</div>
</div>
