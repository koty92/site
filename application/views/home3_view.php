<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<?php $this->view('common/header'); ?>
	
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home3_desktop.css?v=0.07' />
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home3_mobile.css?v=0.01' />
	
	<script src='<?= base_url(); ?>assets/js/home3.js'></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">

</head>
<body>

	<div class='container'>
		
		<?php $this->view('common/top_bar'); ?>
		<?php $this->view('common/top_bar_mobile'); ?>
		
		<div class='container_mid'>
			<div class='container_home3_nav <?= 'bg_home3_' . $uri; ?>'>
				<div class='container_nav_btn_absolute'>
					<div class='container_home3_nav_btn col'>
						<div class='home3_nav_btn home3_nav_btn_left col <?= $uri == 'download' ? 'current_selected_tab' : 'tab_not_selected'; ?>'>
							<?= $uri != 'download' ? '<a href="' . base_url() . 'download" class="home3_nav_url">' : ''; ?>
								Download
							<?= $uri != 'download' ? '</a>' : ''; ?>
						</div>
						
						<div class='home3_nav_btn col <?= $uri == 'about-us' ? 'current_selected_tab' : 'tab_not_selected'; ?>'>
							<?= $uri != 'about-us' ? '<a href="' . base_url() . 'about-us" class="home3_nav_url">' : ''; ?>
								About Us
							<?= $uri != 'about-us' ? '</a>' : ''; ?>
						</div>
						
						<div class='home3_nav_btn home3_nav_btn_right col <?= $uri == 'contact-us' ? 'current_selected_tab' : 'tab_not_selected'; ?>'>
							<?= $uri != 'contact-us' ? '<a href="' . base_url() . 'contact-us" class="home3_nav_url">' : ''; ?>
								Contact Us
							<?= $uri != 'contact-us' ? '</a>' : ''; ?>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class='container_content'>
				<?php $this->view('home3_' . $uri . '_view', $uri); ?>
			</div>
			
			<div class='container_main_bot'>
				<?php $this->view('common/footer'); ?>
			</div>
		</div>
		
		<?php $this->view('common/loader'); ?>
		
	</div>

</body>
</html>