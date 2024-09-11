<?php
class M_seller extends CI_Model {
    public function register($userdata) {
        return $this->db->insert("seller", $userdata);
    }

    public function get_seller_by_email($user_email) {
        $this->db->where('pj_email', $user_email); 
        $query = $this->db->get('seller'); 
        return $query->row(); 
    }

    public function update_email_token($newtoken, $email) {
        $this->db->set('email_verification_token', $newtoken);
        $this->db->where('pj_email', $email);
        return $this->db->update('seller');
    }

    public function change_password($newpassword, $email) {
        $this->db->set('pj_password', $newpassword);
        $this->db->where('pj_email', $email);
        return $this->db->update('seller');
    }

    public function is_verified($email, $status) {
        $this->db->set('email_verified', $status);
        $this->db->where('pj_email', $email);
        return $this->db->update('seller');
    }
}