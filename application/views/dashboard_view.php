<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $cpid = $this->uri->segment(2); ?>

<!DOCTYPE HTML>
<html>
<head>

	<title>Sipromo - Dashboard</title>

	<?php $this->view('common/header'); ?>
	
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/dashboard.css?v=0.27' />
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/js/jquery-ui/jquery-ui.css' />
	
	<script src='<?= base_url(); ?>assets/js/jquery-ui/jquery-ui.js'></script>
	<script src='<?= base_url(); ?>assets/js/dashboard.js?v=0.37'></script>

</head>
<body>

	<div class='container'>
		
		<?php $this->view('common/top_bar'); ?>
		
		<div class='back container_dashboard_back'>
			
			<div class='front txt-c container_dashboard_front'>
				
				<div class='col container_nav'>
					<div 
						class='container_company_info'
						data-nav='profile'
						data-cpid='<?= $cpid; ?>'
					>
						<div class='nav_container_company_logo txt-c'>
							<div class='company_logo_border col'>
								<div class='nav_company_logo col'>
									<img 
										src='<?= base_url(); ?>assets/images/<?= $company[0] -> company_logo != '' ? 'company_logo/' . $company[0] -> company_pid . '/' . $company[0] -> company_logo : 'icons/icon_shop.png'; ?>' 
										class='img_company_logo'
									/>
								</div>
							</div>
						</div>
						<div class='container_company_name'>
							<?= $company[0] -> company_name; ?>
						</div>
					</div>

					<div 
						class='nav' 
						data-nav='dashboard'
						data-cpid='<?= $cpid; ?>'
					>
						Dashboard
					</div>

					<div 
						class='nav' 
						data-nav='outlet'
						data-cpid='<?= $cpid; ?>'
					>
						Outlet
					</div>

					<div 
						class='nav' 
						data-nav='campaign'
						data-cpid='<?= $cpid; ?>'
					>
						Campaign
					</div>

					<div 
						class='nav dashboard_nav_page' 
						data-nav='page'
						data-cpid='<?= $cpid; ?>'
					>
						Manage Pages
					</div>

					<div 
						class='nav' 
						data-nav='report'
						data-cpid='<?= $cpid; ?>'
					>
						Report
					</div>
				</div>
				
				<div class='col container_dashboard_main txt-c overflow_8px'>
					<div class='container_content'>
						<?php
						$param = $this->uri->segment(3);
						if($param != '') {
							$this->view('content_' . $param);
						} else {
							$this->view('content_dashboard'); 
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