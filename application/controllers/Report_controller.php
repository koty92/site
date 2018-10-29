<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_controller extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('report_model'));
		$this->load->helper(array('site'));
	}
	
	public function show_campaign() {
		$type = $this->uri->segment(3);
		$data['result'] = $this->report_model->get_campaign($type);
		$this->load->view('include/report_campaign', $data);
	}
	
	public function show_report() {
		$campaign_pid = $this->uri->segment(3);
		$data['result'] = $this->report_model->get_report($campaign_pid, '2018-04-20', '2018-04-30');
		$this->load->view('include/report_analysis', $data);
	}
	
	public function show_analysis() {
		$campaign_pid = $this->uri->segment(3);
		$data['result'] = $this->report_model->get_analysis($campaign_pid);
		$this->load->view('include/report_analysis', $data);
	}
	
}

?>