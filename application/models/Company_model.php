<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_model {

	public function get_company() {
		$this->db->select('a.company_pid, a.company_name, a.company_email, a.company_address, a.company_telephone, a.company_logo, b.city_name');
		$pid = $this->session->userdata('pid');
		
		$this->db->join('data_city b', 'a.city_pid = b.city_pid', 'left');
		$query = $this->db->get_where('data_company a', array('a.company_pid' => $pid));
		$result = $query->result();
		return $result;
	}

	public function get_company_pages($cpid) {
		$this->db->select('category_pid, category_name');
		$this->db->from('promo_category');
		$this->db->where('company_pid', $cpid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function get_company_rows($category_pid) {
		$this->db->from('page_row');
		$this->db->where('promo_category_pid', $category_pid);
		$this->db->order_by('page_row_index', 'ASC');
		$query = $this->db->get();
		$result = $query->result();
		return($result);
	}
	
}

?>