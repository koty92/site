<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='txt-l container_content_dashboard'>
	<div class='content_header'>Insert Item</div>
	
	<form id='form_catalogue' action='' method='post' enctype='multipart/form-data'>
	
		<div class='txt-l col container_form_campaign'>
			
			<div class='row_input_campaign'>
				<div class='campaign_label col'>
					Item Name
				</div>
				<div class='campaign_input col'>
					<input type='text' class='input_txt1 catalogue_txt_input' name='catalogue_name' autocomplete='off' placeholder='i.e: Clothes Clearance Sale'>
								
					<div class='input_error input_error_catalogue_name'></div>
				</div>
			</div>
					
			<div class='row_input_campaign'>
				<div class='campaign_label col'>
					Item Description
				</div>
				<div class='campaign_input col'>
					<input type='text' class='input_txt1 catalogue_txt_input' name='catalogue_desc' autocomplete='off' placeholder='i.e: Discount up tp 50% Off !'>
									
					<div class='input_error input_error_catalogue_desc'></div>
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
							'value' => '0',
							'id' => ''
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
					Item Image
				</div>
				<div class='campaign_input col'>
					<label for='logo_file'>
						<div class='btn_upload_img'>Upload File</div>
					</label>
					<input type='file' name='file' id='logo_file' class='none' />
					<div class='input_error input_error_img'></div>
				</div>
			</div>
								
			<div class='txt-r'>
				<div class='form_btn' id='btn_save_catalogue'>Save Item</div>
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

	</form>
	
</div>