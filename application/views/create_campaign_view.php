<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<title>ADGO - Campaign</title>

	<?php $this->view('common/header'); ?>
	
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/campaign.css' />
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/js/jquery-ui/jquery-ui.css' />
	
	<script src='<?= base_url(); ?>assets/js/jquery-ui/jquery-ui.js'></script>
	<script src='<?= base_url(); ?>assets/js/campaign.js'></script>

</head>
<body>

	<div class='container'>
		
		<?php $this->view('common/top_bar'); ?>
		
		<div class='back container_create_campaign_back'>
			
			<div class='front txt-c container_create_campaign_front'>
				<form id='form_campaign' action='' method='post' enctype='multipart/form-data'>
				
					<div class='txt-l col container_form_campaign'>
					
						<div class='container_campaign_title'>Create Campaign</div>
						
						<div class='row_input_campaign'>
							<div class='campaign_label col'>
								Campaign Title
							</div>
							<div class='campaign_input col'>
								<input type='text' class='input_txt1 campaign_title' name='campaign_title'>
								
								<div class='input_error input_error_title'></div>
							</div>
						</div>
						
						<div class='row_input_campaign'>
							<div class='campaign_label col'>
								Time Period
							</div>
							<div class='campaign_input col'>
								<div class='col'>
									<input type='text' class='input_txt1 input_date_from' 
									id='datepicker_from'
									placeholder='Date From' name='date_from'>
								</div>
								<div class='col container_dash'>-</div>
								<div class='col'>
									<input type='text' class='input_txt1 input_date_to'
									id='datepicker_to' 
									placeholder='Date To' name='date_to'>
								</div>
								
								<div class='input_error input_error_period'></div>
							</div>
						</div>
						
						<div class='row_input_campaign'>
							<div class='campaign_label col'>
								Image
							</div>
							<div class='campaign_input col'>
								<label for='logo_file'>
									<div class='btn_upload_img'>Upload File</div>
								</label>
								<input type='file' name='file' id='logo_file' class='none' />
							</div>
						</div>
						
						<div class='txt-r'>
							<div class='form_btn' id='btn_save_campaign'>Save Campaign</div>
						</div>
						
					</div>
					
					<div class='col container_previewimg'>
						<img id='previewimg' />
					</div>
					
				</form>
				
			</div>
			
			<?php $this->view('common/loader'); ?>
			
		</div>
		
	</div>
	
	<script>

		$(document).ready(function() {
			from = $('.datepicker_from').datepicker({
				defaultDate: '',
				changeMonth: true,
				dateFormat: 'dd-mm-yy'
			}).on('change', function() {
				var elem = $(this);
				to.datepicker('option', 'minDate', getDate(elem));
				$(this).datepicker("hide");
				alert('z');
			}),
			to = $('.datepicker_to').datepicker({
				defaultDate: '',
				changeMonth: true,
				dateFormat: 'dd-mm-yy'
			}).on('change', function() {
				from.datepicker('option', 'maxDate', getDate(this));
				$(this).datepicker("hide");
			});
		});

	</script>

</body>
</html>