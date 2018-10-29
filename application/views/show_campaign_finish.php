<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $cpid = $this->uri->segment(2); ?>

<div>

	<div class='container_success_image'>
		<img 
			src='<?= base_url(); ?>assets/images/icons/icon_check.png' 
			class='icon_img_success'
		/>
	</div>

	<div class='container_success_message'>
		Campaign Successfully Posted.
	</div>

	<div class='container_success_btn'>
		<div class='col btn_square_orange campaign_finish_btn' data-uri='campaign'>
			<div class='div_btn_campaign_finish'>
				Create Campaign
			</div>
		</div>

		<div class='col btn_square_green campaign_finish_btn' data-uri='page'>
			<div class='div_btn_campaign_finish'>
				Manage Page
			</div>
		</div>
	</div>

</div>