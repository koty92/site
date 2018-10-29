$(document).ready(function() {

	// Click nav
	$('.home2_nav').click(function() {
		var uri = $(this).data('uri');
		location.href = baseUrl + uri;
	});

});