<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('company_model', 'campaign_model'));
	}
	
	public function index() {
		$this->load->view('main_view');
	}
	
	public function login() {
		$data = array(
			'company_email' => $this->input->post('email'),
			'company_password' => $this->input->post('pass')
		);
		
		$email = $this->input->post('email');
		$password = $this->input->post('pass');
		
		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric');
		
		if($this->form_validation->run() == TRUE) {
			$this->db->select('user_pid, user_password, user_name');
			$this->db->from('data_user');
			$this->db->where('user_email', $email);
			$this->db->or_where('user_handphone', $email);
			$query = $this->db->get();
			$result = $query->result();
			
			if($query->num_rows() > 0) {
				$verify_password = $result[0] -> user_password;
				
				if(password_verify($password, $verify_password)) {
					if($result[0] -> user_name != '') {
						$this->session->set_userdata('pid', $result[0] -> user_pid);
						$callback['success'] = '1';
					} else {
						$this->session->set_userdata('temp_pid', $result[0] -> user_pid);
						$callback['success'] = '2';
					}
				} else {
					$callback['success'] = '0';
				}
			} else {
				$callback['success'] = '0';
			}

			echo json_encode($callback);
		} else {
			echo validation_errors();
		}
	}

	public function logout() {
		$array = array('pid');
		$this->session->unset_userdata($array);
		$this->session->sess_destroy();
	}
	
	public function show() {
		$uri = $this->uri->segment(1);
		$data['uri'] = $uri;
		$this->load->view('home2_view', $data);
	}
	
	public function show_home3() {
		$uri = $this->uri->segment(1);
		$data['uri'] = $uri;
		$this->load->view('home3_view', $data);
	}

	public function show_mobile() {
		$menu = $this->uri->segment(2);
		$this->load->view('home_mobile_' . $menu . '_view');
	}
	
}
?>