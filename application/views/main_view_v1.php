<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<?php $this->view('common/header'); ?>
	
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home_desktop.css?v=0.05' />

</head>
<body>

	<div class='container'>
		
		<?php $this->view('common/top_bar'); ?>
		
		<div class='container_mid'>
			<div class='container_background'>
				<div class='background_initial background_home'>
					

				</div>
				
				<div class='background_publishers background_home none'>
				</div>
				
				<div class='background_download background_home none'>
					
				</div>
				
				<div class='background_about background_home none'>
				</div>
				
				<div class='background_contact background_home none'>
				</div>
			</div>
			
			<div class='container_front_background txt-c'>
				<div class='container_main_front_contact'>
				
					<div class='container_contact_header'>
						Have any questions or feedback ?
						<br />
						We will be happy to hear them
					</div>
				
					<div class='container_contact_form'>
						<div class='form_contact_row'>
							<input type='text' class='form_contact_input' />
						</div>
						<div class='form_contact_row'>
							<input type='text' class='form_contact_input' />
						</div>
						<div class='form_contact_row'>
							<input type='text' class='form_contact_input' />
						</div>
						<div class='form_contact_row'>
							<div class='form_contact_btn'>
								Send Message
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class='container_main_bot'>
				<div class='container_main_desc'>
				<!--
					<div class='container_table_icons txt-c'>
						<table class='col'>
							<tr>
								<td class='td_icon_desc'>
									<img src='<?= base_url(); ?>assets/images/icons/icon_effectiveness_purple.png' class='icon_desc' />
								</td class='td_icon_desc'>
								<td class='td_icon_desc'>
									<img src='<?= base_url(); ?>assets/images/icons/icon_cheap_purple.png' class='icon_desc' />
								</td>
								<td class='td_icon_desc'>
									<img src='<?= base_url(); ?>assets/images/icons/icon_user_friendly_purple.png' class='icon_desc' />
								</td>
								<td class='td_icon_desc'>
									<img src='<?= base_url(); ?>assets/images/icons/icon_target_purple.png' class='icon_desc' />
								</td>
							</tr>
							<tr>
								<td class='td_desc'>Increase Effectiveness</td>
								<td class='td_desc'>Save Costs</td>
								<td class='td_desc'>User Friendly</td>
								<td class='td_desc'>Targeted Audience</td>
							</tr>
							<tr class='tr_desc_txt'>
								<td>
									<div class='container_txt_desc'>
										Unlike any other advertising platforms, we require audience to perform an action, interacting with the advertisement to ensure that the audience receive and understand the brand
									</div>
								</td>
								
								<td>
									<div class='container_txt_desc'>
										Cheaper than any other advertising platform out there, with cheaper cost advertisers can reach more audience with the same budget.
									</div>
								</td>
								
								<td>
									<div class='container_txt_desc'>
										Very easy to use, either from advertisers or audience both may use our platform easily in no time. Our app is designed as simple as possible
									</div>
								</td>
								
								<td>
									<div class='container_txt_desc'>
										Advertisers are able to filter their advertisements and promotions and target the audience so that the campaign will reach the right audience
									</div>
								</td>
							</tr>
						</table>
					</div>
					-->
					
					<div class='txt-c container_home_desc'>
						<div class='col col_home_desc'>
							<div class='container_desc_img'>
								<img src='<?= base_url(); ?>assets/images/icons/icon_effectiveness_purple.png' class='icon_desc' />
							</div>
							<div class='container_desc_title'>
								Increase Effectiveness
							</div>
							<div class='container_desc_txt'>
								Unlike any other advertising platforms, we require audience to perform an action, interacting with the advertisement to ensure that the audience receive and understand the brand
							</div>
						</div>
						
						<div class='col col_home_desc'>
							<div class='container_desc_img'>
								<img src='<?= base_url(); ?>assets/images/icons/icon_cheap_purple.png' class='icon_desc' />
							</div>
							<div class='container_desc_title'>
								Save Costs
							</div>
							<div class='container_desc_txt'>
								Cheaper than any other advertising platform out there, with cheaper cost advertisers can reach more audience with the same budget
							</div>
						</div>
						
						<div class='col col_home_desc'>
							<div class='container_desc_img'>
								<img src='<?= base_url(); ?>assets/images/icons/icon_user_friendly_purple.png' class='icon_desc' />
							</div>
							<div class='container_desc_title'>
								User Friendly
							</div>
							<div class='container_desc_txt'>
								Very easy to use, either from advertisers or audience both may use our platform easily in no time. Our app is designed as simple as possible
							</div>
						</div>
						
						<div class='col col_home_desc'>
							<div class='container_desc_img'>
								<img src='<?= base_url(); ?>assets/images/icons/icon_target_purple.png' class='icon_desc' />
							</div>
							<div class='container_desc_title'>
								Targeted Audience
							</div>
							<div class='container_desc_txt'>
								Advertisers are able to filter their advertisements and promotions and target the audience so that the campaign will reach the right audience
							</div>
						</div>
					</div>
				</div>
				
				<div class='container_main_footer_back'>
					<div class='container_main_footer_front txt-l'>
						<div class='container_footer'>
							<div class='col container_footer_questions'>
								<div class='container_txt_questions'>
									Have any questions or feedback ?
									<br />
									Please feel free to contact us
								</div>
								<div class='container_img_questions'>
									<div class='col div_icon_mail'>
										<img src='<?= base_url(); ?>assets/images/icons/icon_mail_white.png' class='icon_mail' />
									</div>
									<div class='col div_img_email'>
										<img src='<?= base_url(); ?>assets/images/email_cs.png' class='img_email' />
									</div>
								</div>
							</div>
							
							<div class='col container_footer_menu'>
								<div class='col container_footer_menu_socmed'>
									<div class='container_footer_title'>
										About Us
									</div>
									
									<div class='container_footer_socmed'>
										<div class='container_footer_submenu'>
											About IklanApa
										</div>
										
										<div class='container_footer_submenu'>
											Career
										</div>
										
										<div class='container_footer_submenu'>
											Site Map
										</div>
										
										<div class='container_footer_submenu'>
											Contact Us
										</div>
										
										<div class='container_footer_submenu'>
											Privacy Policy
										</div>
										
										<div class='container_footer_submenu'>
											Terms & Conditions
										</div>
									</div>
								</div>
								
								<div class='col container_footer_menu_socmed'>
									<div class='container_footer_title'>
										Social Media
									</div>
									
									<div class='container_footer_socmed'>
										<div class='container_socmed'>
											<div class='col'>
												<img src='<?= base_url(); ?>assets/images/icons/icon_fb_white.png' class='icon_fb'>
											</div>
											<div class='col socmed_txt'>Facebook</div>
										</div>
										
										<div class='container_socmed'>
											<div class='col'>
												<img src='<?= base_url(); ?>assets/images/icons/icon_ig_white.png' class='icon_ig'>
											</div>
											<div class='col socmed_txt'>Instagram</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
				
				<div class='footer_copyright'>
					&copy 2018 IklanApa.com
				</div>
			</div>
		</div>
		
		<?php $this->view('common/loader'); ?>
		
	</div>

</body>
</html>