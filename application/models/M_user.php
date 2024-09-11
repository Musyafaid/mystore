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

    public function update_email_token($newtoken,$email) {
        $this->db->set('email_verification_token', $newtoken);
        $this->db->where('usr_email',$email );
        return $this->db->update('user');
    }

    public function change_password($newpassword,$email) {
        $this->db->set('usr_password', $newpassword);
        $this->db->where('usr_email',$email );
        return $this->db->update('user');
    }

    public function is_verified($email,$status) {
        $this->db->set('email_verified', $status);
        $this->db->where('usr_email',$email );
        return $this->db->update('user');
    }
}