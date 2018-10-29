<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('add_dot')) {

	function add_dot($data) {
		if(strlen($data) > 6) {
			$data = substr_replace($data, '.', -3, 0);
			$data = substr_replace($data, '.', -7, 0);
		} elseif(strlen($data) > 3) {
			$data = substr_replace($data, '.', -3, 0);
		}
		return($data);
	}
	
	function remove_sign($data) {
		$data = str_replace('&', '', $data);
		return($data);
	}
	
	function space_to_underscore($data) {
		$data = str_replace(' ', '_', $data);
		return($data);
	}
	
	function convert_br($data) {
		$data = trim(preg_replace('/\s\s+/', "\n----------------------------\n", $data));
		return($data);
	}

	function checkmydate($m, $d, $y) {
		return checkdate($m, $d, $y);
	}
	
}
?>