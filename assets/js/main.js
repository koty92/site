$(document).ready(function() {

	// Show login form
	$('#btn_nav_login').click(function() {
		$('.container_background_login').fadeIn();
		$('.login_email').focus();
	});
	
	// Login input -> next
	$('.login_email').keydown(function(e) {
		if(e.keyCode == '13') {
			e.preventDefault();
			$('.login_pass').focus();
		}
	});
	
	// Login pass -> enter
	$('.login_pass').keydown(function(e) {
		if(e.keyCode == '13') {
			e.preventDefault();
			$('#btn_login').click();
		}
	});
	
	// Log in
	$('#btn_login').click(function() {
		var email = $('.login_email').val();
		var pass = $('.login_pass').val();
		var loader = $('.loader');
		
		loader.show();
        $('.loading').css('animation-play-state', 'running');
		
		$.post(baseUrl + 'main_controller/login',
		{
			email: email,
			pass: pass,
		}, function(result) {
			let obj = JSON.parse(result);
			let success = obj.success;

			if(success == '1') {
				location.href = baseUrl + 'user/dashboard';
			} else if(success == '2') {
				location.href = baseUrl + 'signup_profile';
			} else if(success == '0') {
				elert('Invalid E-mail or Password');
			} else {
				elert(success);
			}
			loader.hide();
		});
	});
	
	// Click background hide login
	$('.container_background_login').click(function() {
		$(this).fadeOut();
	});
	
	// Exclude children
	$('.container_form_login').click(function(e) {
		e.stopPropagation();
	});
	
	// User btn show nav
	$('.main_btn_nav_user').click(function() {
		$('.container_user_nav').slideToggle();
	});
	
	// User nav
	$('.nav_logout').click(function() {
		var nav = $(this).data('nav');
		
		$.post(baseUrl + 'main_controller/' + nav, function(result) {
			if(nav == 'logout') {
				location.href = baseUrl;
			}
		});
	});
	
	// Click url footer
	$('.container_footer_submenu').click(function() {
		var uri = $(this).data('uri');
		var loader = $('.loader');
		
		loader.show();
        $('.loading').css('animation-play-state', 'running');
		
		location.href = baseUrl + uri;
	});

});