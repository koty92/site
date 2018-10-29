<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<?php $this->view('common/header'); ?>
	
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home2_desktop.css?v=0.05' />
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home2_mobile.css?v=0.01' />
	
	<script src='<?= base_url(); ?>assets/js/home2.js'></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">

</head>
<body>

	<div class='container'>
		
		<?php $this->view('common/top_bar'); ?>
		<?php $this->view('common/top_bar_mobile'); ?>
		
		<div class='container_mid'>
			<div class='container_content'>
				<div class='col container_left_nav'>
					<?php $this->view('home2_nav', $uri); ?>
				</div>
				<div class='col container_text'>
					<?php $this->view('home_' . $uri . '_view', $uri); ?>
				</div>
			</div>
			
			<div class='container_main_bot'>
				<?php $this->view('common/footer'); ?>
			</div>
		</div>
	</div>

</body>
</html>