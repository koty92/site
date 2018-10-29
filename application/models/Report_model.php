<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_model {
	
	public function get_campaign($type) {
		$cpid = $this->session->userdata('pid');
		
		$this->db->select('a.campaign_pid, a.campaign_title');
		$this->db->from('campaign a');
		$this->db->where('a.company_pid', $cpid);
		$this->db->where('a.campaign_type', '2');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function get_report($campaign_pid, $date_from, $date_to) {
		// Get Impression
		$this->db->from('impression');
		$this->db->where('campaign_pid', $campaign_pid);
		$this->db->order_by('impression_date', 'DESC');
		$iquery = $this->db->get();
		$iresult = $iquery->result();
		
		// Get answer
		$this->db->select('DATE(a.answer_datetime) as answer_date, COUNT(a.answer_pid) as answer_count');
		$this->db->from('answer a');
		$this->db->where('a.campaign_pid', $campaign_pid);
		$this->db->group_by('DATE(a.answer_datetime)');
		$this->db->order_by('DATE(a.answer_datetime)', 'DESC');
		$aquery = $this->db->get();
		$aresult = $aquery->result();
		
		// Count diff date
		$date1 = new DateTime($date_to);
		$date2 = new DateTime($date_from);
		$diff = $date2->diff($date1)->format("%a");
		
		// Create array
		$array = array();
		
		$i = $a = 0;
		for($d = 0; $d < ($diff+1); $d++) {
			$row = array();
			
			// Insert date
			$keydate = date('Y-m-d', strtotime($date_from . ' +' . $d . ' day'));
			$row['date'] = $keydate;
			
			// Insert impression
			if($iresult && $iresult[$i] -> impression_date == $keydate) {
				$impr = $iresult[$i] -> impression;
				$row['impression'] = $impr;
				$i++;
			} else {
				$row['impression'] = '0';
			}
			
			// Insert answer count
			if($aresult && $aresult[$a] -> answer_date == $keydate) {
				$ans = $aresult[$a] -> answer_count;
				$row['answer'] = $ans;
			} else {
				$row['answer'] = '0';
			}
			
			array_push($array, $row);
		}
		
		return $array;
	}
	
	public function get_analysis($campaign_pid) {
		
	}

}
?>