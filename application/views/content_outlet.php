<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='txt-l container_content_dashboard'>
	<div class='content_header'>Outlets</div>
	
	<div class='container_main_address'>
		Address: 
	</div>
	
	<div class='container_outlet_content'>
		<div class='container_outlet_profile col'>
			<div>
				<div class='btn_add_outlet btn_square_orange'>Add Outlet</div>
			</div>
		
			<div class='container_table_outlet'>
				<table class='block_table_noborder table_outlet'>
					<thead>
						<tr>
							<th>#</th>
							<th>Outlet Name</th>
							<th>Telephone</th>
							<th>Address</th>
						</tr>
					</thead>
					
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class='container_add_outlet col'>
			<div class='container_add_outlet_top'>
				<div class='col btn_outlet_back'>
					&lt;
				</div>
				<div class='col container_outlet_header'>
					Add Outlet
				</div>
			</div>
			
			<div class='container_form_add_outlet'>
			
				<div class='row_input_campaign'>
					<div class='outlet_label col'>
						<div class='eform_label1'>
							Outlet Name
						</div>
					</div>
					<div class='outlet_input col'>
						<input 
							type='text' 
							class='input_txt1 outlet_input' 
							name='outlet_name' 
							autocomplete='off' 
							placeholder='i.e: Branch Number 2'
						>
									
						<div class='input_error input_error_outlet_name'></div>
					</div>
				</div>
				
				<div class='row_input_campaign'>
					<div class='outlet_label col'>
						<div class='eform_label1'>
							Telephone
						</div>
					</div>
					<div class='outlet_input col'>
						<input 
							type='text' 
							class='input_txt1 outlet_input' 
							name='outlet_telephone' 
							autocomplete='off' 
							placeholder='i.e: 0281654321'
						>
									
						<div class='input_error input_error_outlet_telephone'></div>
					</div>
				</div>
				
				<div class='row_input_campaign'>
					<div class='outlet_label col'>
						<div class='eform_label1'>
							Address
						</div>
					</div>
					<div class='outlet_input col'>
						<input 
							type='text' 
							class='input_txt1 outlet_input' 
							name='outlet_address' 
							autocomplete='off' 
							placeholder='i.e: Jl. Jend. Sudirman 999'
						>
									
						<div class='input_error input_error_outlet_address'></div>
					</div>
				</div>
				
				<div class='txt-r'>
					<div class='form_btn' id='btn_save_campaign'>Submit Outlet</div>
				</div>
				
			</div>
		</div>
	</div>
</div>