$(document).ready(function() {
	
	// Choose campaign type
	$('body').delegate('.container_select_campaign_type .eselect_result_row', 'click', function() {
		var type = $(this).data('value');
		
		//Loader
		var loader = $('.loader');
		loader.show();
		$('.loading').css('animation-play-state', 'running');
		
		$('#form_campaign').load(baseUrl + 'campaign_controller/load_campaign_type/' + type, function() {
			loader.hide();
		});
	});

	// Function to preview image after validation
	$(function() {
		$('body').delegate('#logo_file', 'change', function() {
			//$('.logreg_error_container').empty(); // remove previous message
			var file = $('#logo_file')[0].files[0];
			var imagefile = file.type;
			var match = ['image/jpeg', 'image/png', 'image/jpg'];
			if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
				$('#previewimg').attr('src','./images/noimage.png');
				$('.logreg_error_container').html('<div class="logreg_error"><li>' + 'Only jpeg, jpg, and png images type are allowed' + '</li></div>');
				$('#logo_file').css('color','red');
				return false;
			} else {
				var reader = new FileReader();
				reader.onload = function(event) {
					$('#logo_file').css('color','green');
					$('#previewimg').attr('src', event.target.result);
				}
				reader.readAsDataURL($('#logo_file')[0].files[0]);
			}
		});
	});
	
	// Promotion title preview
	$('body').delegate('.promotion_title', 'keyup', function() {
		var title = $(this).val();
		
		if(title != '') {
			$('.container_preview_title').removeClass('pq_placeholder');
			$('.container_preview_title').text(title);
		} else {
			$('.container_preview_title').addClass('pq_placeholder');
			$('.container_preview_title').text('Campaign Title');
		}
	});
	
	// Promotion desc preview
	$('body').delegate('.promotion_desc', 'keyup', function() {
		var title = $(this).val();
		title = title.replace(/\n/g, "<br />");
		
		if(title != '') {
			$('.container_preview_desc').removeClass('pq_placeholder');
			$('.container_preview_desc').html(title);
		} else {
			$('.container_preview_desc').addClass('pq_placeholder');
			$('.container_preview_desc').html('Campaign Description');
		}
	});
	
	// Advertisement question preview
	$('body').delegate('.campaign_question', 'keyup', function() {
		var question = $(this).val();
		
		if(question != '') {
			$('.container_preview_question').removeClass('pq_placeholder');
		} else {
			$('.container_preview_question').addClass('pq_placeholder');
		}
		
		$('.container_preview_question').text(question);
	});
	
	// Campaign answer preview
	$('body').delegate('.answer', 'keyup', function() {
		var option = $(this).data('option');
		var answer = $(this).val();
		
		if(answer != '') {
			$('.pa_' + option).removeClass('pq_placeholder');
			$('.pa_' + option).text(answer);
		} else {
			$('.pa_' + option).addClass('pq_placeholder');
		}
		
		// Change correct answer
		$('.container_select_correct_answer .eselect_result_row:nth-child(' + (option+1) + ')').text(answer);
	});
	
	// Choose gender options
	$('body').delegate('.option_gender', 'click', function() {
		$('.option_gender').removeClass('gender_selected');
		$(this).addClass('gender_selected');
		
		var gender = $(this).data('gender');
		$('.input_target_gender').val(gender);
	});
	
	// Choose age options
	$('body').delegate('.option_age_all', 'click', function() {
		$(this).addClass('gender_selected');
		$('.input_age_from').val('');
		$('.input_age_to').val('');
		
		$('.input_target_age').val('0');
	});
	
	var age_from = 0;
	var age_to = 0;
	
	// Input age from and to
	$('body').delegate('.input_age_from, .input_age_to', 'keyup', function(e) {
		var age = $(this).val();
		
		if(age != '' && age > 0) {
			$('.option_age_all').removeClass('gender_selected');
			
			if($(this).attr('name') == 'age_from') {
				age_from = age;
			} else {
				age_to = age;
			}
		}
		
		$('.input_target_age').val(age_from + ',' + age_to);
	});
	
	// Click submit form
	$('body').delegate('#btn_save_campaign', 'click', function() {
		$('#form_campaign').submit();
	});
	
	// Submit campaign
	$('body').delegate('#form_campaign', 'submit', function(e) {
	    e.preventDefault();
		var type = $('.container_select_campaign_type .eselect_input_val').val();
		var loader = $('.loader');
		loader.show();
		$('.loading').css('animation-play-state', 'running');
		
		$.ajax({
			url: baseUrl + 'campaign_controller/save_campaign',
			type: 'POST',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				var obj = JSON.parse(result);
				
				if(obj.success == '1') {
					$('.container_content').load(baseUrl + 'campaign_controller/show_campaign/' + obj.campaign_pid, function() {
						loader.hide();
					});
					
					/*
                    $.post('/adgo/campaign_controller/insert_invoice/' + obj.campaign_pid, function(invoice) {
						$('.container_content').load('/adgo/campaign_controller/show_invoice/' + invoice, function() {
							loader.hide();
						});
					});
					*/
                } else {
					var obj = JSON.parse(result);
					$('.input_error').text('');
					$.each(obj, function(k, v) {
						var err = '';
						$('.input_error_' + k).text(v);
					});
					loader.hide();
				}
			}
		});
	});

	// Campaign finish btn
	$('body').delegate('.campaign_finish_btn', 'click', function() {
		let uri = $(this).data('uri');
		if(uri == 'campaign') {
			location.reload();
		} else if(uri == 'page') {
			$('.dashboard_nav_page').click();
		}
	});

});