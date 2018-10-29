$(document).ready(function() {
	
	// Click submit catalogue
	$('body').delegate('#btn_save_catalogue', 'click', function() {
		$('#form_catalogue').submit();
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

	// Submit catalogue
	$('body').delegate('#form_catalogue', 'submit', function(e) {
	    e.preventDefault();
		
		var loader = $('.loader');
		loader.show();
		$('.loading').css('animation-play-state', 'running');
		
		$.ajax({
			url: '/adgo/campaign_controller/save_catalogue',
			type: 'POST',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				var obj = JSON.parse(result);
				alert(result);
				if(obj.success == '1') {
					/*
					$('.container_content').load('/adgo/campaign_controller/show_campaign/' + obj.campaign_pid, function() {
						loader.hide();
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

});