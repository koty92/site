<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {
    
    public function get_user_business($user_pid) {
        $this->db->select('b.company_pid, b.company_name');
        $this->db->from('user_company a');
        $this->db->join('data_company b', 'a.company_pid = b.company_pid', 'left');
        $this->db->where('a.user_pid', $user_pid);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

}

?>