$(document).ready(function() {
	
	$.expr[":"].contains = $.expr.createPseudo(function(arg) {
		return function( elem ) {
			return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
		};
	});
	
	// Input Text
	$('body').delegate('.eselect_input_text', 'keydown', function(e) {
		var $parent = $(this).parent().parent();
		//alert(e.keyCode);
		
		if(!((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || e.keyCode == 40 || e.keyCode == 189)) {
			e.preventDefault();
			if(e.keyCode == 9 || e.keyCode == 13) {
				var inputs = $(':input:visible:not([readonly])');
				inputs.eq(inputs.index(this)+ 1).focus();
			} else if(e.keyCode == 220) {
				var inputs = $(':input:visible');
				if(inputs.index(this) != 0) {
					inputs.eq(inputs.index(this)- 1).focus();
				}
			}
		} else {
			var val = e.keyCode;
			if(val == 40) {
				val = '';
			} else if(val == 189) {
				val = '-';
			} else {
				val = String.fromCharCode(val).toLowerCase();
			}
			var input_query = $(this).parent().next().find('.eselect_input_query');
			$(this).parent().parent().find('.eselect_container_suggest').show();
			input_query.val(val);
			input_query.focus();
			$parent.find('.eselect_result_row:visible:first').addClass('eselect_selected');
			e.preventDefault();
		}
	});
	
	// Input Text Click
	$('body').delegate('.eselect_input_text', 'click', function(e) {
		var input_query = $(this).parent().next().find('.eselect_input_query');
		$(this).parent().parent().find('.eselect_container_suggest').toggle();
		input_query.focus();
		
		var $parent = $(this).parent().parent();
		var results = $parent.find('.eselect_result_row:visible');
		results.eq(results.index(0)).addClass('eselect_selected');
	});
	
	// Input Query Keyup
	$('body').delegate('.eselect_input_query', 'keyup', function(e) {
		var $parent = $(this).parent().parent();
		
		switch(e.keyCode) {
			default:
				var val = $(this).val();
				$parent.find('.eselect_result_row').hide();
				$parent.find('.eselect_result_row:contains("' + val + '")').show();
				
				if((e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 48 && e.keyCode <= 57) || e.keyCode == 13 || (e.keyCode >= 65 && e.keyCode <= 90) || e.keyCode == 189 || e.keyCode == 8) {
					$(this).parent().next().children().removeClass('eselect_selected');
					$parent.find('.eselect_result_row:visible:first').addClass('eselect_selected');
				}
				
				break;
		}
	});
	
	// Input Query Keydown
	$('body').delegate('.eselect_input_query', 'keydown', function(e) {
		var $parent = $(this).parent().parent();
		var $this = $(this);
		
		switch(e.keyCode) {
			case 13:
				e.preventDefault();
				$parent.find('.eselect_selected').click();
				
				break;
			case 38:
				e.preventDefault();
				if(!($parent.find('.eselect_selected').is('.eselect_result_row:visible:first'))) {
					var prev = $parent.find('.eselect_selected').prevAll('.eselect_result_row:visible:first');
					$(this).parent().next().children().removeClass('eselect_selected');
					prev.addClass('eselect_selected');
				}
				break;
			case 40:
				e.preventDefault();
				if(!($parent.find('.eselect_selected').is('.eselect_result_row:visible:last'))) {
					var next = $parent.find('.eselect_selected').nextAll('.eselect_result_row:visible:first');
					$(this).parent().next().children().removeClass('eselect_selected');
					next.addClass('eselect_selected');
					next.focus();
					$this.focus();
				}
				break;
		}
	});
	
	// Result Row Click
	$('body').delegate('.eselect_result_row', 'click', function() {
		var val = $(this).data('value');
		var txt = $(this).text();
		
		if(val == '') { txt = ''; }
		
		var econtainer = $(this).parent().parent().parent().parent();
		econtainer.find('.eselect_input_val').val(val);
		econtainer.find('.eselect_input_text').val(txt);
		econtainer.find('.eselect_container_suggest').hide();
		econtainer.find('.eselect_input_text').focus();
		$(this).blur();
		$(this).parent().children().removeClass('eselect_selected');
	});
	
	// Eselect Checkbox
	$('body').delegate('.eselect_checkbox, .eselect_checkbox_all', 'click', function(e) {
		e.stopPropagation();
	});
	
	// Eselect Checkbox All
	$('body').delegate('.eselect_checkbox_all', 'change', function(e) {
		e.stopPropagation();
		var checkboxes = $(this).parent().parent().find('.eselect_checkbox');
		if(this.checked) {
			checkboxes.prop('checked', true);
		} else {
			checkboxes.prop('checked', false);
		}
	});
	
	// Eselect blur hide eselect
	/*
	$('body').delegate('.eselect_input_query', 'blur', function(e) {
		
		var container = $(this).parent().parent().parent().parent();
		if(container.find('.eselect_result_row').hasFocus()) {
			alert('focus');
		}
		//$(this).parent().parent().parent().parent().find('.eselect_container_suggest').toggle();
	});
	*/
	
});