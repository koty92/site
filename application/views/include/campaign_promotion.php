<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='txt-l col container_form_campaign'>
	
	<input type='hidden' name='campaign_type' value='1'>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Campaign Title
		</div>
		<div class='campaign_input col'>
			<input type='text' class='input_txt1 campaign_title promotion_title' name='campaign_title' autocomplete='off' placeholder='i.e: Clothes Clearance Sale'>
						
			<div class='input_error input_error_campaign_title'></div>
		</div>
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Image
		</div>
		<div class='campaign_input col'>
			<label for='logo_file'>
				<div class='btn_upload_img'>Upload File</div>
			</label>
			<input type='file' name='file' id='logo_file' class='none' />
			<div class='input_error input_error_img'></div>
		</div>
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Promo Category
		</div>
		<div class='campaign_input col'>
			<div class='col' style='padding: 15px 0 0 0;'>
				<?php
				$pid = $this->session->userdata('pid');
				$this->db->select('category_pid as data_value, category_name as data_text');
				$this->db->order_by('category_name');
				$query = $this->db->get_where('promo_category', array('company_pid' => $pid));
							
				$data_cat = array(
					'result' => $query->result(),
					'name' => 'promo_category',
					'placeholder' => 'Tambah Kategori Baru',
					'id' => '',
					'value' => ''
				);
				$this->view('eselect', $data_cat);
				?>
			</div>
				
			<div class='col'>
				&nbsp&nbsp&nbsp
				<input type='text' class='input_txt1 input_new_category' placeholder='Category Name' name='new_category' autocomplete='off'>
			</div>
					
			<div class='input_error input_error_promo_category'></div>
		</div>
	</div>
						
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Time Period
		</div>
		<div class='campaign_input col'>
			<div class='col'>
				<input type='text' class='input_txt1 input_date_from datepicker_from' placeholder='Date From' name='date_from' autocomplete='off'>
						
				<div class='input_error input_error_date_from'></div>
			</div>
			<div class='col container_dash'>-</div>
			<div class='col'>
				<input type='text' class='input_txt1 input_date_to datepicker_to' placeholder='Date To' name='date_to' autocomplete='off'>
						
				<div class='input_error input_error_date_to'></div>
			</div>
		</div>
	</div>
			
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Campaign Description
		</div>
		<div class='campaign_input col'>
			<!--<input type='text' class='input_txt1 campaign_title promotion_desc' name='campaign_text' autocomplete='off' placeholder='i.e: Discount up tp 50% Off !'>-->
			<textarea class='promotion_desc' name='campaign_desc' placeholder='i.e: Discount up to 50% Off !' style='width: 355px; height: 100px; padding: 10px; border: 1px solid #cacaca'></textarea>
							
			<div class='input_error input_error_campaign_text'></div>
		</div>
	</div>
			
	<!--
	<div class='container_target_header'>
		Target Audience
	</div>
			
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Gender
		</div>
		<div class='campaign_input col'>
			<div class='container_option_gender'>
				<div class='col option_gender' data-gender='0'>
					All
				</div>
				<div class='col option_gender' data-gender='1'>
					Men
				</div>
				<div class='col option_gender' data-gender='2'>
					Women
				</div>
				<input type='hidden' name='target_gender' class='input_target_gender' />
			</div>
			
			<div class='input_error input_error_target_gender'></div>
		</div>
	</div>
			
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Age
		</div>
		<div class='campaign_input col'>
			<div class='col option_age_all'>
				All
			</div>
			<div class='col'>
				<div class='col'>
					<input type='number' class='input_txt1 input_age_from' placeholder='Age From' name='age_from' autocomplete='off'>
							
					<div class='input_error input_error_target_age_from'></div>
				</div>
				<div class='col container_dash'>-</div>
				<div class='col'>
					<input type='number' class='input_txt1 input_age_to' placeholder='Age To' name='age_to' autocomplete='off'>
						
					<div class='input_error input_error_target_age_to'></div>
				</div>
			</div>
		</div>
	</div>
	-->
						
	<div class='txt-r'>
		<div class='form_btn' id='btn_save_campaign'>Save Campaign</div>
	</div>
						
</div>
					
<div class='col container_preview'>
	<div class='preview_header'>
		Preview
	</div>
		
	<div class='col container_phone_preview'>
		
		<div class='container_preview_top'>
			<div class='container_preview_title pq_placeholder'>
				Campaign Title
			</div>
		</div>
		
		<div class='container_preview_img'>
			<img id='previewimg' />
		</div>
		
		<div class='container_preview_bot'>
			<div class='container_preview_desc pq_placeholder'>
				Campaign Description
			</div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function() {
		from = $('.datepicker_from').datepicker({
			defaultDate: '',
			changeMonth: true,
			dateFormat: 'dd-mm-yy'
		}).on('change', function() {
			var elem = $(this);
			to.datepicker('option', 'minDate', getDate(elem));
		}),
		to = $('.datepicker_to').datepicker({
			defaultDate: '',
			changeMonth: true,
			dateFormat: 'dd-mm-yy'
		}).on('change', function() {
			from.datepicker('option', 'maxDate', getDate(this));
		});
	});

</script>