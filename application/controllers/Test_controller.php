<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('report_model', 'api/v5/api_model'));
	}

	public function test() {
		$data = $this->api_model->get_promotions('10', '0');
		
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

}

?>