$(document).ready(function() {

	// Btn add outlet
	$('body').delegate('.btn_add_outlet', 'click', function() {
		$('.container_outlet_profile').css({'animation-play-state':'running', 'animation-name': 'left'});
	});
	
	// Btn back outlet
	$('body').delegate('.btn_outlet_back', 'click', function() {
		$('.container_outlet_profile').css({'animation-play-state':'running', 'animation-name': 'right'});
	});

});