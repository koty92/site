var array_script = [];
var array_style = [];
var array_menu_style = ['campaign', 'profile', 'invoice', 'catalogue', 'report', 'outlet'];
var array_menu_script = ['campaign', 'catalogue', 'report', 'outlet'];
	
// Check get var
//var getNav = getVar('n');
var base_url = document.location.href;
base_url = base_url.replace('#', '');
var getNav = base_url.split('/')[6];
load_resource(getNav);
	
function getVar(variable)
{
	var query = window.location.search.substring(1);
    var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
	   var pair = vars[i].split("=");
	   if(pair[0] == variable){return pair[1];}
	}
	return(false);
}

function load_resource(getNav) {
	// load css
	if(getNav && $.inArray(getNav, array_menu_style) > -1) {
		if($.inArray(getNav, array_style) == -1) {
			$('head').append('<link rel="stylesheet" type="text/css" href="' + baseUrl + 'assets/css/' + getNav + '.css" />');
			array_style.push(getNav);
		}
				
	}
	
	// load js
	if(getNav && $.inArray(getNav, array_menu_script) > -1) {
		if($.inArray(getNav, array_script) == -1) {
			$.getScript(baseUrl + "assets/js/" + getNav + '.js');
			array_script.push(getNav);
		}
	}
}

$(document).ready(function() {

	// Nav
	$('body').delegate('.nav, .btn_create_campaign, .container_company_info', 'click', function() {
		var nav = $(this).data('nav');
		let cpid = $(this).data('cpid');
		var loader = $('.loader');
		
		$('.container_user_nav').slideUp();
		
		loader.show();
		$('.loading').css('animation-play-state', 'running');
		//alert(baseUrl + 'company/' + cpid + '/' + nav + '/content');

		$('.container_content').load(baseUrl + 'company/' + cpid + '/' + nav + '/content', function() {
			loader.hide();
		});
		
		load_resource(nav);
		
        window.history.replaceState("object or string", "Title", nav);
	});

	// Nav
	$('body').delegate('.nav_profile', 'click', function() {
		var loader = $('.loader');
		$('.container_user_nav').slideUp();
		loader.show();
	});
	
	// Click tr unpaid invoice
	$('body').delegate('.tr_unpaid_invoice', 'click', function() {
		var ipid = $(this).data('ipid');
		
		var loader = $('.loader');
		loader.show();
		$('.loading').css('animation-play-state', 'running');
		
		$('.container_content').load(baseUrl + 'campaign_controller/show_invoice/' + ipid, function() {
			load_resource('invoice');
			loader.hide();
		});
	});
	
	// Click open campaign result
	$('body').delegate('.tr_campaign', 'click', function() {
		var capid = $(this).data('capid');
		
		$('.container_popup').show();
		$('.container_popup').load(baseUrl + 'report_controller/show_analysis/' + capid);
	});

	/*** Company Page ***/

	// Select page and display content
	$('body').delegate('.container_filter_category_page .eselect_result_row', 'click', function() {
		let category_pid = $(this).data('value');

		$('.container_loader_25_red').show();

		$.post(baseUrl + 'company_controller/show_preview/' + category_pid, function(result) {
			$('.container_loader_25_red').hide();
			$('.container_page_content').html(result);

			let page = 0;
			let scrollHeight = $('.container_scroll_preview').prop('scrollHeight');
			let limit = scrollHeight - 75;

			// Container scroll and load
			$('.container_scroll_preview').scroll(function() {
				let offset = $(this).scrollTop() + $(this).height();
				
				if(offset > limit) {
					limit += scrollHeight;
					page++;

					//alert(category_pid + '.' + page);

					let loaded_div = '<div class="div_load_page" style="font-size:15px;"></div>';
					
					if($('.container_page_preview_phone .preview_row_new').length) {
						$(loaded_div).insertBefore('.preview_row_new');
						$('.container_')
					} else {
						$('.container_page_preview_phone').append(loaded_div);
					}

					$('.div_load_page:last').load(baseUrl + 'company_controller/load_page_preview/' + category_pid + '/' + page, function() {
						if($('.container_page_preview_phone .preview_row_new').length) {
							$('.container_scroll_preview').scrollTop($('.container_scroll_preview').prop('scrollHeight'));
						}
					});
				}
			});
		});
	});

	// Click on bg and show add row btn
	$('body').delegate('.container_page_preview_phone, .container', 'click', function() {
		$('.container_box_row').slideDown();
		$('.container_box_col').slideUp();
		$('.container_box_campaign').slideUp();
	});

	$('body').delegate('.container_preview_btn', 'click', function(e) {
		e.stopPropagation();
	});

	// Btn add row
	$('body').delegate('.btn_add_row', 'click', function() {
		$('.container_add_option_row').fadeIn();
	});

	var prev_position;
	// Option row click
	$('body').delegate('.option_row', 'click', function() {
		let radio = $(this).find('.row_radio_btn');
		$(this).parent().find('.row_radio_btn').attr('checked', false);
		$(this).parent().find('.option_row').removeClass('row_option_selected');

		// row position
		let position = $('.radio_row_position:checked').val();
		if(position != prev_position) {
			$('.preview_row_new').remove();
		}

		radio.attr('checked', true);
		$(this).addClass('row_option_selected');

		// remove row selected and new col
		$('.row_exist_selected').find('.preview_new_col').remove();
		$('.row_exist_selected').removeClass('row_exist_selected');

		let val = radio.val();

		// Add row preview
		if($('.container_page_preview_phone .preview_row_new').length) {
			$('.container_page_preview_phone .preview_row_new').css({
				'height': parseInt(val) * 75 + 'px'
			});
		} else {
			let new_row_element = '<div class="preview_row_new" style="width: 298px; height:' + parseInt(val) * 75 + 'px;"></div>';

			if(position == 'top') {
				$('.container_page_preview_phone').prepend(new_row_element);
			} else {
				$('.container_page_preview_phone').append(new_row_element);
			}
		}

		// Scroll
		if(position == 'top') {
			$('.container_scroll_preview').scrollTop('0');
		} else {
			$('.container_scroll_preview').scrollTop($('.container_scroll_preview').prop('scrollHeight'));
		}

		prev_position = position;
	});

	function preview_col(val, row_pid, row_index) {
		$('.container_box_row').slideUp();
		$('.container_box_col').slideDown();
		$('.container_box_campaign').slideUp();
		$('.container_option_col').fadeIn();

		$.post(baseUrl + 'company_controller/count_max_row/' + row_pid, function(result) {
			let max_col = 5 - parseInt(result);
			let optionCol = '';

			for(let i = 1; i < max_col; i++) {
				optionCol += '<div class="div_option option_col col" data-row_height="' + val + '" data-row_index="' + row_index + '">' +
				
				'<div class="row_img">' + 
				'<div style="width:' + i * 20 + 'px; height:' + val * 20 + 'px; border: 1px solid #cacaca; display: inline-block;"></div>' + 
				'</div>' + 
				
				'<div class="row_txt">' +
				i + ' x ' + val +
				'</div>' +
				
				'<div class="row_btn">' +
				'<input type="radio" class="col_radio_btn" value="' + i + '" data-row_pid="' + row_pid + '"/>' +
				'</div>' +

				'</div>';
			}

			$('.container_option_col').html(optionCol);
		});
	}

	// Btn save row
	$('body').delegate('.btn_save_row', 'click', function() {
		let category_pid = $(this).data('category_pid');
		let val = $('.row_radio_btn:checked').val();

		$.post(baseUrl + 'company_controller/add_campaign_row/' + category_pid + '/' + val, function(result) {
			let obj = JSON.parse(result);

			if(obj.success == '1') {
				let row_pid = obj.row_pid;
				let row_index = obj.row_index;

				preview_col(val, row_pid, 'new');

				let row_new = $('.preview_row_new');

				row_new.addClass('preview_row_exist');
				row_new.addClass('preview_row_' + row_index);
				row_new.data('row_pid', row_pid);
				row_new.data('page_y', val);
				row_new.data('page_row_index', row_index);
				row_new.removeClass('preview_row_new');

				// Clear option row radio
				$('.container_option_row').find('.row_radio_btn').attr('checked', false);
				$('.container_option_row').find('.option_row').removeClass('row_option_selected');
				$('.container_add_option_row').fadeOut();
			}
		});
	});

	// Click existing row
	$('body').delegate('.preview_row_exist', 'click', function(e) {
		e.stopPropagation();
		let row_pid = $(this).data('row_pid');
		let val = $(this).data('page_y');
		let row_index = $(this).data('page_row_index');

		//alert(row_pid + '.' + val + '.' + row_index);
		
		$('.preview_row_exist').removeClass('row_exist_selected');
		$(this).addClass('row_exist_selected');
		preview_col(val, row_pid, row_index);
		$('.preview_row_new').remove();
		$('.preview_new_col').remove();

		// Clear option row radio
		$('.container_option_row').find('.row_radio_btn').attr('checked', false);
		$('.container_option_row').find('.option_row').removeClass('row_option_selected');
		$('.container_add_option_row').fadeOut();
	});

	// Btn add new col
	$('body').delegate('.btn_add_col', 'click', function() {
		$('.row_exist_selected').click();
	});

	// Click option col
	$('body').delegate('.option_col', 'click', function() {
		let row_index = $(this).data('row_index');

		let radio = $(this).find('.col_radio_btn');
		$(this).parent().find('.col_radio_btn').attr('checked', false);
		radio.attr('checked', true);

		let val = radio.val();
		let row_height = $(this).data('row_height');
		let width = (parseInt(val) / 4) * 100;

		$(this).parent().find('.option_col').removeClass('option_col_selected');
		$(this).addClass('option_col_selected');

		// Add col preview
		if($('.container_page_preview_phone .preview_row_' + row_index + ' .preview_new_col').length) {
			$('.container_page_preview_phone .preview_row_' + row_index + ' .preview_new_col').css({
				'width': width + '%'
			})
		} else {
			$('.container_page_preview_phone .preview_row_' + row_index).append(
				'<div class="preview_new_col col" style="width:' + width + '%; height:100%;"></div>'
			);
		}
	});

	// Btn save col
	$('body').delegate('.btn_save_col', 'click', function() {
		let category_pid = $(this).data('category_pid');
		let radio = $('.col_radio_btn:checked');
		let option_col = radio.parent().parent();

		let page_grid_col = radio.val();
		let row_pid = radio.data('row_pid');
		let row_index = option_col.data('row_index');
		let row_y = option_col.data('row_height');

		$.post(baseUrl + 'company_controller/add_campaign_col/' + row_pid + '/' + page_grid_col, function(result) {
			let obj = JSON.parse(result);

			if(obj.success == '1') {
				let new_col = $('.container_page_preview_phone .preview_row_' + row_index + ' .preview_new_col');

				new_col.addClass('preview_exist_col');
				new_col.removeClass('preview_new_col');
				new_col.data('grid_pid', obj.grid_pid);
				new_col.data('grid_col', page_grid_col);
				new_col.data('grid_index', obj.grid_index);
				new_col.data('row_pid', row_pid);
				new_col.data('row_y', row_y);

				new_col.html(
					'<div class="container_flex_exist_img">' +
					'<div class="preview_exist_col_img"></div>' +
					'</div>'
				);

				$('.container_option_col').fadeOut();
				$('.container_option_col').html('');
			}
		});
	});

	function preview_grid(max_x, max_y, row_pid, grid_index, grid_col, row_y) {
		$('.container_box_row').slideUp();
		$('.container_box_col').slideUp();
		$('.container_box_campaign').slideDown();
		let optionGrid = '';

		for(let x = 1; x <= max_x; x++) {
			for(let y = 1; y <= max_y; y++) {
				optionGrid += '<div class="div_option option_grid col"' + 
				'data-x="' + x + '"' + 
				'data-y="' + y + '"' +
				'data-max_y="' + max_y + '"' +
				'data-row_pid="' + row_pid + '"' +
				'data-row_y="' + row_y + '"' +
				'data-grid_index="' + grid_index + '"' +
				'data-grid_col="' + grid_col + '">' +
				
				'<div class="row_img">' + 
				'<div style="width:' + x * 20 + 'px; height:' + y * 20 + 'px; border: 1px solid #cacaca; display: inline-block;"></div>' + 
				'</div>' + 
				
				'<div class="row_txt">' +
				x + ' x ' + y +
				'</div>' +
				
				'<div class="row_btn">' +
				'<input type="radio" class="grid_radio_btn" name="radio_grid" value="" />' +
				'</div>' +

				'</div>';
			}
		}

		$('.container_option_campaign').html(optionGrid);
	}

	// Preview exist col add campaign
	$('body').delegate('.preview_exist_col', 'click', function(e) {
		e.stopPropagation();
		$('.container_box_row').slideUp();
		$('.container_box_col').slideUp();
		$('.container_box_campaign').slideDown();
		
		$('.preview_exist_col').removeClass('exist_col_selected');
		$(this).addClass('exist_col_selected');

		let grid_pid = $(this).data('grid_pid');
		let grid_col = $(this).data('grid_col');
		let grid_index = $(this).data('grid_index');
		let row_pid = $(this).data('row_pid');
		let row_y = $(this).data('row_y');
		//alert(grid_col + '.' + grid_index + '.' + grid_pid + '.' + row_pid + '.' + row_y);

		$.post(baseUrl + 'company_controller/count_max_grid/' + grid_pid + '/' + grid_col + '/' + grid_index + '/' + row_pid + '/' + row_y, function(result) {
			let obj = JSON.parse(result);
			preview_grid(obj.max_x, obj.max_y, row_pid, grid_index, grid_col, row_y);
		});
	});

	// Click option grid
	$('body').delegate('.option_grid', 'click', function() {
		let radio = $(this).find('.grid_radio_btn');
		$(this).parent().find('.grid_radio_btn').attr('checked', false);
		radio.attr('checked', true);

		$(this).parent().find('.option_grid').removeClass('option_grid_selected');
		$(this).addClass('option_grid_selected');
	});

	// Select campaign and preview
	$('body').delegate('.container_select_page_campaign .eselect_result_row', 'click', function() {
		let campaign_pid = $(this).data('value');

		$('.container_page_campaign_preview').load(baseUrl + 'company_controller/preview_page_campaign/' + campaign_pid);
	});

	// Btn save campaign
	$('body').delegate('.btn_save_campaign', 'click', function() {
		let radio = $(this).parent().parent().find('.grid_radio_btn:checked');
		let option_grid = radio.parent().parent();
		let grid_x = option_grid.data('x');
		let grid_y = option_grid.data('y');
		let row_y = option_grid.data('row_y');
		let row_pid = option_grid.data('row_pid');
		let grid_index = option_grid.data('grid_index');
		let grid_col = option_grid.data('grid_col');
		let campaign_pid = $('input[name="grid_campaign"]').val();

		$.post(baseUrl + 'company_controller/save_grid_campaign/' + grid_x + '/' + grid_y + '/' + campaign_pid + '/' + row_pid + '/' + grid_index + '/' + grid_col, function(result) {
			let obj = JSON.parse(result);

			//alert(grid_y + '.' + row_y);
			$('.exist_col_selected .preview_exist_col_img').append(
				'<div style="width:' + grid_x/grid_col * 100 + '%; height:' + grid_y/row_y * 100 + '%;" class="col exist_preview_col_top_container">' +

				'<div class="exist_preview_col_flex">' +

				'<img src="' + baseUrl + 'assets/images/campaigns/' + obj.company_pid + '/' + obj.campaign_pid + '/' + obj.campaign_image + '" class="exist_preview_col_img" />' +

				'</div>' +
				'</div>'
			);
		});
	});

	/*** End Company Page ***/
});