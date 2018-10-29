<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_signup_detail_back back'>
	<form id='form_signup_detail_user'>

        <input 
            type='hidden' 
            class='input_user_pid' 
            value='<?= $this->uri->segment(1) == 'signup_profile' ? $this->session->userdata('temp_pid') : ''; ?>' 
            name='user_pid' 
        />

		<div class='container_signup_detail_front front'>
		
			<div>
				<div class='container_form_detail col'>
				
					<div class='row_signup_detail'>
						<div class='detail_label'>Profile Photo</div>
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
						<div class='detail_label'>Nama Lengkap</div>
						<div class='detail_input'>
							<input type='text' class='signup_input detail_name input_txt1' name='detail_name'>
							
							<div class='input_error input_error_detail_name'></div>
						</div>
					</div>
					
					<div class='row_signup_detail'>
						<div class='detail_label'>Tanggal Lahir</div>
						<div class='detail_input' name='detail_npwp'>
                            <div class='container_select_dob'>
                                <select 
                                    class='select_dob_day'
                                    name='detail_dob_day'
                                >
                                    <option value=''>Tanggal</option>
                                    <?php for($d = '1'; $d <= 31; $d++): ?>
                                        <option value='<?= $d; ?>'>
                                            <?= date('d', strtotime('2018-01-' . $d)); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>

                                <select 
                                    class='select_dob_month'
                                    name='detail_dob_month'
                                >
                                    <option value=''>Bulan</option>
                                    <?php for($m = 1; $m < 13; $m++): ?>
                                        <option value='<?= $m; ?>'>
                                            <?= date('F', strtotime('2018-' . $m . '-01')); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>

                                <select 
                                    class='select_dob_year'
                                    name='detail_dob_year'
                                >
                                    <option value=''>Tahun</option>
                                    <?php for($y = date('Y'); $y >= 1950; $y--): ?>
                                        <option value='<?= $y; ?>'>
                                            <?= date('Y', strtotime($y . '-01-01')); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
							
							<div class='input_error input_error_detail_dob'></div>
						</div>
					</div>
					
					<div class='row_signup_detail'>
						<div class='detail_label'>Alamat</div>
						<div class='detail_input'>
							<input type='text' class='signup_input detail_address input_txt1' name='detail_address'>
							
							<div class='input_error input_error_detail_address'></div>
						</div>
					</div>
					
					<div class='txt-l'>
						<div class='form_btn' id='btn_save_detail_user'>Save Detail</div>
					</div>
					
				</div>
			
			</div>
		
		</div>
	</form>

</div>