<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

    <title>Sipromo - Dashboard</title>

    <?php $this->view('common/header'); ?>

    <!-- CSS -->
    <link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/user_dashboard.css?v=0.02' />

    <!-- JS -->
    <script src='<?= base_url(); ?>assets/js/user_dashboard.js?v=0.04'></script>

</head>
<body>

    <div class='container'>
		
		<?php $this->view('common/top_bar'); ?>

        <div class='back container_dashboard_back'>
			
			<div class='front txt-c container_dashboard_front'>
				
				<div class='col container_nav'>
					<div class='nav' data-nav='dashboard'>Dashboard</div>
					<div class='nav' data-nav='business'>My Business</div>
				</div>
				
				<div class='col container_dashboard_main txt-c overflow_8px'>
					<div class='container_content'>
						<?php
						$param = $this->uri->segment(2);
						if($param != '') {
							$this->view('content_user_' . $param);
						} else {
							$this->view('content_user_dashboard'); 
						}
						?>
					</div>
					
					<div class='container_popup'></div>
				</div>
				
			</div>
			
			<?php $this->view('common/loader'); ?>
			
		</div>
        
    </div>

</body>
</html>