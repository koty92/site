$(document).ready(function() {
	
	// Choose campaign type
	$('body').delegate('.container_select_report_type .eselect_result_row', 'click', function() {
		var type = $(this).data('value');
		
		$('.container_list_campaign').load(baseUrl + 'report_controller/show_campaign/' + type);
	});
	
	// Click campaign list
	$('body').delegate('.container_campaign_title', 'click', function() {
		var cpid = $(this).data('cpid');
		
		$('.container_report_content').load(baseUrl + 'report_controller/show_report/' + cpid);
	});

});