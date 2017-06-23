/** 
 * Basic concrete5 toolbar class
 */

var ConcreteDashboard = function() {
	setupResultMessages = function() {
		if ($('#ccm-dashboard-result-message').length > 0) { 
			if ($('.ccm-pane').length > 0) { 
				var pclass = $('.ccm-pane').parent().attr('class');
				var gpclass = $('.ccm-pane').parent().parent().attr('class');
				var html = $('#ccm-dashboard-result-message').html();
				$('#ccm-dashboard-result-message').html('<div class="' + gpclass + '"><div class="' + pclass + '">' + html + '</div></div>').fadeIn(400);
			}
		} else {
			$("#ccm-dashboard-result-message").fadeIn(200);
		}
	};

	var setupFavorites = function() {
		var $addFavorite = $('a[data-bookmark-action=add-favorite]'),
			$removeFavorite = $('a[data-bookmark-action=remove-favorite]'),
			url = false;

		if ($addFavorite.length) {
			var url = CCM_DISPATCHER_FILENAME + '/ccm/system/panels/dashboard/add_favorite',
				$link = $addFavorite;
		} else if ($removeFavorite.length) {
			var url = CCM_DISPATCHER_FILENAME + '/ccm/system/panels/dashboard/remove_favorite',
				$link = $removeFavorite;
		}

		if (url) {
			$link.on('click', function(e) {
				e.preventDefault();
				$.concreteAjax({
					dataType: 'json',
					type: 'GET',
					data: {'cID': $(this).attr('data-page-id'), 'ccm_token': $(this).attr('data-token')},
					url: url,
					success: function(r) {
						if (r.action == 'remove') {
							$link.attr('data-bookmark-action', 'add-favorite');
							$link.html('<i class="fa fa-lg fa-bookmark-o"></i>');
						} else {
							$link.attr('data-bookmark-action', 'remove-favorite');
							$link.html('<i class="fa fa-lg fa-bookmark"></i>');
						}
						$link.off('click');
						setupFavorites();
					}
				});
			});
		}
	}

	var setupTables = function() {
		$('table.ccm-search-results-table tr[data-details-url]').each(function() {
			$(this).hover(
				function() {
					$(this).addClass('ccm-search-select-hover');
				},
				function() {
					$(this).removeClass('ccm-search-select-hover');
				}
				)
				.on('click', function() {
					window.location.href = $(this).data('details-url');
				});
		});
	}

	var setupTooltips = function() {
		if ($("#ccm-tooltip-holder").length == 0) {
			$('<div />').attr('id','ccm-tooltip-holder').attr('class', 'ccm-ui').prependTo(document.body);
		}
		$('.launch-tooltip').tooltip({'container': '#ccm-tooltip-holder'});
	};

    var setupDialogs = function() {
        $('.dialog-launch').dialog();

		$('div#ccm-dashboard-page').on('click', '[data-dialog]', function() {
			var width = $(this).attr('data-dialog-width');
			if (!width) {
				width = 320;
			}
			var height = $(this).attr('data-dialog-height');
			if (!height) {
				height = 'auto';
			}
			if ($(this).attr('data-dialog-title')) {
				var title = $(this).attr('data-dialog-title');
			} else {
				var title = $(this).text();
			}
			var element = 'div[data-dialog-wrapper=' + $(this).attr('data-dialog') + ']';
			jQuery.fn.dialog.open({
				element: element,
				modal: true,
				width: width,
				title: title,
				height: height
			});
		});

    };

	var setupSelects = function() {
		$('select[data-select=bootstrap]').bootstrapSelectToButton();
	};

	var setupHeaderMenu = function() {
		var $buttons = $('.ccm-dashboard-header-buttons'),
			$menu = $('header div.ccm-dashboard-header-menu');
		if ($buttons.length) {
			if ($buttons.parent().get(0).nodeName.toLowerCase() == 'form') {
				$menu.append($buttons.parent());
			} else {
				$menu.append($buttons);
			}
		}
	};


	return {
		start: function(options) {
			setupTooltips();
			setupResultMessages();
			//setupHeaderMenu();
            setupDialogs();
			setupSelects();
			setupTables();
			setupFavorites();
		}

	}

}();
