<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<?php $this->view('common/header'); ?>
	
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home_desktop.css?v=0.11' />
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home_mobile.css?v=0.03' />
	
	<script src='<?= base_url(); ?>assets/js/home.js?v=0.03'></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">

</head>
<body>

	<div class='container'>
		
		<?php $this->view('common/top_bar'); ?>
		<?php $this->view('common/top_bar_mobile'); ?>
		
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
			
				<div class='container_main_front_download none main_front_element'>
					<div class='container_inline_contact_form'>
						<a target='_blank' class='uri_download_gps' href='https://play.google.com/store/apps/details?id=com.apa.sipromo'></a>

						<a target='_blank' class='uri_download_app' href='https://itunes.apple.com/id/app/sipromo/id1438326964?mt=8'></a>
					</div>
				</div>
				
				<div class='container_main_front_about none main_front_element'>
					<div class='container_main_front_invisible'>
						<a class='uri_home_about_us' href='<?= base_url(); ?>about-us'></a>
					</div>
				</div>
				
				<div class='container_main_front_contact none main_front_element'>
				
					<div class='container_inline_contact_form'>
				
						<div class='container_contact_header'>
							Have any questions or feedback ?
							<br />
							We will be happy to hear them
						</div>
					
						<div class='container_contact_form'>
							<div class='form_contact_row'>
								<input type='text' class='form_contact_input' placeholder='Full Name' />
							</div>
							<div class='form_contact_row'>
								<input type='text' class='form_contact_input' placeholder='E-mail Address' />
							</div>
							<div class='form_contact_row'>
								<input type='text' class='form_contact_input'placeholder='No. Handphone' />
							</div>
							<div class='form_contact_row'>
								<textarea class='form_contact_textarea' placeholder='Message'></textarea>
							</div>
							<div class='form_contact_row'>
								<div class='form_contact_btn'>
									Send Message
								</div>
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
				
				<div class='container_partners_back'>
					<div class='container_partners_front txt-c'>
						
						<div class='container_partners_title'>
							Our Partners
						</div>
						
						<div class='txt-c'>
							<div class='title_line'></div>
						</div>
						
						<div class='container_partners_content'>
							<img src='<?= base_url(); ?>assets/images/icons/icon_coming_soon_pink.png' class='icon_coming_soon'/>
						</div>
						
					</div>
				</div>
				
				<div class='container_member_of_back'>
					<div class='container_member_of_front txt-c'>
						<div class='container_member_of_header'>
							We are a member of
						</div>
						
						<div class='container_member_of_companies'>
							<div class='col container_member_of_logo'>
								<image 
									src='<?= base_url(); ?>assets/images/icons/logo_idx.jpg' 
									class='logo_idx'
								/>
							</div>
							
							<div class='col container_member_of_desc'>
								<div class='container_member_of_desc_title'>
									<a href='http://idxincubator.com/' target='_blank' class='hyperlink_black'>
										<div class='txt_desc_title'>
											IDX Incubator
										</div>
									</a>
								</div>
								
								
								IDX Incubator was established by the Indonesia Stock Exchange to support digital-based startup with wide-scale business prospects, in order to start building and growing its business.
								<br /><br />
								In the future, digital-based startup is believed to be the driving force of business acceleration in every industry line. Therefore, the Indonesia Stock Exchange took the initiative to become a facilitator to grow digital-based startups and bridge access to startups with Investors and Listed Companies.
							</div>
						</div>
					</div>
				</div>
				
				<?php $this->view('common/footer'); ?>
			</div>
		</div>
		
		<?php $this->view('common/loader'); ?>
		
	</div>
	
	<?php $this->view('common/mobile_side_bar'); ?>

</body>
</html>