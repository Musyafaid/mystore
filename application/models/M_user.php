<?php
class M_user extends CI_Model {
    public function register($userdata) {
       return $this->db->insert("user",$userdata);
    }
}