function elert(msg) {
	$('body').append('<div class="elert_bg"><div class="elert_box"><div class="elert_msg">' + msg + '</div><div class="elert_btn" tabindex="1">OK</div></div></div>');
	$('.elert_btn').focus();
}

function eprompt(msg, type) {
	$('body').append('<div class="eprompt_bg"><div class="eprompt_box"><div class="eprompt_msg">' + msg + '</div><div class="eprompt_input_container"><input type="' + type + '" class="eprompt_input"></div><div class="eprompt_btn" tabindex="1">OK</div></div></div>');
	$('.eprompt_input').focus();
}

function get_eprompt_input(val) {
	return val;
}
/*
function econfirm(msg) {
	$('body').append('<div class="econfirm_bg"><div class="econfirm_box"><div class="econfirm_msg">' + msg + '</div><div class="econfirm_btn" tabindex="1">OK</div><div class="econfirm_btn_cancel" tabindex="1">Cancel</div></div></div>');
	$('.econfirm_btn').focus();
}
*/

function econfirm(msg, action) {
	$('body').append('<div class="econfirm_bg"><div class="econfirm_box"><div class="econfirm_msg">' + msg + '</div><div class="econfirm_btn_container"><div class="econfirm_btn" data-btn="yes" tabindex="1" data-action="' + action + '">Yes</div><div class="econfirm_btn" data-btn="no" tabindex="1">No</div></div></div></div>');
	$('.econfirm_btn:first').focus();
}

function add_dot(str) {
	if(str.length > 3) {
		str = str.slice(0, -3) + '.' + str.slice(-3);
		if(str.length > 7) {
			str = str.slice(0, -7) + '.' + str.slice(-7);
			if(str.length > 11) {
				str = str.slice(0, -11) + '.' + str.slice(-11);
			}
		}
	}
	return str;
}

function add_space(str) {
	if(str.length > 3) {
		str = str.slice(0, -3) + ' ' + str.slice(-3);
		if(str.length > 7) {
			str = str.slice(0, -7) + ' ' + str.slice(-7);
			if(str.length > 11) {
				str = str.slice(0, -11) + ' ' + str.slice(-11);
			}
		}
	}
	return str;
}
	
function remove_dot(str) {
	str = str.replace(/\b \b/g, '');
	str = str.replace(/\./g, '');
	return str;
}

function add_separator(num) {
	num = num.replace(/(\s)/g, '');
	num = num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
	return num;
}

$(document).ready(function() {

	/*
	 * ELERT
	 */

	$('body').delegate('.elert_btn', 'keydown', function(e) {
		if(e.keyCode == 13) {
			e.preventDefault();
			$(this).click();
		}
	});
	
	$('body').delegate('.elert_btn', 'click', function() {
		//$(this).parent().parent().remove();
		$('.elert_bg').remove();
		$('.elert_before').focus();
		$('.elert_before').removeClass('elert_before');
	});
	
	/**********/
	
	/*
	 * EPROMPT
	 */
	 
	$('body').delegate('.eprompt_input', 'keydown', function(e) {
		if(e.keyCode == 13) {
			e.preventDefault();
			$('.eprompt_btn').click();
		}
	});
	
	/***** ECONFIRM *****/
	$('body').delegate('.econfirm_btn', 'keydown', function(e) {
		if(e.keyCode == 13) {
			e.preventDefault();
			$(this).click();
		} else if(e.keyCode == 37) {
			if(!($(this).is('.econfirm_btn:first'))) {
				$(this).prev().focus();
			}
		} else if(e.keyCode == 39) {
			if(!($(this).is('.econfirm_btn:last'))) {
				$(this).next().focus();
			}
		} else if(e.keyCode == 27) {
			$('.econfirm_btn:last').click();
		}
	});
	
	/** Einput Separator **/
	$('body').delegate('.einput_separator', 'keyup', function(e) {
		if(event.which >= 37 && event.which <= 40) {
			event.preventDefault();
		}
		var $this = $(this);
		var num = $this.val().replace(/(\s)/g, '');
		$this.val(num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 "));
	});
	
	// Logs
	$('body').click(function(e) {
		var $tag = $(e.target).prop('tagName');
		//var $tag = e.target.nodeName;
		var $class = '';
		var $id = '';
		
		if($(e.target).attr('class')) {
			$class = $(e.target).attr('class');
		}
		
		if($(e.target).attr('id')) {
			$id = $(e.target).attr('id');
		}
		
		$.post('/charas/main_controller/save_log',
		{
			action: 'click',
			tag: $tag,
			elemclass: $class,
			elemid: $id,
			content: ''
		});
	});
	
	// Logs
	$('body').keydown(function(e) {
		var $tag = $(e.target).prop('tagName');
		var $class = '';
		var $id = '';
		var $content = e.keyCode;
		
		if($(e.target).attr('class')) {
			$class = $(e.target).attr('class');
		}
		
		if($(e.target).attr('id')) {
			$id = $(e.target).attr('id');
		}
		
		$.post('/charas/main_controller/save_log',
		{
			action: 'keydown',
			tag: $tag,
			elemclass: $class,
			elemid: $id,
			content: $content
		});
	});

});