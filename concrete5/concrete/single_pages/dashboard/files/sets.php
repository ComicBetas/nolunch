<?php defined('C5_EXECUTE') or die("Access Denied.");

$ih = Core::make('helper/concrete/ui');
$dh = Core::make('helper/date');

?>
<?php if ($this->controller->getTask() == 'view_detail') {
    ?>

	<script type="text/javascript">
		deleteFileSet = function() {
			if (confirm('<?php echo t('Are you sure you want to permanently remove this file set?')?>')) {
				location.href = "<?php echo $view->url('/dashboard/files/sets', 'delete', $fs->getFileSetID(), Core::make('helper/validation/token')->generate('delete_file_set'))?>";
			}
		}
	</script>

	<div class="ccm-dashboard-header-buttons">
		<button class="btn btn-danger" onclick="deleteFileSet()"><?php echo t('Delete Set')?></button>
	</div>

	<form method="post" class="form-horizontal" id="file_sets_edit" action="<?php echo $view->url('/dashboard/files/sets', 'file_sets_edit')?>">
		<?php echo $validation_token->output('file_sets_edit');
    ?>


    <div class="form-group">
        <?php echo $form->label('file_set_name', t('Name'))?>
        <?php echo $form->text('file_set_name', $fs->fsName, array('class' => 'span5'));
?>
    </div>

    <?php echo $form->hidden('fsID', $fs->getFileSetID()); ?>

        <?php
        $fl = new FileList();
    $fl->filterBySet($fs);
    $fl->sortByFileSetDisplayOrder();
    $files = $fl->get();
    if (count($files) > 0) {
        ?>

            <span class="help-block"><?php echo t('Click and drag to reorder the files in this set. New files added to this set will automatically be appended to the end.')?></span>
            <div class="ccm-spacer">&nbsp;</div>

            <div class="table-responsive">
                <table class="ccm-search-results-table compact-results">
                    <thead>
                        <tr>
                            <th></th>
                            <th><span><?php echo t('Thumbnail')?></span></th>
                            <th><a href="javascript:void(0)" class="sort-link" data-sort="type"    ><?php echo t('Type')?></a></th>
                            <th><a href="javascript:void(0)" class="sort-link" data-sort="title"   ><?php echo t('Title')?></a></th>
                            <th><a href="javascript:void(0)" class="sort-link" data-sort="filename"><?php echo t('File name')?></a></th>
                            <th><a href="javascript:void(0)" class="sort-link" data-sort="added"   ><?php echo t('Added')?></a></th>
                        </tr>
                    </thead>

                    <tbody class="ccm-file-set-file-list">

                        <?php foreach ($files as $f) {
        ?>
                            <tr id="fID_<?php echo $f->getFileID()?>" class="">
                                <td><i class="fa fa-arrows-v"></i></td>
                                <td class="ccm-file-manager-search-results-thumbnail"><?php echo $f->getListingThumbnailImage()?><input type="hidden" name="fsDisplayOrder[]" value="<?php echo $f->getFileID()?>" /></td>
                                <td data-key="type" ><?php echo $f->getGenericTypetext()?>/<?php echo $f->getType()?></td>
                                <td data-key="title"><?php echo $f->getTitle()?></td>
                                <td data-key="filename"><?php echo $f->getFileName()?></td>
                                <td data-key="added" data-sort="<?php echo $f->getDateAdded()->getTimestamp()?>" ><?php echo $dh->formatDateTime($f->getDateAdded()->getTimestamp())?></td>
                            </tr>
                        <?php
    }
            ?>
                    </tbody>
                </table>
            </div>
		<?php
    } else {
        ?>
			<div class="alert alert-info"><?php echo t('There are no files in this set.')?></div>
		<?php
    }
    ?>

		<div class="ccm-dashboard-form-actions-wrapper">
		<div class="ccm-dashboard-form-actions">
			<a href="<?php echo View::url('/dashboard/files/sets')?>" class="btn btn-default pull-left"><?php echo t('Cancel')?></a>
			<?php echo Core::make("helper/form")->submit('save', t('Save'), array('class' => 'btn btn-primary pull-right'))?>
		</div>
		</div>
	</form>

	<script>
	$(function() {
        var baseClass="ccm-results-list-active-sort-"; // asc desc

        function ccmFileSetResetSortIcons()
        {
            $(".ccm-search-results-table thead tr th").removeClass(baseClass + 'asc');
            $(".ccm-search-results-table thead tr th").removeClass(baseClass + 'desc');
            $(".ccm-search-results-table thead tr th a").css("color", "#999");
        }

        function ccmFileSetDoSort()
        {
            var $this = $(this);
            var $parent = $(this).parent();
            var asc = $parent.hasClass( baseClass + 'asc' );
            var key = $this.attr('data-sort');

            ccmFileSetResetSortIcons();
            var sortableList = $('.ccm-file-set-file-list');
            var listItems = $('tr', sortableList);

            if (asc) {
                $parent.addClass( baseClass + 'desc' );
                $(".ccm-search-results-table thead tr th." + baseClass + "desc a").css("color", "#333");
            } else {
                $parent.addClass( baseClass + 'asc' );
                $(".ccm-search-results-table thead tr th." + baseClass + "asc a").css("color", "#333");
            }

            listItems.sort( function( a, b ) {
                var aTD = $('td[data-key=' + key + ']', $(a) );
                var bTD = $('td[data-key=' + key + ']', $(b) );

                var aVal = typeof( aTD.attr('data-sort') ) == 'undefined' ? aTD.text().toUpperCase() : parseInt(aTD.attr('data-sort'));
                var bVal = typeof( bTD.attr('data-sort') ) == 'undefined' ? bTD.text().toUpperCase() : parseInt(bTD.attr('data-sort'));

                if (asc) {
                    return aVal < bVal ? -1 : 1;
                } else {
                    return bVal < aVal ? -1 : 1;
                }
            });
            sortableList.append(listItems);
        }

        $('.ccm-search-results-table thead th a.sort-link').click(ccmFileSetDoSort);

		$(".ccm-file-set-file-list").sortable({
			cursor: 'move',
            opacity: 0.5,
            axis: 'y',
            helper: function( evt, elem ) {
                var ret = $(elem).clone();
                var i;
                // copy the actual width of the elements

                ret.width( elem.outerWidth() );
                retChilds = $(ret.children());
                elemChilds = $(elem.children());

                for ( i = 0; i < elemChilds.length; i++ )
                    $(retChilds[i]).width( $(elemChilds[i]).outerWidth() );

                return ret;
            },
            placeholder: "ccm-file-set-file-placeholder",
            stop: function(e,ui) {
                ccmFileSetResetSortIcons();
            }
		});


	});

	</script>

	<style type="text/css">
	    .ccm-file-set-file-list:hover {cursor: move}
        .ccm-file-set-file-placeholder { background-color: #ffd !important;  }
        .ccm-file-set-file-placeholder td { background:transparent !important; }
	</style>

<?php
} else {
    ?>


        <?php if (count($fileSets) > 0) { ?>

        <div class="ccm-dashboard-content-full">
            <div class="table-responsive">
                <table class="ccm-search-results-table">
                    <thead>
                    <tr>
                        <th class="ccm-results-list-active-sort-asc"><a ><?php echo t('Set Name')?></a></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fileSets as $fs) { ?>

                            <tr data-details-url="<?php echo $view->url('/dashboard/files/sets/', 'view_detail', $fs->getFileSetID())?>">
                                <td>
                                <?php echo $fs->getFileSetDisplayName()?>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <?php if ($fsl->requiresPaging()) {
                ?>
                <?php $fsl->displayPagingV2();
                ?>
            <?php } ?>

        </div>

        <?php
    } else { ?>
        <section>

        <p><?php echo t('No file sets found.')?></p>

        </section>

	<?php } ?>

        <div class="ccm-dashboard-header-buttons">
            <div class="ccm-header-search-form ccm-ui">

                <form method="get" action="#">
                    <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" name="fsKeywords" value="<?php echo h($_REQUEST['fsKeywords'])?>" placeholder="<?php echo t('Search')?>">
              <span class="input-group-btn">
                <select data-select="bootstrap" name="fsType">
                    <option value="<?php echo FileSet::TYPE_PUBLIC?>" <?php if ($fsType != FileSet::TYPE_PRIVATE) { ?> selected <?php } ?>><?php echo t('Public Sets')?></option>
                    <option value="<?php echo FileSet::TYPE_PRIVATE?>" <?php if ($fsType == FileSet::TYPE_PRIVATE) { ?> selected <?php } ?>><?php echo t('My Sets')?></option>
                </select>
                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                <a href="<?php echo View::url('/dashboard/files/add_set')?>" class="btn btn-primary"><?php echo t('Add File Set')?></a>
              </span>
                    </div>
                </form>
            </div>
        </div>


<?php } ?>



