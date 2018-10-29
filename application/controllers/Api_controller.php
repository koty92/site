<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('api/v4/api_model'));
		$this->load->helper(array('file', 'site'));
	}
	
	public function index() {
		echo '1';
	}
	
	public function authorizeApp($appToken) {
		if(password_verify('adgoapplication', $appToken)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function authorizeUser($userToken, $userPid) {
		$this->db->select('login_pid');
		$this->db->from('login');
		$this->db->where('user_pid', $userPid);
		$this->db->order_by('login_pid', 'DESC');
		$this->db->limit('1', '0');
		$query = $this->db->get();
		$result = $query->result();
		$login_pid = $result[0]->login_pid;
		if(password_verify($login_pid, $userToken)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**********
	 Home
	 **********/
	 
	public function fetch_home_data() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$userPid = $obj['userPid'];
			$userToken = $obj['userToken'];
			
			// If user logged
			if($userPid != '' && $userPid > 0) {
				if($this->authorizeUser($userToken, $userPid)) {
					// Get user point
					$user_point = $this->api_model->get_user_point($userPid);
					
					// Get ads filtered by user
					$ads = $this->api_model->get_ads($userPid);
					
					// Return result
					$callback['user_point'] = $user_point;
					if($ads != '' && $user_point != '') {
						$callback['ads'] = $ads;
						$callback['success'] = '1';
					} else {
						//$callback['ads'] = '';
						$callback['success'] = '0';
					}
				} else {
					$callback['success'] = '2';
					$callback['msg'] = 'Unauthorized App';
				}
			} else {
				// Get ads not filtered
				$ads = $this->api_model->get_ads('');
				
				// Return result
				if($ads) {
					$callback['ads'] = $ads;
					$callback['success'] = '1';
				} else {
					$callback['success'] = '0';
				}
			}
			
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	
	/**********
	 End of Home
	 **********/
	 
	/**********
	 Feeds
	 **********/
	 
	public function fetch_home_feeds() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userPid = $obj['userPid'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			// Get user point
			$user_point = $this->api_model->get_user_point($userPid);
			
			// Get user feeds
			$feeds = $this->api_model->get_feeds();
			
			// Return result
			$callback['user_point'] = $user_point;
			if($feeds) {
				$callback['feeds'] = $feeds;
				$callback['success'] = '1';
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	 
	/**********
	 End of Feeds
	 **********/
	 
	/**********
	 Logs
	 **********/
	 
	public function fetch_logs() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userPid = $obj['userPid'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			// Get user point
			$user_point = $this->api_model->get_user_point($userPid);
					
			// Get user logs
			$logs = $this->api_model->get_logs($userPid);
			
			// Return result
			$callback['user_point'] = $user_point;
			if($logs) {
				$callback['logs'] = $logs;
				$callback['success'] = '1';
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	 
	/**********
	 End of Logs
	 **********/
	 
	/**********
	 Inbox
	 **********/
	 
	public function fetch_home_inbox() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$userPid = $obj['userPid'];
			$userToken = $obj['userToken'];
			
			// If user logged
			if($userPid != '' && $userPid > 0) {
				if($this->authorizeUser($userToken, $userPid)) {
					// Get user point
					$user_point = $this->api_model->get_user_point($userPid);
					
					// Get inbox filtered by user
					$inbox = $this->api_model->get_inbox();
					
					// Return result
					$callback['user_point'] = $user_point;
					$callback['inbox'] = $inbox;
					$callback['success'] = '1';
				}
			} else {
				// Get inbox not filtered
				$inbox = $this->api_model->get_inbox();
				
				// Return result
				$callback['inbox'] = $inbox;
				$callback['success'] = '1';
			}
			
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	
	public function fetch_home_inbox_detail() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$notifPid = $obj['notifPid'];
			
			// Get data
			$inbox_detail = $this->api_model->get_home_inbox_detail($notifPid);
			
			// Return result
			if($inbox_detail) {
				$callback['inbox_detail'] = $inbox_detail;
				$callback['success'] = '1';
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '2';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	 
	/**********
	 End of Inbox
	 **********/
	 
	/**********
	 Company
	 **********/
	 
	public function company_register() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userPid = $obj['userPid'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$companyName = $obj['companyName'];
			$companyTel = $obj['companyTel'];
			$companyAddress = $obj['companyAddress'];
			
			$data = array(
				'company_name' => $companyName,
				'company_telephone' => $companyTel,
				'company_address' => $companyAddress
			);
			
			$register_company = $this->api_model->register_company($data, $userPid);
			if($register_company > 0) {
				$callback['success'] = '1';
				$callback['companyPid'] = $register_company;
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	
	public function get_company_detail() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userPid = $obj['userPid'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$companyPid = $obj['companyPid'];
			
			// Get company detail
			$company = $this->api_model->get_user_company_detail($companyPid);
			
			// Get company follower
			$follower = $this->api_model->get_company_follower($companyPid);
			
			// Get active ads
			$ads = $this->api_model->get_company_active_ads($companyPid);
			
			$callback['company'] = $company;
			$callback['follower'] = $follower;
			$callback['ads'] = $ads;
			$callback['success'] = '1';
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	 
	/**********
	 End of Company
	 **********/

	/**********
	 Campaign
	 **********/

	public function fetch_campaign_list() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userPid = $obj['userPid'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$companyPid = $obj['companyPid'];

			// Get campaign data
			$campaign = $this->api_model->get_campaign_list($companyPid);

			$callback['success'] = '1';
			$callback['campaign'] = $campaign;
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}

	public function campaign_create() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userPid = $obj['userPid'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$companyPid = $obj['companyPid'];
			$campaignTitle = $obj['campaignTitle'];

			$data = array(
				'company_pid' => $companyPid,
				'campaign_title' => $campaignTitle
			);

			if($this->db->insert('campaign', $data)) {
				$callback['success'] = '1';
			}
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}

	/**********
	 End of Campaign
	 **********/

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
	
	public function fetch_promo() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$categoryPid = $obj['categoryPid'];
			
			$this->db->select('campaign_pid, campaign_title, campaign_image, campaign_point, campaign_desc, campaign_date_from, campaign_date_to, company_pid');
			
			$this->db->from('campaign');
			$this->db->where('category_pid', $categoryPid);
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['data'] = $result;
				$callback['success'] = '1';
				$callback['msg'] = 'Success';
			} else {
				$callback['success'] = '0';
				$callback['msg'] = 'Failed';
			}
			
			$jsoncallback = json_encode($callback);
			echo $jsoncallback;
		}
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
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$query = $obj['query'];
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
		
			//$this->db->select('a.company_pid, a.company_name, a.company_address, b.campaign_pid, b.campaign_image');
			$this->db->select('a.company_pid, a.company_name, a.company_address, a.company_logo');
			$this->db->from('data_company a');
			//$this->db->join('campaign b', 'a.company_pid = b.company_pid AND b.campaign_type = 2', 'left');
			
			if($query != '') {
				$where = "(a.company_name LIKE '%$query%')";
				$this->db->where($where);
			}
			
			$this->db->group_by('a.company_pid');
			$query = $this->db->get();
			$result = $query->result();
			
			$callback['success'] = '1';
			if($result) {
				$callback['data'] = $result;
			} else {
				$callback['data'] = '';
			}
		} else {
			$callback['success'] = '0';
		}
		
		$json = json_encode($callback);
		echo $json;
	}
	
	public function fetch_home_content() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$this->db->from('campaign');
			$this->db->where('campaign_type', '1');
			$this->db->order_by('campaign_PID', 'DESC');
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['success'] = '1';
				$callback['data'] = $result;
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '0';
		}
		
		$json = json_encode($callback);
		echo $json;
	}
	
	public function list_rewards() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$this->db->from('data_reward');
			$query = $this->db->get();
			$result = $query->result();
			
			$arr['reward'] = $result;
			$json = json_encode($arr);
			echo $json;
		}
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
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		$userPid = $obj['userPid'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$this->db->select('user_name, user_email, user_address, user_point, user_handphone, user_photo');
			$this->db->from('data_user');
			$this->db->where('user_pid', $userPid);
			$query = $this->db->get();
			$result = $query->result();
			
			// Get user statistics
			$stats_answered = $this->api_model->get_stats_answered($userPid);
			
			// Get total earned
			$stats_earned = $this->api_model->get_stats_earned($userPid);
			
			// Get total favorited
			$stats_favorited = $this->api_model->get_stats_favorited($userPid);
			
			// Get user companies
			$user_companies = $this->api_model->get_user_companies($userPid);
			
			if($result) {
				$callback['user'] = $result;
				$callback['stats_answered'] = $stats_answered;
				$callback['stats_earned'] = $stats_earned;
				$callback['stats_favorited'] = $stats_favorited;
				$callback['user_companies'] = $user_companies;
				$callback['success'] = '1';
			}
		} else {
			$callback['success'] = '2';
			$callback['msg'] = 'Unauthorized App';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	
	/**********
	 SignIn & SignUp
	 **********/
	 
	public function auth_user() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$email = $obj['user_email'];
		$password = $obj['user_password'];
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			// Auth user
			$this->db->select('user_password, user_pid, user_name');
			$this->db->from('data_user');
			$this->db->where('user_handphone', $email);
			$this->db->or_where('user_email', $email);
			$query = $this->db->get();
			//$query = $this->db->get_where('data_user', array('user_handphone' => $email));
			$result = $query->result();
			
			if($query->num_rows() > 0) {
				$verify_password = $result[0] -> user_password;
				//$handphone = $result[0] -> user_handphone;
				//$user_token = password_hash($email, PASSWORD_DEFAULT);
				
				if(password_verify($password, $verify_password)) {
					$userPid = $result[0] -> user_pid;
					$userName = $result[0] -> user_name;
					
					// Log login datetime
					date_default_timezone_set('Asia/Jakarta');
					$datetime = date('Y-m-d H:i:s');
					
					$log = array(
						'user_pid' => $userPid,
						'login_datetime' => $datetime
					);
					
					if($this->db->insert('login', $log)) {
						$log_id = $this->db->insert_id();
						$user_token = password_hash($log_id, PASSWORD_DEFAULT);
						
						$callback['pid'] = (string)$userPid;
						$callback['token'] = $user_token;
						$callback['success'] = '1';
						$callback['msg'] = 'Logged In';
						$callback['name'] = $userName;
					}
				} else {
					$callback['success'] = '0';
					$callback['msg'] = 'Nomor handphone / e-mail atau password salah';
				}
			} else {
				$callback['success'] = '0';
				$callback['msg'] = 'Nomor handphone / e-mail atau password salah';
			}
			
		} else {
			$callback['success'] = '0';
			$callback['msg'] = 'Unauthorized apps';
		}
		
		$json = json_encode($callback);
		echo $json;
		
	}
	
	public function register_user() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$email = $obj['user_email'];
		$handphone = $obj['user_handphone'];
		
		$this->db->from('data_user');
		$this->db->where('user_email', $email);
		$this->db->or_where('user_handphone', $handphone);
		$check_query = $this->db->get();
		
		if($check_query->num_rows() > 0) {
			$result['success'] = '0';
			$result['msg'] = 'Nomor/e-mail ini sudah pernah digunakan';
		} else {
			//$name = $obj['user_name'];
			$password = password_hash($obj['user_password'], PASSWORD_DEFAULT);
			
			$data = array(
				'user_email' => $email,
				'user_handphone' => $handphone,
				'user_password' => $password,
			);
			
			if($this->db->insert('data_user', $data)) {
				$userPid = $this->db->insert_id();
				
				// Log login datetime
				date_default_timezone_set('Asia/Jakarta');
				$datetime = date('Y-m-d H:i:s');
				
				$log = array(
					'user_pid' => $userPid,
					'login_datetime' => $datetime
				);
				
				if($this->db->insert('login', $log)) {
					$log_id = $this->db->insert_id();
					$user_token = password_hash($log_id, PASSWORD_DEFAULT);
						
					$result['pid'] = (string)$userPid;
					$result['token'] = $user_token;
					$result['success'] = '1';
					$result['msg'] = 'Registered';
				}
			} else {
				$result['success'] = '0';
			}
		}
		
		$json = json_encode($result);
		echo $json;
	}
	
	public function signup_profile() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		$userPid = $obj['userPid'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$dob = (string)$obj['user_dob'];
			$dob = date('Y-m-d', strtotime($dob));
			
			$data = array(
				'user_name' => $obj['user_name'],
				'user_address' => $obj['user_address'],
				'city_pid' => $obj['user_city'],
				'user_dob' => $dob
			);
			
			$this->db->where('user_pid', $userPid);
			if($this->db->update('data_user', $data)) {
				$result['success'] = '1';
			} else {
				$result['success'] = '0';
				$result['msg'] = 'Failed. Please Try Again';
			}
			
			$json = json_encode($result);
			echo $json;
		}
		
	}
	
	public function signup_profile_upload_photo() {
		$userPid = $this->uri->segment(3);
	
		$dir = './assets/images/user_photo/' . $userPid;
		//$target_dir = $dir . '/123.jpeg';
		
		if(!is_dir($dir)) {
			if(mkdir($dir, 0777, TRUE)) {
				$index = '<!DOCTYPE HTML><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';
				write_file($dir . "/index.html", $index);
			}
		}
		
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		//$file = $this->upload->data();
		if($this->upload->do_upload('photo')) {
			$this->db->set('user_photo', space_to_underscore($_FILES['photo']['name']));
			$this->db->where('user_pid', $userPid);
			
			if($this->db->update('data_user')) {
				$callback['success'] = '1';
			}
		} else {
			$callback['success'] = '0';
		}
		
		$data = json_encode($callback);
		echo $data;
		
		/*
		if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir)) {
			echo '1';
		}
		*/
		
	}
	
	public function fetch_cities() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$this->db->select('city_name as label, city_pid as value');
			$this->db->from('data_city');
			$this->db->order_by('city_name', 'ASC');
			$query = $this->db->get();
			$result = $query->result();
			if($result) {
				$callback['success'] = '1';
				$callback['data'] = $result;
			}
		}
		
		$data = json_encode($callback);
		echo $data;
	}
	
	/**********
	 End of SignIn & SignUp
	 **********/
	
	private function _add_impression($campaign_pid) {
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d');
		
		// Check if impression row exist
		$this->db->from('impression');
		$this->db->where('impression_date', $date);
		$this->db->where('campaign_pid', $campaign_pid);
		$iquery = $this->db->get();
		
		if($iquery->num_rows() > 0) {
			// Row exists
			$this->db->set('impression', 'impression+1', FALSE);
			$this->db->where('impression_date', $date);
			$this->db->where('campaign_pid', $campaign_pid);
			$this->db->update('impression');
		} else {
			// Insert new row
			$data = array(
				'impression_date' => $date,
				'campaign_pid' => $campaign_pid,
				'impression' => 1
			);
			$this->db->insert('impression', $data);
		}
	}
	
	public function fetch_merchant() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$companyPid = $obj['companyPid'];
			
			$this->db->select('company_pid, company_name, company_address, city_pid, company_telephone, company_logo, company_fb, company_ig, company_twitter, company_web, company_email');
			$this->db->from('data_company');
			$this->db->where('company_pid', $companyPid);
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['success'] = '1';
				$callback['data'] = $result;
			} else {
				$callback['success'] = '0';
			}
			
			$json = json_encode($callback);
			echo $json;
		}
	}
	
	public function fetch_merchant_home() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$companyPid = $obj['companyPid'];
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		//if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
		if(
			($userPid == '0' && $userToken == '0' && $this->authorizeApp($appToken)) ||
			($userPid != '0' && $this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid))
		) {
			$result = $this->api_model->get_merchant_home_v2($companyPid);
			
			// Check if follow
			$follow = '0';
			if($userPid != '0') {	
				$query = $this->db->get_where('follower', array('user_pid' => $userPid, 'company_pid' => $companyPid));
				if($query->num_rows() > 0) {
					$follow = '1';
				}
				
				// Add impression
				//$campaign_pid = $result[0] -> campaign_pid;
				//$this->_add_impression($campaign_pid);
			}
			
			// Get follower
			$follower = $this->api_model->get_merchant_follower($companyPid);
			
			// Get ads
			$ads = $this->api_model->get_merchant_ads($companyPid);
			
			$callback['data'] = $result;
			$callback['ads'] = $ads;
			$callback['follow'] = $follow;
			$callback['follower'] = $follower;
			$callback['success'] = '1';
		} else {
			$callback['success'] = '2';
		}
		
		$jsoncallback = json_encode($callback);
		echo $jsoncallback;
	}
	
	public function fetch_tabs() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$companyPid = $obj['companyPid'];
		
		if($this->authorizeApp($appToken)) {
			$this->db->from('promo_category');
			$this->db->where('company_pid', $companyPid);
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['success'] = '1';
				$callback['result'] = $result;
			} else {
				$callback['success'] = '0';
			}	
		} else {
			$callback['success'] = '2';
		}
		
		$responseJson = json_encode($callback);
		echo $responseJson;
	}
	
	public function get_user_point() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		$userPid = $obj['userPid'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$this->db->select('user_point');
			$this->db->from('data_user');
			$this->db->where('user_pid', $userPid);
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['success'] = '1';
				$callback['point'] = $result[0] -> user_point;
			}
			
			$json = json_encode($callback);
			echo $json;
		}
	}
	
	public function fetch_merchant_home_not_logged() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$companyPid = $obj['companyPid'];
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$result = $this->api_model->get_merchant_home($companyPid, '');
			
			// Add impression
			$campaign_pid = $result[0] -> campaign_pid;
			$this->_add_impression($campaign_pid);
			
			$arr['data'] = $result;
			$json = json_encode($arr);
			echo $json;
		}
	}
	
	public function fetch_merchant_ads() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$companyPid = $obj['companyPid'];
			
			$this->db->select('a.campaign_title, a.campaign_pid, a.campaign_image, a.campaign_points, b.company_pid');
			$this->db->from('campaign a');
			$this->db->join('data_company b', 'a.company_pid = b.company_pid', 'left');
			$this->db->where('a.campaign_type', '2');
			$this->db->where('a.company_pid', $companyPid);
			
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['success'] = '1';
				$callback['data'] = $result;
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '0';
		}
		
		$data = json_encode($callback);
		echo $data;
	}
	
	public function get_home_stories() {
		$this->db->from('data_company a');
		$query = $this->db->get();
		$result = $query->result();
		$arr['ads'] = $result;
		$json = json_encode($arr);
		echo $json;
	}
	
	public function get_home_stories_not_logged() {
		$this->db->from('data_company a');
		$query = $this->db->get();
		$result = $query->result();
		$arr['ads'] = $result;
		$json = json_encode($arr);
		echo $json;
	}
	
	public function fetch_home_advertisement() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		$userPid = $obj['userPid'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$this->db->select('a.campaign_pid, a.campaign_image, c.company_pid, c.company_name, c.company_logo');
			
			$this->db->from('campaign a');
			$this->db->join('answer b', "a.campaign_pid = b.campaign_pid AND b.user_pid = '$userPid'", 'left');
			$this->db->join('data_company c', 'a.company_pid = c.company_pid', 'left');
			$this->db->where('a.campaign_type', '2');
			$this->db->where('b.answer_pid IS NULL', null, false);
			$this->db->order_by('a.campaign_PID', 'DESC');
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['success'] = '1';
				$callback['data'] = $result;
			} else {
				$callback['success'] = '2';
			}
		} else {
			$callback['success'] = '0';
		}
		
		$json = json_encode($callback);
		echo $json;
	}
	
	/**********
	 Merchant
	 **********/
	 
	public function follow_merchant() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$companyPid = $obj['companyPid'];
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$data = array(
				'company_pid' => $companyPid,
				'user_pid' => $userPid
			);
			
			if($this->db->insert('follower', $data)) {
				echo '1';
			}
		}
	}
	
	public function unfollow_merchant() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$companyPid = $obj['companyPid'];
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$data = array(
				'company_pid' => $companyPid,
				'user_pid' => $userPid
			);
			
			if($this->db->delete('follower', $data)) {
				echo '0';
			}
		}
	}
	
	/**********
	 End of Merchant
	 **********/
	
	/**********
	 Advertisement
	 **********/
	
	public function fetch_advertisement_detail() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		$userPid = $obj['userPid'];
		
		if(
			($userPid == '0' && $userToken == '0' && $this->authorizeApp($appToken)) ||
			($userPid != '0' && $this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid))
		) {
			$campaignPid = $obj['campaignPid'];
			
			$this->db->select('a.campaign_title, a.campaign_image, a.campaign_pid, b.company_pid, b.company_name');
			$this->db->from('campaign a');
			$this->db->join('data_company b', 'a.company_pid = b.company_pid', 'left');
			$this->db->where('a.campaign_pid', $campaignPid);
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$callback['success'] = '1';
				$callback['data'] = $result;
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '0';
		}
		
		$json = json_encode($callback);
		echo $json;
	}
	
	public function fetch_promo_detail() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		
		if($this->authorizeApp($appToken)) {
			$campaignPid = $obj['campaignPid'];
			$userPid = $obj['userPid'];
			
			$this->db->select('
				a.campaign_pid, a.campaign_title, a.campaign_image, a.campaign_date_from, a.campaign_date_to, a.campaign_desc, a.campaign_point, 
				b.company_pid, b.company_name, b.company_logo,
				c.answer_pid
			');
			
			$this->db->from('campaign a');
			$this->db->join('data_company b', 'a.company_pid = b.company_pid', 'left');
			$this->db->join('answer c', "a.campaign_pid = c.campaign_pid AND c.user_pid = '$userPid'", 'left');
			$this->db->where('a.campaign_PID', $campaignPid);
			$query = $this->db->get();
			$result = $query->result();
			
			// Add impression and get view
			$view = $this->api_model->get_campaign_views($campaignPid, $userPid);
			
			if($result) {
				$callback['success'] = '1';
				$callback['data'] = $result;
				$callback['view'] = $view;
			} else {
				$callback['success'] = '0';
			}
		} else {
			$callback['success'] = '0';
		}
		
		$json = json_encode($callback);
		echo $json;
	}
	
	public function fetch_advertisement_questions() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		$userPid = $obj['userPid'];
		
		if($userPid != '0' && $this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$campaignPid = $obj['campaignPid'];
			
			// Check if user answered
			$this->db->select('answer_pid');
			$this->db->from('answer');
			$this->db->where('campaign_pid', $campaignPid);
			$this->db->where('user_pid', $userPid);
			$query_answer = $this->db->get();
			$result_answer = $query_answer->result();
			
			if($result_answer && $query_answer->num_rows() > 0) {
				// User answered
				$callback['success'] = '2';
			} else {
				// Insert answer 0
				date_default_timezone_set('Asia/Jakarta');
				$datetime = date('Y-m-d H:i:s');
				
				$data_answer = array(
					'user_pid' => $userPid,
					'answer_datetime' => $datetime,
					'campaign_pid' => $campaignPid
				);
				
				if($this->db->insert('answer', $data_answer)) {
					// Fetch question data
					$this->db->select('
						a.campaign_title, a.campaign_image, a.campaign_pid, a.campaign_question, a.campaign_option1, a.campaign_option2, a.campaign_option3, a.campaign_option4, a.campaign_point, 
						b.company_pid, b.company_name,
						c.answer_option,
					');
					
					$this->db->from('campaign a');
					$this->db->join('data_company b', 'a.company_pid = b.company_pid', 'left');
					$this->db->join('answer c', "a.campaign_pid = c.campaign_pid AND c.user_pid = '$userPid'", 'left');
					
					$this->db->where('a.campaign_pid', $campaignPid);
					$query = $this->db->get();
					$result = $query->result();
					
					if($result) {
						$callback['success'] = '1';
						$callback['data'] = $result;
					} else {
						$callback['success'] = '0';
					}
				}
			}
		} else {
			$callback['success'] = '0';
		}
		
		$json = json_encode($callback);
		echo $json;
	}
	
	public function submit_answer() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date('Y-m-d H:i:s');
			
			$answer_option = $obj['answer_option'];
			$campaign_pid = $obj['campaign_pid'];
			$cpid = $obj['cpid'];
			$answer_correct = '0';
			
			// Check answer
			$this->db->from('campaign');
			$this->db->where('campaign_pid', $campaign_pid);
			$this->db->where('campaign_answer', $answer_option);
			$query = $this->db->get();
			$result = $query->result();
			if($query->num_rows() > 0) {
				$answer_correct = '1';
				$campaign_point = $result[0] -> campaign_point;
				
				// If correct add point
				$this->db->set('user_point', 'user_point+' . $campaign_point, FALSE);
				$this->db->where('user_pid', $userPid);
				$this->db->update('data_user');
			}
			
			// Update user answer
			$this->db->set('answer_option', $answer_option);
			$this->db->set('answer_correct', $answer_correct);
			$this->db->where('campaign_pid', $campaign_pid);
			$this->db->where('user_pid', $userPid);
			if($this->db->update('answer')) {
				if($answer_correct == '1') {
					$callback['result'] = '1';
				} else {
					$callback['result'] = '2';
				}
			} else {
				$callback['result'] = '0';
			}
			
			/*
			$data = array(
				'user_pid' => $userPid,
				'answer_datetime' => $datetime,
				'campaign_pid' => $campaign_pid,
				'answer_option' => $answer_option,
				'answer_correct' => $answer_correct
			);
			
			if($this->db->insert('answer', $data)) {
				$msg['data'] = $this->api_model->get_merchant_home($cpid, $userPid);
				
				$callback['ads'] = $msg;
				
				if($answer_correct == '1') {
					$callback['result'] = '1';
				} else {
					$callback['result'] = '2';
				}
			} else {
				$callback['result'] = '0';
			}
			*/
			
			$responseJson = json_encode($callback);
			echo $responseJson;
		}
	}
	
	/**********
	 End of Advertisement
	 **********/
	
	public function change_password() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$oldPass = $obj['oldPass'];
			$newPass = $obj['newPass'];
			
			$query = $this->db->get_where('data_user', array('user_pid' => $userPid));
			$result = $query->result();
			
			if($query->num_rows() > 0) {
				$verify_password = $result[0] -> user_password;
				
				if(password_verify($oldPass, $verify_password)) {
					$newPass = password_hash($newPass, PASSWORD_DEFAULT);
					
					$this->db->set('user_password', $newPass);
					$this->db->where('user_pid', $userPid);
					if($this->db->update('data_user')) {
						$callback['success'] = '1';
						$callback['msg'] = 'Password Successfully Changed';
					}
				} else {
					$callback['success'] = '0';
					$callback['msg'] = 'Wrong Password';
				}
			}
			
			$json = json_encode($callback);
			echo $json;
		}
	}
	
	public function change_profile() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$fullName = $obj['fullName'];
			
			$data = array(
				'user_name' => $fullName
			);
			
			$this->db->where('user_pid', $userPid);
			if($this->db->update('data_user', $data)) {
				$callback['success'] = '1';
				$callback['msg'] = 'Profile Successfully Changed';
			} else {
				$callback['success'] = '0';
				$callback['msg'] = 'Unknown Error';
			}
		}
		
		$json = json_encode($callback);
		echo $json;
	}
	
	public function redeem_rewards() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			date_default_timezone_set('Asia/Jakarta');
			$datetime = date('Y-m-d H:i:s');
					
			$rewardPid = $obj['rewardPid'];
			$rewardPoint = $obj['rewardPoint'];
			
			$data = array(
				'redeem_datetime' => $datetime,
				'user_pid' => $userPid,
				'reward_pid' => $rewardPid
			);
			
			if($this->db->insert('redeem', $data)) {
				// Double check points
				$this->db->select('user_point');
				$query_check = $this->db->get_where('data_user', array('user_pid' => $userPid));
				$result_check = $query_check->result();
				$point = $result_check[0] -> user_point;
				
				if($point >= $rewardPoint) {
					// Deduct points
					$this->db->set('user_point', 'user_point-' . $rewardPoint, FALSE);
					$this->db->where('user_pid', $userPid);
					$this->db->update('data_user');
					
					$callback['success'] = '1';
					$callback['msg'] = 'Reward has been redeemed';
				} else {
					$callback['success'] = '0';
					$callback['msg'] = 'Not enough points';
				}
			}
			
			$jsoncallback = json_encode($callback);
			echo $jsoncallback;
		}
	}
	
	public function fetch_user_point() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		
		$userPid = $obj['userPid'];
		$appToken = $obj['appToken'];
		$userToken = $obj['userToken'];
		
		if($this->authorizeApp($appToken) && $this->authorizeUser($userToken, $userPid)) {
			$this->db->select('user_point');
			$this->db->from('data_user');
			$this->db->where('user_pid', $userPid);
			$query = $this->db->get();
			$result = $query->result();
			
			if($result) {
				$point = $result[0] -> user_point;
				$callback['success'] = '1';
				$callback['user_point'] = $point;
			} else {
				$callback['success'] = '0';
			}
			
			$jsoncallback = json_encode($callback);
			echo $jsoncallback;
		}
	}

}
?>