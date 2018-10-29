<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<?php $this->view('admin/admin_header'); ?>

</head>
<body class='body_admin_dashboard'>

	<div class='container'>
    
		<?php $this->view('admin/nav'); ?>
		
		<div class='dashboard_content_container content_container'>
		
			<div class='user_info_container'>
			
			</div>
		
		</div>
		
		<?php $this->view('common/loader'); ?>

	</div>

</body>
</html>