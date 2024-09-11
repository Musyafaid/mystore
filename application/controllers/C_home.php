<?php
class C_home extends CI_Controller {

        public function __construct() {
            parent::__construct();
            if($this->session->userdata('isLogin') == false){
                $this->session->set_flashdata('alertError', 'Please login');
                redirect('C_user/login');
            }
        }

    public function index() {
        $this->load->view('template/header');
        $this->load->view('home/V_home');
        $this->load->view('template/footer');
    }

    public function logout() {
        $this->session->session_destroy();
        redirect('C_user/login');
    }
}