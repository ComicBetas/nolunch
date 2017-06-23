<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php

$permissionAccess = $key->getPermissionAssignmentObject()->getPermissionAccessObject();
if (!is_object($permissionAccess)) {
	$permissionAccess = PermissionAccess::create($key);
}

?>
<form id="ccm-permissions-detail-form" onsubmit="return ccm_submitPermissionsDetailForm()" method="post" action="<?php echo $key->getPermissionAssignmentObject()->getPermissionKeyToolsURL()?>">


	<input type="hidden" name="paID" value="<?php echo $permissionAccess->getPermissionAccessID()?>" />

	<div id="ccm-tab-content-access-types">
		<?php View::element('permission/keys/notify_in_notification_center', array('permissionAccess' => $permissionAccess))?>

	</div>


	<div class="ccm-dashboard-form-actions-wrapper" style="display:none">
		<div class="ccm-dashboard-form-actions">
			<button class="pull-right btn btn-primary" type="submit" ><?php echo t('Save')?></button>
		</div>
	</div>

</form>

<script type="text/javascript">
	var ccm_permissionDialogURL = '<?php echo REL_DIR_FILES_TOOLS_REQUIRED?>/permissions/dialogs/miscellaneous';
	ccm_deleteAccessEntityAssignment = function(peID) {
		jQuery.fn.dialog.showLoader();

		if (ccm_permissionDialogURL.indexOf('?') > 0) {
			var qs = '&';
		} else {
			var qs = '?';
		}

		$.get('<?php echo $key->getPermissionAssignmentObject()->getPermissionKeyToolsURL("remove_access_entity")?>&paID=<?php echo $permissionAccess->getPermissionAccessID()?>&peID=' + peID, function() {
			$.get(ccm_permissionDialogURL + qs + 'paID=<?php echo $permissionAccess->getPermissionAccessID()?>&message=entity_removed&pkID=<?php echo $key->getPermissionKeyID()?>', function(r) {
				window.location.reload();
			});
		});
	}

	ccm_addAccessEntity = function(peID, pdID, accessType) {
		jQuery.fn.dialog.closeTop();
		jQuery.fn.dialog.showLoader();

		if (ccm_permissionDialogURL.indexOf('?') > 0) {
			var qs = '&';
		} else {
			var qs = '?';
		}

		$.get('<?php echo $key->getPermissionAssignmentObject()->getPermissionKeyToolsURL("add_access_entity")?>&paID=<?php echo $permissionAccess->getPermissionAccessID()?>&pdID=' + pdID + '&accessType=' + accessType + '&peID=' + peID, function(r) {
			$.get(ccm_permissionDialogURL + qs + 'paID=<?php echo $permissionAccess->getPermissionAccessID()?>&message=entity_added&pkID=<?php echo $key->getPermissionKeyID()?>', function(r) {
				window.location.reload();
			});
		});
	}


	ccm_submitPermissionsDetailForm = function() {
		jQuery.fn.dialog.showLoader();
		$("#ccm-permissions-detail-form").ajaxSubmit(function(r) {
			window.location.reload();
		});
		return false;
	}

</script>