<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<?php $this->view('admin/admin_header'); ?>

</head>
<body>

	<div class='container'>
		
		<div class='back container_admin_login'>
			
			<div class='front txt-c container_login_form'>
			
				<div class='col'>
					<div class='row_admin_login'>
						<input type='text' placeholder='Username' class='input_txt1 input_admin_username'>
						
						<div class='input_error input_error_username'></div>
					</div>
					
					<div class='row_admin_login'>
						<input type='password' placeholder='Password' class='input_txt1 input_admin_password'>
						
						<div class='input_error input_error_pass'></div>
					</div>
					
					<div class='txt-r'>
						<div class='form_btn btn_admin_login'>Log In</div>
					</div>
				</div>
				
			</div>
			
			<?php $this->view('common/loader'); ?>
			
		</div>
		
	</div>

</body>
</html>