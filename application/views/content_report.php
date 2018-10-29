<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='txt-l container_content_dashboard'>
	<div class='content_header'>Campaign Report</div>
	
	<div>
		<div>
			<div>
				<div class='col'>
					<?php
					$array = array('All Campaign', 'Active Campaign', 'Past Campaign');
					$value = array('1', '2', '3');
					
					$data = array();
					for($i = 0; $i < 3; $i++) {
						$row = array();
						$row['data_value'] = $value[$i];
						$row['data_text'] = ucfirst($array[$i]);
						$row = (object) $row;
						array_push($data, $row);
					}
											
					$data['result'] = $data;
					$data['name'] = 'select_type';
					$data['id'] = 'select_report_type';
					$this->view('eselect', $data);
					?>
				</div>
			</div>
		</div>
		
		<div class='container_report_result'>
			<div class='container_list_campaign col'></div>
			
			<div class='container_report_content col'></div>
		</div>
	</div>
	
</div>