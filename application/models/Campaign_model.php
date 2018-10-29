<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_model {

	public function get_all_unpaid_invoice() {
		$pid = $this->session->userdata('pid');
		$this->db->select();
		$this->db->from('invoice a');
		$this->db->join('campaign b', 'a.campaign_pid = b.campaign_pid', 'left');
		$this->db->where('a.company_pid', $pid);
		$this->db->where('a.invoice_status', '0');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function get_campaign_details($campaign_pid) {
		$this->db->select('campaign_pid, campaign_title, campaign_image, campaign_desc, company_pid');
		$this->db->from('campaign');
		$this->db->where('campaign_pid', $campaign_pid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
}

?>