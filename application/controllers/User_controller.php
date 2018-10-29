<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('user_model'));
		$this->load->helper(array('file', 'site'));
    }

    public function signup() {
		$this->load->view('signup_view');
    }
    
    public function signup_profile() {
        $pid = $this->session->userdata('temp_pid');
        if($pid != '') {
            $this->db->select('user_name');
            $query = $this->db->get_where('data_user', array('user_pid' => $pid));
            $data['result'] = $query->result();
            $this->load->view('signup_profile_view', $data);
        } else {
            redirect(base_url());
        }
    }

    public function register() {
		date_default_timezone_set('Asia/Jakarta');
        $datetime = date('Y-m-d H:i:s');
        $email = $this->input->post('email');
        $handphone = $this->input->post('handphone');
        
        // Check exist record
        $this->db->from('data_user');
		$this->db->where('user_email', $email);
		$this->db->or_where('user_handphone', $handphone);
		$check_query = $this->db->get();
		
		if($check_query->num_rows() > 0) {
			$result['success'] = '0';
            $result['msg'] = 'Nomor/e-mail ini sudah pernah digunakan';
            echo json_encode($result);
		} else {
            $data = array(
                'user_email' => $email,
                'user_handphone' => $handphone,
                'user_password' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
            );
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('valid_email' => 'Please input a valid email address'));
            $this->form_validation->set_rules('handphone', 'Handphone', 'required');
            $this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric|min_length[6]', array('min_length' => 'Password must be at least 6 characters'));
            
            if($this->form_validation->run() == TRUE) {
                if($this->db->insert('data_user', $data)) {
                    $pid = $this->db->insert_id();
                    $callback['success'] = '1';
                    $callback['pid'] = $pid;
                    echo json_encode($callback);
                }
            } else {
                echo json_encode($this->form_validation->error_array());
            }
        }
    }
    
    public function save_detail() {
        $pid = $this->input->post('user_pid');
        $dob_day = $this->input->post('detail_dob_day');
        $dob_month = $this->input->post('detail_dob_month');
        $dob_year = $this->input->post('detail_dob_year');
        $dob = $dob_year . '-' . $dob_month . '-' . $dob_day;

        // Check if dob exist
        if($dob_day != '' && $dob_month != '' && $dob_year != '' && checkmydate($dob_month, $dob_day, $dob_year)) {
            $user_name = $this->input->post('detail_name');
            $first_name = explode(' ', $user_name);
			$referral = strtolower($first_name[0] . $pid);

            $data = array(
                'user_name' => $user_name,
                'user_address' => $this->input->post('detail_address'),
                'user_dob' => $dob,
                'user_referral' => $referral,
            );
            
            $this->form_validation->set_rules('detail_name', 'Full Name', 'required');
            $this->form_validation->set_rules('detail_address', 'Address', 'required');
            
            if($this->form_validation->run() == TRUE) {
                $this->db->where('user_pid', $pid);
                if($this->db->update('data_user', $data)) { 
                    $this->session->set_userdata('pid', $pid);
                    
                    // If upload image
                    if(!(empty($_FILES['file']['name']))) {
                        $dir = './assets/images/user_photo/' . $pid;
                        if(!is_dir($dir)) {
                            if(mkdir($dir, 0777, TRUE)) {
                                $index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
                                write_file("$dir/index.html", $index);
                            }
                        }
                        
                        $config['upload_path'] = $dir;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 2000;
                        $this->load->library('upload', $config);
                        $file = $this->upload->data();
                        
                        if($this->upload->do_upload('file')) {
                            $this->db->set('user_photo', space_to_underscore($_FILES['file']['name']));
                            $this->db->where('user_pid', $pid);
                            if($this->db->update('data_user')) {
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
        } else {
            $callback['success'] = '0';
            $callback['msg'] = 'Please input a valid date';
            echo json_encode($callback);
        }
	}

    public function route_view() {
        $user_pid = $this->session->userdata('pid');

        if($user_pid > 0) {
            $nav = $this->uri->segment(2);
            $type = $this->uri->segment(3);
            
            switch($nav) {
                case 'business':
                    $data['result'] = $this->user_model->get_user_business($user_pid);
                    break;
                default:
                    $data['result'] = '';
                    break;
            }
            
            if($type == 'content') {
                $this->load->view('content_user_' . $nav, $data);
            } else {
                $this->load->view('user_dashboard_view', $data);
            }
        } else {
            redirect(base_url());
        }
    }
}

?>