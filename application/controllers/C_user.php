<?php
class C_user extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('M_user');
        }

  

    public function register() {
        // Set validation rules
       
        $this->form_validation->set_rules('usr_name', 'Name', 'required');
        $this->form_validation->set_rules('usr_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('usr_password', 'Password', 'required');
        $this->form_validation->set_rules('usr_handphone', 'Handphone', 'required|numeric');
        $this->form_validation->set_rules('usr_alamat', 'Address', 'required');
            
        
       
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 10048; 
        $config['encrypt_name'] = TRUE; 
        $this->upload->initialize($config);

        

        if ($this->form_validation->run() == FALSE) {
          
            $this->load->view('template/header');
            $this->load->view('user/V_register');
            $this->load->view('template/footer');

   
        } else {
            if (!$this->upload->do_upload('usr_gambar')) {
              
                $error = array('error' => $this->upload->display_errors());
                redirect('C_user/register');
            } else {
                // Upload berhasil, ambil data gambar
                $upload_data = $this->upload->data();
                $gambar_path = $upload_data['file_name'];
                

                // Prepare user data
                $data = array(
                    'usr_name' => $this->input->post('usr_name'),
                    'usr_email' => $this->input->post('usr_email'),
                    'usr_password' => password_hash($this->input->post('usr_password'), PASSWORD_BCRYPT),
                    'usr_handphone' => $this->input->post('usr_handphone'),
                    'usr_alamat' => $this->input->post('usr_alamat'),
                    'usr_gambar' => $gambar_path, // Set path gambar
                    'tgl_dibuat' => date('Y-m-d')
                );

            

            

                // Insert user data into database
                if ($this->M_user->register($data)) {
                    
                 $this->session->set_flashdata('alertSuccess','Data di tambahkan');
                redirect('C_user/register');
                } else {
               
                    redirect('C_user/register',array('error' => 'Registration failed. Please try again.')); 
                }
            }
        }
    }
}
