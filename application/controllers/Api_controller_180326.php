<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_controller extends CI_Controller {

	public function fetch_message() {
		$notif_pid = $this->uri->segment(3);
		$this->db->from('notification');
		$this->db->where('notification_pid', $notif_pid);
		$query = $this->db->get();
		$result = $query->result();
		
		$arr['notif'] = $result;
		$json = json_encode($arr);
		echo $json;
	}
	
	public function list_flyers() {
		$cpid = $this->uri->segment(3);
		
		$this->db->from('campaign');
		$this->db->where('company_pid', $cpid);
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach($result as &$r) {
			$r['array'] = array(
				array(
					'abc' => '1'
				),
				array(
					'abc' => '2'
				)
			);
		}
		
		$arr['flyers'] = $result;
		$json = json_encode($arr);
		echo $json;
	}
	
	public function list_flyers_v2() {
		$cpid = $this->uri->segment(3);
		
		$this->db->select('a.campaign_pid, a.campaign_image, a.campaign_text, a.company_pid, b.category_pid, b.category_name');
		$this->db->from('campaign a');
		$this->db->join('promo_category b', 'a.category_pid = b.category_pid', 'left');
		$this->db->where('a.company_pid', $cpid);
		$this->db->where('a.campaign_type', '1');
		$this->db->order_by('b.category_pid');
		$query = $this->db->get();
		$result = $query->result();
		
		$array = array();
		if($result) {
			// Make array
			$ppid = '';
			$i = 0;
			$row = $prow = $urow = array();
			
			foreach($result as $r) {
				if($i == 0) {
					$ppid = $r -> category_pid;
				}
				
				$pid = $r -> category_pid;
				
				if($pid == $ppid) {
					$row['category_pid'] = $r -> category_pid;
					$row['category_name'] = $r -> category_name;
					
					$urow['campaign_pid'] = $r -> campaign_pid;
					$urow['campaign_image'] = $r -> campaign_image;
					$urow['campaign_text'] = $r -> campaign_text;
					$urow['company_pid'] = $r -> company_pid;
					
					array_push($prow, $urow);
					
					if($i+1 == count($result)) {
						$row['campaign'] = $prow;
						array_push($array, $row);
					}
				} else {
					$row['campaign'] = $prow;
					array_push($array, $row);
					
					$row = array();
					$prow = array();
					
					$row['category_pid'] = $r -> category_pid;
					$row['category_name'] = $r -> category_name;
					
					$urow['campaign_pid'] = $r -> campaign_pid;
					$urow['campaign_image'] = $r -> campaign_image;
					$urow['campaign_text'] = $r -> campaign_text;
					$urow['company_pid'] = $r -> company_pid;
					
					array_push($prow, $urow);
					
					if($i+1 == count($result)) {
						$row['campaign'] = $prow;
						array_push($array, $row);
					}
				}
				
				$ppid = $r -> category_pid;
				$i++;
			}
		}
		
		/*
		echo '<pre>';
		print_r($array);
		echo '</pre>';
		*/
		
		$arr['flyers'] = $array;
		$json = json_encode($arr);
		echo $json;

	}
	
	public function fetch_catalogue() {
		$cpid = $this->uri->segment(3);
		$this->db->select('a.catalogue_pid, a.catalogue_name, a.catalogue_desc, a.catalogue_image, a.company_pid, b.category_pid, b.category_name');
		$this->db->from('catalogue a');
		$this->db->join('promo_category b', 'a.category_pid = b.category_pid', 'left');
		$this->db->where('a.company_pid', $cpid);
		$this->db->order_by('b.category_pid');
		$query = $this->db->get();
		$result = $query->result();
		
		$array = array();
		if($result) {
			// Make array
			$ppid = '';
			$i = 0;
			
			$row = $prow = $urow = array();
			
			foreach($result as $r) {
				if($i == 0) {
					$ppid = $r -> category_pid;
				}
				
				$pid = $r -> category_pid;
				
				if($pid == $ppid) {
					$row['category_pid'] = $r -> category_pid;
					$row['category_name'] = $r -> category_name;
					
					$urow['catalogue_pid'] = $r -> catalogue_pid;
					$urow['catalogue_image'] = $r -> catalogue_image;
					$urow['catalogue_name'] = $r -> catalogue_name;
					$urow['catalogue_desc'] = $r -> catalogue_desc;
					$urow['company_pid'] = $r -> company_pid;
					
					array_push($prow, $urow);
					
					if($i+1 == count($result)) {
						$row['catalogue'] = $prow;
						array_push($array, $row);
					}
				} else {
					$row['catalogue'] = $prow;
					array_push($array, $row);
					
					$row = array();
					$prow = array();
					
					$row['category_pid'] = $r -> category_pid;
					$row['category_name'] = $r -> category_name;
					
					$urow['catalogue_pid'] = $r -> catalogue_pid;
					$urow['catalogue_image'] = $r -> catalogue_image;
					$urow['catalogue_name'] = $r -> catalogue_name;
					$urow['catalogue_desc'] = $r -> catalogue_desc;
					$urow['company_pid'] = $r -> company_pid;
					
					array_push($prow, $urow);
					
					if($i+1 == count($result)) {
						$row['catalogue'] = $prow;
						array_push($array, $row);
					}
				}
				
				$ppid = $r -> category_pid;
				$i++;
			}
		}
		
		$arr['data'] = $array;
		$json = json_encode($arr);
		echo $json;
	}
	
	public function list_merchants() {
		$this->db->select('a.company_pid, a.company_name, a.company_address, b.campaign_pid, b.campaign_image');
		$this->db->from('data_company a');
		$this->db->join('campaign b', 'a.company_pid = b.company_pid AND b.campaign_type = 2', 'left');
		$this->db->group_by('a.company_pid');
		$query = $this->db->get();
		$result = $query->result();
		$json = json_encode($result);
		echo $json;
	}
	
	public function list_rewards() {
		$this->db->from('data_reward');
		$query = $this->db->get();
		$result = $query->result();
		
		$arr['reward'] = $result;
		$json = json_encode($arr);
		echo $json;
	}
	
	public function list_notifs() {
		$this->db->from('notification');
		$query = $this->db->get();
		$result = $query->result();
		
		$arr['notif'] = $result;
		$json = json_encode($arr);
		echo $json;
	}
	
	public function fetch_ads() {
		$this->db->from('advertisement');
		$query = $this->db->get();
		$result = $query->result();
		
		$json = json_encode($result);
		echo $json;
	}
	
	public function get_user_detail() {
		$pid = $this->uri->segment(3);
		$this->db->from('data_user');
		$this->db->where('user_pid', $pid);
		$query = $this->db->get();
		$result = $query->result();
		
		$arr['user'] = $result;
		$json = json_encode($result);
		echo $json;
	}
	
	public function auth_user() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$email = $obj['user_email'];
		$password = $obj['user_password'];
		
		$query = $this->db->get_where('data_user', array('user_email' => $email));
		$result = $query->result();
		
		if($query->num_rows() > 0) {
			$verify_password = $result[0] -> user_password;
			if(password_verify($password, $verify_password)) {
				$msg = $result[0] -> user_pid;
			} else {
				$msg = '0';
			}
		} else {
			$msg = '0';
		}
		
		$responseJson = json_encode($msg);
		echo $responseJson;
		
	}
	
	public function fetch_merchant_home() {
		$cpid = $this->uri->segment(3);
		$this->db->from('campaign a');
		$this->db->where('a.company_pid', $cpid);
		$this->db->where('a.campaign_type', '2');
		$query = $this->db->get();
		$result = $query->result();
		
		$arr['data'] = $result;
		$json = json_encode($arr);
		echo $json;
	}

}
?>