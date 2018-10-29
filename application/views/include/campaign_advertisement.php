<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$cpid = $this->uri->segment(2);
$cpid = $cpid / 92771499 - 5;
?>

<div class='txt-l col container_form_campaign'>
	
	<input type='hidden' name='campaign_type' value='2'>
	<input type='hidden' name='company_pid' value='<?= $cpid ?>' />
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Campaign Title
		</div>
		<div class='campaign_input col'>
			<input type='text' class='input_txt1 campaign_title' name='campaign_title' autocomplete='off' placeholder='i.e: Clothes Clearance Sale'>
						
			<div class='input_error input_error_campaign_title'></div>
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
				$this->db->select('category_pid as data_value, category_name as data_text');
				$this->db->order_by('category_name');
				$query = $this->db->get_where('promo_category', array('company_pid' => $cpid));
							
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
			Campaign Description
		</div>
		<div class='campaign_input col'>
			<!--<input type='text' class='input_txt1 campaign_title promotion_desc' name='campaign_text' autocomplete='off' placeholder='i.e: Discount up tp 50% Off !'>-->
			<textarea class='promotion_desc' name='campaign_desc' placeholder='i.e: Discount up to 50% Off !' style='width: 355px; height: 100px; padding: 10px; border: 1px solid #cacaca'></textarea>
							
			<div class='input_error input_error_campaign_text'></div>
		</div>
	</div>
	
	<div class='container_target_header'>
		<div class='col_header'>
			Boost Your Campaign
		</div>
		
		<div class='col_header'>
			<image 
				src='<?= base_url(); ?>assets/images/icons/icon_info2_grey.png'
				class='campaign_icon_info'
			/>
		</div>
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Campaign Bid (IDR)
		</div>
		<div class='campaign_input col'>
			<input type='text' class='input_txt1 campaign_title campaign_point' name='campaign_point' autocomplete='off' placeholder='i.e: 5000'>
						
			<div class='input_error input_error_campaign_point'></div>
		</div>
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Campaign Quota
		</div>
		<div class='campaign_input col'>
			<input type='text' class='input_txt1 campaign_title campaign_quota' name='campaign_quota' autocomplete='off' placeholder='i.e: 1000 / Days'>
						
			<div class='input_error input_error_campaign_quota'></div>
		</div>
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Campaign Question
		</div>
		<div class='campaign_input col'>
			<input type='text' class='input_txt1 campaign_title campaign_question' name='campaign_question' autocomplete='off' placeholder='i.e: What is the brand of the product shown ?'>
						
			<div class='input_error input_error_campaign_question'></div>
		</div>
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Campaign Answers
		</div>
		<div class='campaign_input col'>
			<input type='text' class='input_txt1 campaign_answer answer' name='campaign_option[]' autocomplete='off' data-option='1' placeholder='i.e: Brand A'>
			<input type='text' class='input_txt1 campaign_answer answer' name='campaign_option[]' autocomplete='off' data-option='2'  placeholder='i.e: Brand B'>
			<input type='text' class='input_txt1 campaign_answer answer' name='campaign_option[]' autocomplete='off' data-option='3'  placeholder='i.e: Brand C'>
			<input type='text' class='input_txt1 campaign_answer answer' name='campaign_option[]' autocomplete='off' data-option='4'  placeholder='i.e: Brand D'>
						
			<div class='input_error input_error_campaign_options'></div>
		</div>
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			Correct Answer
		</div>
		<div class='campaign_input col'>
			<div style='padding: 15px 0 0 0;'>
				<?php
				$array = array('1', '2', '3', '4');
				
				$data = array();
				foreach($array as $a) {
					$row = array();
					$row['data_value'] = $a;
					$row['data_text'] = 'Option ' . $a;
					$row = (object) $row;
					array_push($data, $row);
				}
										
				$data['result'] = $data;
				$data['name'] = 'campaign_answer';
				$data['id'] = 'select_correct_answer';
				$data['placeholder'] = 'Select Answer';
				$this->view('eselect', $data);
				?>
			</div>
						
			<div class='input_error input_error_campaign_answer'></div>
		</div>
	</div>
			
	<div class='container_target_header'>
		Target Audience
	</div>
	
	<div class='row_input_campaign'>
		<div class='campaign_label col'>
			City
		</div>
		<div class='campaign_input col'>
			<div style='padding: 15px 0 0 0;'>
				<?php
				$this->db->select('city_pid as data_value, city_name as data_text');
				$this->db->order_by('city_name');
				$query = $this->db->get_where('data_city');

				$data = array(
					'result' => $query->result(),
					'name' => 'target_city',
					'placeholder' => 'Target City',
					'id' => 'select_target_city'
				);
				$this->view('eselect', $data);
				?>
			</div>
			
			<div class='input_error input_error_target_city'></div>
		</div>
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
			<div>
				<div class='col option_age_all'>
					All
				</div>
				<div class='col'>
					<div class='col'>
						<input type='number' class='input_txt1 input_age_from' placeholder='Age From' name='age_from' autocomplete='off'>
					</div>
					<div class='col container_dash'>-</div>
					<div class='col'>
						<input type='number' class='input_txt1 input_age_to' placeholder='Age To' name='age_to' autocomplete='off'>
					</div>
				</div>
			</div>
			
			<input type='hidden' name='target_age' class='input_target_age' />
			<div class='input_error input_error_target_age'></div>
		</div>
	</div>
						
	<div class='txt-r'>
		<div class='form_btn' id='btn_save_campaign'>Save Campaign</div>
	</div>
						
</div>
					
<div class='col container_preview'>
	<div class='preview_header'>
		Preview
	</div>
		
	<div class='col container_phone_preview'>
		<div class='container_preview_top'></div>
		
		<div class='container_preview_img'>
			<img id='previewimg' />
		</div>
		
		<div class='container_preview_bot'>
			<div class="container_preview_question pq_placeholder">
				Question
			</div>
			<div class="container_preview_answers">
				<div class="preview_answer pa_1 pq_placeholder">A.</div>
				<div class="preview_answer pa_2 pq_placeholder">B.</div>
				<div class="preview_answer pa_3 pq_placeholder">C.</div>
				<div class="preview_answer pa_4 pq_placeholder">D.</div>
			</div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function() {
		var dateFormat = 'dd-mm-yy',
		from = $('.datepicker_from').datepicker({
			defaultDate: '',
			changeMonth: true,
			dateFormat: 'dd-mm-yy',
		}).on('change', function() {
			to.datepicker('option', 'minDate', getDate(this));
		}),
		to = $('.datepicker_to').datepicker({
			defaultDate: '',
			changeMonth: true,
			dateFormat: 'dd-mm-yy'
		}).on('change', function() {
			from.datepicker('option', 'maxDate', getDate(this));
		});

		function getDate(element) {
			var date;
			try{
				date = $.datepicker.parseDate(dateFormat, element.value);
			} catch(error) {
				date = null;
			}

			return date;
		}
	});

</script>