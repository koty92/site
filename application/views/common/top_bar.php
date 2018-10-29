<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_top_bar_back back'>

	<div class='container_top_bar_front front'>
		
		<div class='container_logo'>
			<a href='<?= base_url(); ?>' class='link_home'>
				<div class='main_logo'>
					<img src='<?= base_url(); ?>assets/images/logo_sipromo_150_maroon.png' class='logo_iklanapa_txt' />
				</div>
			</a>
		</div>
		
		<div class='container_menu'>
			<?php 
			$arr_uri = array('signup', 'signup_profile', 'company', 'about-us', 'contact-us', 'download', 'user');
			if(!in_array($this->uri->segment(1), $arr_uri)): ?>
				
				<div class='col main_menu' data-menu='publishers'>
					<div class='menu_text'>Publishers</div>
					<div class='menu_sign'></div>
				</div>
				
				<div class='col main_menu' data-menu='download'>
					<div class='menu_text'>Download</div>
					<div class='menu_sign'></div>
				</div>
				
				<?php if($this->uri->segment(1) != ''): ?>
					<a href='<?= base_url(); ?>about-us' class='hyperlink_normal'>
				<?php endif; ?>
						<div class='col main_menu' data-menu='about'>
							<div class='menu_text'>About Us</div>
							<div class='menu_sign'></div>
						</div>
				<?php if($this->uri->segment(1) != ''): ?>
					</a>
				<?php endif; ?>
				
				<div class='col main_menu' data-menu='contact'>
					<div class='menu_text'>Contact Us</div>
					<div class='menu_sign'></div>
				</div>
			<?php endif; ?>
		</div>
		
		<div class='font-0 container_login_nav'>
		
			<?php if($this->session->userdata('pid') > 0): ?>
				<div class='container_dashboard_nav'>
					<div class='main_btn_nav main_btn_nav_user'>
						Halo 
						<?php
						$pid = $this->session->userdata('pid');
						$this->db->select('user_name');
						$query = $this->db->get_where('data_user', array('user_pid' => $pid));
						$result = $query->result();
						echo $result[0] -> user_name;
						?>
					</div>
					<div class='container_user_nav none'>
						<?php //if($this->uri->segment(1) != 'company'): ?>
							<a href='<?= base_url(); ?>user/dashboard' class='hyperlink_normal'>
						<?php //endif; ?>
							<div class='user_nav nav_profile' data-nav='dashboard'>
								My Profile
							</div>
						<?php //if($this->uri->segment(1) != 'company'): ?>
							</a>
						<?php //endif; ?>
						
						<!--
						<?php if($this->uri->segment(1) != 'company'): ?>
							<a href='<?= base_url(); ?>company/campaign' class='hyperlink_normal'>
						<?php endif; ?>
							<div class='user_nav nav_profile' data-nav='campaign'>
								Create Campaign
							</div>
						<?php if($this->uri->segment(1) != 'company'): ?>
							</a>
						<?php endif; ?>
						-->
						
						<div class='user_nav nav_logout' data-nav='logout'>
							Sign Out
						</div>
					</div>
				</div>
			<?php else: ?>
				
				<?php if($this->uri->segment(1) != 'signup'): ?>
					<a href='<?= base_url(); ?>signup' class='hyperlink_normal'>
						<div class='main_btn_nav'>
							Get Started
						</div>
					</a>
				<?php endif; ?>
				<div class='main_btn_nav' id='btn_nav_login'>
					Log In
				</div>
			<?php endif; ?>
			
		</div>
		
	</div>

</div>

<div class='container_background_login'>

	<div class='container_background_front'>
	
		<div class='container_form_login'>
			<div>
				<input type='text' class='input_login login_email' placeholder='E-mail / Handphone'>
			</div>
			<div>
				<input type='password' class='input_login login_pass' placeholder='Password'>
			</div>
			<div class='txt-r'>
				<div class='form_btn' id='btn_login'>Log In</div>
			</div>
		</div>
	
	</div>
	
</div>