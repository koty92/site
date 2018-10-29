<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper(array('file', 'site'));
	}

	public function show_create_campaign() {
		$this->load->view('create_campaign_view');
	}
	
	public function load_campaign_type() {
		$type = $this->uri->segment(3);
		$this->load->view('include/campaign_' . $type);
	}
	
	public function save_campaign() {
		date_default_timezone_set('Asia/Jakarta');
		$datetime = date('Y-m-d H:i:s');
		
		$cpid = $this->input->post('company_pid');
		$campaign_type = $this->input->post('campaign_type');
		$date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
		$err_date = $err_options = 0;
		
		$data = array(
			'company_pid' => $cpid,
			'campaign_type' => $campaign_type,
			'campaign_title' => $this->input->post('campaign_title'),
			'campaign_created' => $datetime,
			'campaign_date_from' => $date_from,
			'campaign_date_to' => $date_to,
		);
		
		if($campaign_type == '1') {
			$category_pid = $this->input->post('promo_category');
			$promo_category = $this->input->post('new_category');
		
			if($promo_category == '') {
				$this->form_validation->set_rules('promo_category', 'Product Category', 'required');
			}
			
			$data['campaign_desc'] = $this->input->post('campaign_desc');
			
			//$this->form_validation->set_rules('campaign_desc', 'Campaign Description', 'required');
		} elseif($campaign_type == '2') {
			$options = $this->input->post('campaign_option');
			$category_pid = $this->input->post('promo_category');
			$promo_category = $this->input->post('new_category');

			/*foreach($options as $o) {
				if($o == '') {
					$err_options = 1;
				}
			}*/
			
			if($promo_category == '') {
				$this->form_validation->set_rules('promo_category', 'Product Category', 'required');
			}
		
			$data['campaign_question'] = $this->input->post('campaign_question');
			$data['campaign_option1'] = $options[0];
			$data['campaign_option2'] = $options[1];
			$data['campaign_option3'] = $options[2];
			$data['campaign_option4'] = $options[3];
			$data['campaign_answer'] = $this->input->post('campaign_answer');
			$data['target_gender'] = $this->input->post('target_gender');
			$data['target_age'] = $this->input->post('target_age');
			$data['campaign_desc'] = $this->input->post('campaign_desc');
			$data['campaign_point'] = $this->input->post('campaign_point');
			$data['campaign_quota'] = $this->input->post('campaign_quota');
			
			//$this->form_validation->set_rules('campaign_question', 'Campaign Question', 'required');
			$this->form_validation->set_rules('target_gender', 'Target Gender', 'required');
			$this->form_validation->set_rules('target_age', 'Target Age', 'required');
			//$this->form_validation->set_rules('campaign_answer', 'Campaign Answer', 'required');
			//$this->form_validation->set_rules('campaign_desc', 'Campaign Description', 'required');
		}
		
		$this->form_validation->set_rules('campaign_title', 'Campaign Title', 'required');
		$this->form_validation->set_rules('date_from', 'Date From', 'required', array('required' => 'Date From is required'));
		$this->form_validation->set_rules('date_to', 'Date To', 'required', array('required' => 'Date To is required'));
		
		if($date_to < $date_from) {
			$err_date = 1;
		}
		
		if($this->form_validation->run() == TRUE && !(empty($_FILES['file']['name'])) && $err_date == 0 && $err_options == 0) {
			// Save promo category
			//if($campaign_type == '1') {
				if($category_pid == '0' || $category_pid == '') {
					if($this->db->insert('promo_category', array('category_name' => $promo_category, 'company_pid' => $cpid))) {
						$category_pid = $this->db->insert_id();
						$data['category_pid'] = $category_pid;
					}
				}
				$data['category_pid'] = $category_pid;
			//}
			
			if($this->db->insert('campaign', $data)) {
				$campaign_id = $this->db->insert_id();
				
				// If upload image
				if(!(empty($_FILES['file']['name']))) {
					$dir = './assets/images/campaigns/' . $cpid;
					if(!is_dir($dir)) {
						if(mkdir($dir, 0777, TRUE)) {
							$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
							write_file("$dir/index.html", $index);
						}
					}
					
					$dir_campaign = $dir . '/' . $campaign_id;
					if(!is_dir($dir_campaign)) {
						if(mkdir($dir_campaign, 0777, TRUE)) {
							$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
							write_file("$dir/index.html", $index);
						}
					}
					
					$config['upload_path'] = $dir_campaign;
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 2000;
					$this->load->library('upload', $config);
					$file = $this->upload->data();
					
					if($this->upload->do_upload('file')) {
						$this->db->set('campaign_image', space_to_underscore($_FILES['file']['name']));
						$this->db->where('campaign_pid', $campaign_id);
						if($this->db->update('campaign')) {
							$result['success'] = '1';
							$result['campaign_pid'] = $campaign_id;
							echo json_encode($result);
						}
					}
				}
			} else {
				echo 'Unknown Error';
			}
		} else {
			$errors = array();
			$errors = $this->form_validation->error_array();
			
			if(empty($_FILES['file']['name'])) {
				$errors['img'] = 'Please upload image';
			}
			
			if($err_date == 1) {
				$errors['date_from'] = 'Date To is lesser than Date From';
			}
			
			if($err_options == 1) {
				$errors['campaign_options'] = 'Please provide 4 answer options';
			}
			
			echo json_encode($errors);
		}
	}
	
	public function save_promotion() {
		date_default_timezone_set('Asia/Jakarta');
		$datetime = date('Y-m-d H:i:s');
		
		$date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
		$err_date = 0;
		
		$data = array(
			'company_pid' => $this->session->userdata('pid'),
			'campaign_title' => $this->input->post('campaign_title'),
			'campaign_text' => $this->input->post('campaign_text'),
			'campaign_created' => $datetime,
			'campaign_date_from' => $date_from,
			'campaign_date_to' => $date_to,
			'target_gender' => $this->input->post('target_gender')
		);
		
		$this->form_validation->set_rules('campaign_title', 'Campaign Title', 'required');
		$this->form_validation->set_rules('campaign_text', 'Campaign Description', 'required');
		$this->form_validation->set_rules('date_from', 'Date From', 'required', array('required' => 'Date From is required'));
		$this->form_validation->set_rules('date_to', 'Date To', 'required', array('required' => 'Date To is required'));
		$this->form_validation->set_rules('target_gender', 'Target Gender', 'required');
		
		if($date_to < $date_from) {
			$err_date = 1;
		}
		
		if($this->form_validation->run() == TRUE && !(empty($_FILES['file']['name'])) && $err_date == 0) {
			if($this->db->insert('campaign', $data)) {
				$campaign_id = $this->db->insert_id();
				
				// If upload image
				if(!(empty($_FILES['file']['name']))) {
					$dir = './assets/images/campaigns/' . $this->session->userdata('pid');
					if(!is_dir($dir)) {
						if(mkdir($dir, 0777, TRUE)) {
							$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
							write_file("$dir/index.html", $index);
						}
					}
					
					$dir_campaign = $dir . '/' . $campaign_id;
					if(mkdir($dir_campaign, 0777, TRUE)) {
						$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
						write_file("$dir/index.html", $index);
					}
					
					$config['upload_path'] = $dir_campaign;
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 1000;
					$this->load->library('upload', $config);
					$file = $this->upload->data();
					
					if($this->upload->do_upload('file')) {
						$this->db->set('campaign_image', space_to_underscore($_FILES['file']['name']));
						$this->db->where('campaign_pid', $campaign_id);
						if($this->db->update('campaign')) {
							$result['success'] = '1';
							$result['campaign_pid'] = $campaign_id;
							echo json_encode($result);
						}
					}
				}
			}
		} else {
			$errors = array();
			$errors = $this->form_validation->error_array();
			if(empty($_FILES['file']['name'])) {
				$errors['img'] = 'Please upload image';
			}
			if($err_date == 1) {
				$errors['date_from'] = 'Date To is lesser than Date From';
			}
			echo json_encode($errors);
		}
	}
	
	public function save_advertisement() {
		date_default_timezone_set('Asia/Jakarta');
		$datetime = date('Y-m-d H:i:s');
		
		$date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
		$options = $this->input->post('campaign_option');
		
		$err_date = $err_options = 0;
		
		/*foreach($options as $o) {
			if($o == '') {
				$err_options = 1;
			}
		}*/
		
		$data = array(
			'company_pid' => $this->session->userdata('pid'),
			'ads_title' => $this->input->post('ads_title'),
			'ads_question' => $this->input->post('ads_question'),
			'ads_created' => $datetime,
			'ads_date_from' => $date_from,
			'ads_date_to' => $date_to,
			'option1' => $options[0],
			'option2' => $options[1],
			'option3' => $options[2],
			'option4' => $options[3],
			'ads_answer' => $this->input->post('ads_answer'),
			'target_gender' => $this->input->post('target_gender'),
			'target_age' => $this->input->post('target_age'),
		);
		
		$this->form_validation->set_rules('ads_title', 'Campaign Title', 'required');
		//$this->form_validation->set_rules('ads_question', 'Campaign Question', 'required');
		$this->form_validation->set_rules('date_from', 'Date From', 'required', array('required' => 'Date From is required'));
		$this->form_validation->set_rules('date_to', 'Date To', 'required', array('required' => 'Date To is required'));
		$this->form_validation->set_rules('target_gender', 'Target Gender', 'required');
		$this->form_validation->set_rules('target_age', 'Target Age', 'required');
		//$this->form_validation->set_rules('ads_answer', 'Campaign Answer', 'required');
		
		if($date_to < $date_from) {
			$err_date = 1;
		}
		
		if($this->form_validation->run() == TRUE && !(empty($_FILES['file']['name'])) && $err_date == 0 && $err_options == 0) {
			if($this->db->insert('ads', $data)) {
				$campaign_id = $this->db->insert_id();
				
				// If upload image
				if(!(empty($_FILES['file']['name']))) {
					$dir = './assets/images/ads/' . $this->session->userdata('pid');
					if(!is_dir($dir)) {
						if(mkdir($dir, 0777, TRUE)) {
							$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
							write_file("$dir/index.html", $index);
						}
					}
					
					$dir_campaign = $dir . '/' . $campaign_id;
					if(mkdir($dir_campaign, 0777, TRUE)) {
						$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
						write_file("$dir/index.html", $index);
					}
					
					$config['upload_path'] = $dir_campaign;
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 100000;
					$this->load->library('upload', $config);
					$file = $this->upload->data();
					
					if($this->upload->do_upload('file')) {
						$this->db->set('ads_image', space_to_underscore($_FILES['file']['name']));
						$this->db->where('ads_pid', $campaign_id);
						if($this->db->update('ads')) {
							$result['success'] = '1';
							$result['ads_pid'] = $campaign_id;
							echo json_encode($result);
						}
					}
				}
			}
		} else {
			$errors = array();
			$errors = $this->form_validation->error_array();
			
			if(empty($_FILES['file']['name'])) {
				$errors['img'] = 'Please upload image';
			}
			
			if($err_date == 1) {
				$errors['date_from'] = 'Date To is lesser than Date From';
			}
			
			if($err_options == 1) {
				$errors['ads_options'] = 'Please provide 4 answer options';
			}
			
			echo json_encode($errors);
		}
	}
	
	public function show_campaign() {
		$cpid = $this->uri->segment(3);
		$this->load->view('show_campaign_finish');
	}
	
	public function insert_invoice() {
		date_default_timezone_set('Asia/Jakarta');
		$date = date('ym');
		
		$data['company_pid'] = $this->session->userdata('pid');
		$data['campaign_pid'] = $this->uri->segment(3);
		if($this->db->insert('invoice', $data)) {
			$pid = $this->db->insert_id();
			
			echo $pid;
		}
	}
	
	public function show_invoice() {
		$invoice_pid = $this->uri->segment(3);
		
		$this->db->from('invoice a');
		$this->db->join('campaign b', 'a.campaign_pid = b.campaign_pid', 'left');
		$this->db->where('a.invoice_pid', $invoice_pid);
		$query = $this->db->get();
		
		$data['result'] = $query->result();
		$this->load->view('invoice_view', $data);
	}
	
	public function save_catalogue() {
		date_default_timezone_set('Asia/Jakarta');
		$datetime = date('Y-m-d H:i:s');
		
		$cpid = $this->session->userdata('pid');
		$category_pid = $this->input->post('promo_category');
		
		if($category_pid == '0') {
			$promo_category = $this->input->post('new_category');
			
			if($this->db->insert('promo_category', array('category_name' => $promo_category, 'company_pid' => $cpid))) {
				$category_pid = $this->db->insert_id();
			}
		}
		
		$data = array(
			'company_pid' => $cpid,
			'category_pid' => $category_pid,
			'catalogue_created' => $datetime,
			'catalogue_name' => $this->input->post('catalogue_name'),
			'catalogue_desc' => $this->input->post('catalogue_desc'),
		);
		
		$this->form_validation->set_rules('catalogue_name', 'Item Name', 'required');
		$this->form_validation->set_rules('catalogue_desc', 'Item Description', 'required');
		$this->form_validation->set_rules('promo_category', 'Item Category', 'required');
		
		if($this->form_validation->run() == TRUE && !(empty($_FILES['file']['name']))) {
			if($this->db->insert('catalogue', $data)) {
				$catalogue_id = $this->db->insert_id();
				
				// If upload image
				if(!(empty($_FILES['file']['name']))) {
					$dir = './assets/images/catalogue/' . $this->session->userdata('pid');
					if(!is_dir($dir)) {
						if(mkdir($dir, 0777, TRUE)) {
							$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
							write_file("$dir/index.html", $index);
						}
					}
					
					$dir_campaign = $dir . '/' . $catalogue_id;
					if(mkdir($dir_campaign, 0777, TRUE)) {
						$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
						write_file("$dir/index.html", $index);
					}
					
					$config['upload_path'] = $dir_campaign;
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 1000;
					$this->load->library('upload', $config);
					$file = $this->upload->data();
					
					if($this->upload->do_upload('file')) {
						$this->db->set('catalogue_image', space_to_underscore($_FILES['file']['name']));
						$this->db->where('catalogue_pid', $catalogue_id);
						if($this->db->update('catalogue')) {
							$result['success'] = '1';
							$result['catalogue_pid'] = $catalogue_id;
							echo json_encode($result);
						}
					}
				}
			}
		} else {
			$errors = array();
			$errors = $this->form_validation->error_array();
			
			if(empty($_FILES['file']['name'])) {
				$errors['img'] = 'Please upload image';
			}
			
			echo json_encode($errors);
		}
	}

}

?>