<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='txt-l container_content_dashboard'>
	<div class='content_header'>Create Campaign</div>
	<!--
	<div class='container_campaign_type'>
		<div class='col'>
			<?php
			$array = array('promotion', 'advertisement', 'survey');
			
			$data = array();
			foreach($array as $a) {
				$row = array();
				$row['data_value'] = $a;
				$row['data_text'] = ucfirst($a);
				$row = (object) $row;
				array_push($data, $row);
			}
									
			$data['result'] = $data;
			$data['name'] = 'select_type';
			$data['value'] = 'Tambah Kategori Baru';
			$data['id'] = 'select_campaign_type';
			$data['placeholder'] = 'Select Campaign Type';
			$this->view('eselect', $data);
			?>
		</div>
	</div>
	-->
	
	<form id='form_campaign' action='' method='post' enctype='multipart/form-data'>
		<?php $this->view('include/campaign_advertisement'); ?>
	</form>
	
</div>