<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_signup_detail_back back <?= $this->session->userdata('pid') != '' ? '' : 'none'; ?>'>
	<form id='form_signup_detail'>
		<div class='container_signup_detail_front front'>
		
			<div>
				<div class='container_form_detail col'>
				
					<div class='row_signup_detail'>
						<div class='detail_label'>Company Logo</div>
						<div class='detail_input'>
							<div class='campaign_input col'>
								<div class='container_preview_img'>
									<div class='cell_previewimg'>
										<img id='previewimg' />
									</div>
								</div>
								<label for='logo_file'>
									<div class='btn_upload_img btn_green'>Upload File</div>
								</label>
								<input type='file' name='file' id='logo_file' class='none' />
								<div class='input_error input_error_img'></div>
							</div>
						</div>
					</div>
				
					<div class='row_signup_detail'>
						<div class='detail_label'>Company Name</div>
						<div class='detail_input'>
							<input type='text' class='signup_input detail_name input_txt1' name='detail_name'>
							
							<div class='input_error input_error_detail_name'></div>
						</div>
					</div>
					
					<div class='row_signup_detail'>
						<div class='detail_label'>NPWP <span style='font-size:10px;'>(Optional)</span></div>
						<div class='detail_input' name='detail_npwp'>
							<input type='text' class='signup_input detail_npwp input_txt1'>
							
							<div class='input_error input_error_detail_npwp'></div>
						</div>
					</div>
					
					<div class='row_signup_detail'>
						<div class='detail_label'>Address</div>
						<div class='detail_input'>
							<input type='text' class='signup_input detail_address input_txt1' name='detail_address'>
							
							<div class='input_error input_error_detail_address'></div>
						</div>
					</div>
					
					<div class='row_signup_detail'>
						<div class='detail_label'>Telephone</div>
						<div class='detail_input'>
							<input type='text' class='signup_input detail_telephone input_txt1' name='detail_telephone'>
							
							<div class='input_error input_error_detail_telephone'></div>
						</div>
					</div>
					
					<div class='txt-l'>
						<div class='form_btn' id='btn_save_detail'>Save Detail</div>
					</div>
					
				</div>
			
			</div>
		
		</div>
	</form>

</div>