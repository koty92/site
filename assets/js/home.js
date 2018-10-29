$(document).ready(function() {

	// Click main menu
	$('.main_menu').click(function() {
		$('.main_menu').removeClass('menu_selected');
		$(this).addClass('menu_selected');
		$('.container_mid').scrollTop(0);
		
		var menu = $(this).data('menu');
		$('.background_home').fadeOut();
		$('.background_' + menu).fadeIn();
		
		$('.main_front_element').fadeOut();
		$('.container_main_front_' + menu).fadeIn();
	});
	
	// Click menu mobile
	$('.btn_menu_mobile').click(function() {
		$('.container_mobile_side_bar_menu_background').show();
		$('.container_mobile_side_bar_menu').slideDown();
	});
	
	// Click background menu hide
	$('.container_mobile_side_bar_menu_background').click(function() {
		$('.container_mobile_side_bar_menu').slideUp();
		$(this).hide();
	});
	
	// Click side bar menu
	$('.container_mobile_side_bar_menu').click(function(e) {
		e.stopPropagation();
	});

});