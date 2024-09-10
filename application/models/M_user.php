<?php
class M_user extends CI_Model {
    public function register($userdata) {
       return $this->db->insert("user",$userdata);
    }

    public function get_user_by_email($user_email) {
        $this->db->where('usr_email', $user_email); 
        $query = $this->db->get('user'); 
        return $query->row(); 
    }

    public function verify_user($user_email) {
        $this->db->set('email_verified', 1); 
        $this->db->where('usr_email', $user_email); 
        return $this->db->update('user'); 
    }
}