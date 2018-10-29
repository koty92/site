$(document).ready(function() {

	$('.input_admin_username').focus();
	
	// Input username -> next
	$('.input_admin_username').keydown(function(e) {
		if(e.keyCode == '13') {
			e.preventDefault();
			$('.input_admin_password').focus();
		}
	});
	
	// Input password -> enter
	$('.input_admin_password').keydown(function(e) {
		if(e.keyCode == '13') {
			e.preventDefault();
			$('.btn_admin_login').click();
		}
	});
	
	// Btn admin login
	$('.btn_admin_login').click(function() {
		var username = $('.input_admin_username').val();
		var pass = $('.input_admin_password').val();
		
		var loader = $('.loader');
		loader.show();
        $('.loading').css('animation-play-state', 'running');
		
		$.post('/adgo/admin_controller/login',
		{
			username: username,
			pass: pass,
		}, function(result) {
			if(result == '1') {
				location.reload();
			} else {
				$('.input_admin_username').focus();
				
				if(result) {
					var obj = JSON.parse(result);
					$('.input_error').text('');
					$.each(obj, function(k, v) {
						var err = '';
						$('.input_error_' + k).text(v);
					});
				}
				
				loader.hide();
			}
		});
	});
	
	// Nav
	$('.nav_menu').hover(function() {
	    var nav = $(this).attr('id');
		nav = nav.replace('nav_menu_', '');
		nav = 'navdesc_' + nav;
		$('#' + nav).fadeIn();
	}, function() {
		$('.navdesc_menu_outer').hide();
	});
	
	// Nav click
	$('.div_nav_menu').click(function() {
		var menu = $(this).data('menu');
		var loader = $('.loader');
		loader.show();
        $('.loading').css('animation-play-state', 'running');
		
		$('.content_container').load('/adgo/admin_controller/open_menu/' + menu, function() {
			loader.hide();
		});
	});
	
	// Logout
	$('.div_nav_logout').click(function() {
		var loader = $('.loader');
		loader.show();
        $('.loading').css('animation-play-state', 'running');
		
		$.post('/adgo/admin_controller/logout', function(result) {
			location.reload();
		});
	});
	
});