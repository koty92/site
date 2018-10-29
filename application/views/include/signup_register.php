<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_form_signup'>
	<div class='container_form'>
		
		<div class='row_signup_input'>
			<div class='signup_label'>
				<div class='input_label label_email'>
					E-mail Address
				</div>
			</div>
			
			<input type='text' class='signup_input signup_email input_txt1' data-input='email'>
			
			<div class='input_error input_error_email'></div>
		</div>

		<div class='row_signup_input'>
			<div class='signup_label'>
				<div class='input_label label_handphone'>
					Nomor Handphone
				</div>
			</div>
			
			<input type='text' class='signup_input signup_handphone input_txt1' data-input='handphone'>
			
			<div class='input_error input_error_handphone'></div>
		</div>
		
		<div class='row_signup_input'>
			<div class='signup_label'>
				<div class='input_label label_pass none'>
					Password
				</div>
			</div>
			
			<input type='password' class='signup_input signup_password input_txt1' placeholder='Password' data-input='pass'>
			
			<div class='input_error input_error_pass'></div>
		</div>
		
		<div class='row_signup_input'>
			<div class='signup_label'>
				<div class='input_label label_repass none'>
					Confirm Password
				</div>
			</div>
			
			<input type='password' class='signup_input signup_confirm_password input_txt1' placeholder='Confirm Password' data-input='repass'>
		</div>
		
		<div class='txt-r'>
			<div class='form_btn' id='btn_signup'>Sign Up</div>
		</div>
	</div>
</div>