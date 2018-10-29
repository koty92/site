<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('company_model', 'campaign_model', 'api/v5/api_model'));
		$this->load->helper(array('file', 'site'));
	}
	
	public function signup() {
		$data['result'] = '';
		if($this->session->userdata('temp_pid') != '') {
			$pid = $this->session->userdata('temp_pid');
			$this->db->select('company_name');
			$query = $this->db->get_where('data_company', array('company_pid' => $pid));
			$data['result'] = $query->result();
		}
		$this->load->view('signup_view', $data);
	}
	
	public function register() {
		date_default_timezone_set('Asia/Jakarta');
		$datetime = date('Y-m-d H:i:s');
		
		$data = array(
			'company_email' => $this->input->post('email'),
			'company_password' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
			'company_created' => $datetime
		);
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('valid_email' => 'Please input a valid email address'));
		$this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric|min_length[6]', array('min_length' => 'Password must be at least 6 characters'));
		
		if($this->form_validation->run() == TRUE) {
			if($this->db->insert('data_company', $data)) {
				$cpid = $this->db->insert_id();
				echo '1';
				$this->session->set_userdata('pid', $cpid);
			}
		} else {
			echo json_encode($this->form_validation->error_array());
		}
	}
	
	public function save_detail() {
		$data = array(
			'company_name' => $this->input->post('detail_name'),
			'company_npwp' => $this->input->post('detail_npwp'),
			'company_address' => $this->input->post('detail_address'),
			'company_telephone' => $this->input->post('detail_telephone')
		);
		
		$this->form_validation->set_rules('detail_name', 'Company Name', 'required');
		$this->form_validation->set_rules('detail_address', 'Address', 'required');
		$this->form_validation->set_rules('detail_telephone', 'Telephone', 'required');
		
		if($this->form_validation->run() == TRUE) {
			$cpid = $this->session->userdata('pid');
			$this->db->where('company_pid', $cpid);
			if($this->db->update('data_company', $data)) {
				
				// If upload image
				if(!(empty($_FILES['file']['name']))) {
					$dir = './assets/images/company_logo/' . $cpid;
					if(!is_dir($dir)) {
						if(mkdir($dir, 0777, TRUE)) {
							$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
							write_file("$dir/index.html", $index);
						}
					}
					
					$config['upload_path'] = $dir;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 1000;
					$this->load->library('upload', $config);
					$file = $this->upload->data();
					
					if($this->upload->do_upload('file')) {
						$this->db->set('company_logo', space_to_underscore($_FILES['file']['name']));
						$this->db->where('company_pid', $cpid);
						if($this->db->update('data_company')) {
							$result['success'] = '1';
						}
					} else {
						$result['success'] = '0';
					}
				} else {
					$result['success'] = '1';
				}
				
				echo json_encode($result);
			}
		} else {
			echo json_encode($this->form_validation->error_array());
		}
	}
	
	public function route_view() {
		if($this->session->userdata('pid') != '') {
			$cpid = $this->uri->segment(2);
			$nav = $this->uri->segment(3);
			$type = $this->uri->segment(4);
			$upid = $this->session->userdata('pid');

			// Decrypt
			$cpid = $cpid / 92771499 - 5;

			// Check company and user
			$this->db->select('b.company_pid, b.company_name, b.company_logo, b.company_email, b.company_telephone, b.company_address, c.city_name');
			$this->db->from('user_company a');
			$this->db->join('data_company b', 'a.company_pid = b.company_pid', 'left');
			$this->db->join('data_city c', 'b.city_pid = c.city_pid', 'left');
			$this->db->where('a.user_pid', $upid);
			$this->db->where('a.company_pid', $cpid);
			$query = $this->db->get();

			if($query->num_rows() > 0) {
				// Company and user match
				switch($nav) {
					case 'page':
						$data['result'] = $this->company_model->get_company_pages($cpid);
						break;
					default: 
						$data['result'] = '';
						break;
				}

				$data['company'] = $query->result();

				if($type == 'content') {
					$this->load->view('content_' . $nav, $data);
				} else {
					$this->load->view('dashboard_view', $data);
				}
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function show_preview() {
		$category_pid = $this->uri->segment(3);
		$data['category_pid'] = $category_pid;
		$data['result'] = $this->api_model->get_promotions($category_pid, '0');
		$this->load->view('content_page_preview', $data);
	}

	public function add_campaign_row() {
		$category_pid = $this->uri->segment(3);
		$row_y = $this->uri->segment(4);

		// Get row index
		$this->db->select('page_row_index');
		$this->db->from('page_row');
		$this->db->where('promo_category_pid', $category_pid);
		$this->db->order_by('page_row_pid', 'DESC');
		$this->db->limit('1');
		$query_index = $this->db->get();
		if($query_index->num_rows() > 0) {
			$result_index = $query_index->result();
			$last_index = $result_index[0] -> page_row_index;
			$new_index = $last_index+1;
		} else {
			$new_index = '1';
		}

		$data = array(
			'promo_category_pid' => $category_pid,
			'page_row_y' => $row_y,
			'page_row_index' => $new_index,
		);

		if($this->db->insert('page_row', $data)) {
			$row_pid = $this->db->insert_id();

			$status['success'] = '1';
			$status['row_pid'] = $row_pid;
			$status['row_index'] = $new_index;
			echo json_encode($status);
		}
	}

	public function count_max_row() {
		$row_pid = $this->uri->segment(3);
		$this->db->select('page_grid_col');
		$this->db->from('page_grid');
		$this->db->group_by('page_grid_index');
		$this->db->where('page_row_pid', $row_pid);
		$query = $this->db->get();
		$result = $query->result();
		$col = 0;

		if($result) {
			foreach($result as $c) {
				$col += $c -> page_grid_col;
			}
		}
		echo $col;
	}

	public function add_campaign_col() {
		$page_row_pid = $this->uri->segment(3);
		$page_grid_col = $this->uri->segment(4);

		// Get page grid index
		$this->db->select('page_grid_index');
		$this->db->from('page_grid');
		$this->db->where('page_row_pid', $page_row_pid);
		$this->db->order_by('page_grid_pid', 'DESC');
		$this->db->limit('1');
		$query_index = $this->db->get();
		if($query_index->num_rows() > 0) {
			$result_index = $query_index -> result();
			$last_index = $result_index[0] -> page_grid_index;
			$new_index = $last_index+1;
		} else {
			$new_index = '1';
		}

		$data = array(
			'page_row_pid' => $page_row_pid,
			'page_grid_index' => $new_index,
			'page_grid_col' => $page_grid_col,
		);

		if($this->db->insert('page_grid', $data)) {
			$grid_pid = $this->db->insert_id();

			$status['success'] = '1';
			$status['grid_pid'] = $grid_pid;
			$status['grid_index'] = $new_index;
			echo json_encode($status);
		}
	}

	public function count_max_grid() {
		$grid_pid = $this->uri->segment(3);
		$grid_col = $this->uri->segment(4);
		$grid_index = $this->uri->segment(5);
		$row_pid = $this->uri->segment(6);
		$row_y = $this->uri->segment(7);
		
		// Get max width
		$this->db->select('SUM(page_grid_x) as total_x, SUM(page_grid_x * page_grid_y) as total_grid_area');
		$this->db->from('page_grid');
		$this->db->where('page_grid_index', $grid_index);
		$this->db->where('page_row_pid', $row_pid);
		$query_width = $this->db->get();
		$result_width = $query_width->result();
		$user_width = $result_width[0] -> total_x;

		if($user_width > 0) {
			while($user_width >= $grid_col) {
				$user_width -= $grid_col;
			}
		}

		$width_available = $grid_col - $user_width;

		// Get max height
		if(($width_available - $grid_col) != 0) {
			$this->db->select('page_grid_y');
			$this->db->from('page_grid');
			$this->db->where('page_grid_index', $grid_index);
			$this->db->where('page_row_pid', $row_pid);
			$this->db->order_by('page_grid_pid', 'DESC');
			$this->db->limit('1');
			$query_height = $this->db->get();
			$result_height = $query_height->result();
			$height_available = $result_height[0] -> page_grid_y;
		} else {
			$col_area = $grid_col * $row_y;
			$total_grid_area = $result_width[0] -> total_grid_area;
			$available_area = $col_area - $total_grid_area;
			$height_available = $available_area / $grid_col;
		}

		$result['max_x'] = $width_available;
		$result['max_y'] = $height_available;
		echo json_encode($result);
	}

	public function preview_page_campaign() {
		$campaign_pid = $this->uri->segment(3);
		$data['result'] = $this->campaign_model->get_campaign_details($campaign_pid);
		$this->load->view('content_page_preview_campaign', $data);
	}

	public function save_grid_campaign() {
		$grid_x = $this->uri->segment(3);
		$grid_y = $this->uri->segment(4);
		$campaign_pid = $this->uri->segment(5);
		$row_pid = $this->uri->segment(6);
		$grid_index = $this->uri->segment(7);
		$grid_col = $this->uri->segment(8);

		// Find row and index
		$this->db->select('page_grid_pid');
		$this->db->from('page_grid');
		$this->db->where('page_row_pid', $row_pid);
		$this->db->where('page_grid_index', $grid_index);
		$this->db->where('campaign_pid', '0');
		$query = $this->db->get();

		// Find campaign info
		$this->db->select('company_pid, campaign_pid, campaign_image');
		$this->db->from('campaign');
		$this->db->where('campaign_pid', $campaign_pid);
		$query_campaign = $this->db->get();
		$result_campaign = $query_campaign->result();

		$callback['campaign_pid'] = $result_campaign[0] -> campaign_pid;
		$callback['company_pid'] = $result_campaign[0] -> company_pid;
		$callback['campaign_image'] = $result_campaign[0] -> campaign_image;

		if($query->num_rows() > 0) {
			$result = $query->result();
			$page_grid_pid = $result[0] -> page_grid_pid;
			$data = array(
				'page_grid_x' => $grid_x,
				'page_grid_y' => $grid_y,
				'campaign_pid' => $campaign_pid
			);

			$this->db->where('page_grid_pid', $page_grid_pid);
			if($this->db->update('page_grid', $data)) {
				$callback['success'] = '1';
				echo json_encode($callback);
			}
		} else {
			$data = array(
				'page_row_pid' => $row_pid,
				'page_grid_index' => $grid_index,
				'page_grid_col' => $grid_col,
				'page_grid_x' => $grid_x,
				'page_grid_y' => $grid_y,
				'campaign_pid' => $campaign_pid
			);

			if($this->db->insert('page_grid', $data)) {
				$callback['success'] = '1';
				echo json_encode($callback);
			}
		}
	}

	public function load_page_preview() {
		$category_pid = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		
		$data['result'] = $this->api_model->get_promotions($category_pid, $page);
		$this->load->view('include/load_page_preview', $data);
	}
	
}
?>