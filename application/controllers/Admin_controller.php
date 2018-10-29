<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index() {
		if($this->session->userdata('admin') != '') {
			$this->load->view('admin/admin_dashboard');
		} else {
			$this->load->view('admin/admin_login');
		}
	}
	
	public function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('pass');
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric');
		
		if($this->form_validation->run() == TRUE) {
			$this->db->select('admin_pid, admin_password');
			$this->db->from('data_admin');
			$this->db->where('admin_username', $username);
			$query = $this->db->get();
			$result = $query->result();
			
			if($query->num_rows() > 0) {
				$verify_password = $result[0] -> admin_password;
				
				if(password_verify($password, $verify_password)) {
					$this->session->set_userdata('admin', $result[0] -> admin_pid);
					echo '1';
				}
			}
		} else {
			echo json_encode($this->form_validation->error_array());
		}
	}
	
	public function open_menu() {
		$menu = $this->uri->segment(3);
		echo $menu;
	}
	
	public function logout() {
		$array = array('admin');
		$this->session->unset_userdata($array);
		$this->session->sess_destroy();
	}
	
	public function insert_cities() {
		$arr_province = array('1', '1', '1', '1', '1', '1', '2', '3', '4', '4', '4', '4', '5', '6', '7', '7', '7', '7', '7', '8', '8', '9', '9', '9', '9', '9', '9', '9', '9', '9', '10', '10', '10', '10', '10', '10', '10', '11', '11', '11', '11', '11', '11', '11', '11', '11', '12', '12', '13', '13', '14', '15', '15', '15', '16', '17', '17', '18', '18', '19', '19', '20', '20', '21', '21', '22', '23', '24', '25', '25', '26', '26', '26', '27', '28', '28', '29', '29', '29', '29', '30', '30', '30', '30', '30', '30', '30', '31', '31', '31', '31', '32', '32', '32', '32', '32', '32', '32', '33');
		
		$arr_city = array('Banda Aceh', 'Langsa', 'Lhokseumawe', 'Meulaboh', 'Sabang', 'Subulussalam', 'Denpasar', 'Pangkalpinang', 'Cilegon', 'Serang', 'Tangerang Selatan', 'Tangerang', 'Bengkulu', 'Gorontalo', 'Jakarta Barat', 'Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Utara	', 'Sungai Penuh', 'Jambi', 'Bandung', 'Bekasi', 'Bogor', 'Cimahi', 'Cirebon', 'Depok', 'Sukabumi', 'Tasikmalaya', 'Banjar', 'Magelang','Pekalongan', 'Purwokerto', 'Salatiga', 'Semarang', 'Surakarta', 'Tegal', 'Batu', 'Blitar', 'Kediri', 'Madiun', 'Malang', 'Mojokerto', 'Pasuruan', 'Probolinggo', 'Surabaya', 'Pontianak', 'Singkawang', 'Banjarbaru', 'Banjarmasin', 'Palangkaraya', 'Balikpapan', 'Bontang', 'Samarinda', 'Tarakan', 'Batam', 'Tanjungpinang', 'Bandar Lampung', 'Metro', 'Ternate', 'Tidore Kepulauan', 'Ambon', 'Tual', 'Bima', 'Mataram', 'Kupang', 'Sorong', 'Jayapura', 'Dumai', 'Pekanbaru', 'Makassar', 'Palopo', 'Parepare', 'Palu', 'Bau-Bau', 'Kendari', 'Bitung', 'Kotamobagu', 'Manado', 'Tomohon', 'Bukittinggi', 'Padang', 'Padangpanjang', 'Pariaman', 'Payakumbuh', 'Sawahlunto', 'Solok', 'Lubuklinggau', 'Pagaralam', 'Palembang', 'Prabumulih', 'Binjai', 'Medan', 'Padang Sidempuan', 'Pematangsiantar', 'Sibolga', 'Tanjungbalai', 'Tebingtinggi', 'Yogyakarta');
		
		$arr_province_name = array('Aceh', 'Bali', 'Bangka Belitung', 'Banten', 'Bengkulu', 'Gorontalo', 'Jakarta', 'Jambi', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', '	Kalimantan Barat', 'Kalimantan Selatan', 'Kalimantan Tengah', 'Kalimantan Timur', 'Kalimantan Utara', 'Kepulauan Riau', 'Lampung', 'Maluku Utara', 'Maluku', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Papua Barat', 'Papua', 'Riau', 'Sulawesi Selatan', 'Sulawesi Tengah', 'Sulawesi Tenggara', 'Sulawesi Utara', 'Sumatera Barat', 'Sumatera Selatan', 'Sumatera Utara', 'Yogyakarta');
		
		$data = array();
		for($i = 0; $i < 99; $i++) {
			//$row['province_pid'] = $arr_province[$i];
			//$row['city_name'] = $arr_city[$i];
			//array_push($data, $row);
		}
		
		/*
		if($this->db->insert_batch('data_city', $data)) {
			echo '1';
		}
		*/
		
		foreach($arr_province_name as $e) {
			$row['province_name'] = $e;
			array_push($data, $row);
		}
		/*
		if($this->db->insert_batch('data_province', $data)) {
			echo '1';
		}
		*/

	}

}

?>