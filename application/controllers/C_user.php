<?php
class C_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('email');
    }

    public function register() {
        
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
                $this->session->set_flashdata('alertError', 'Upload failed. Please try again.');
                redirect('C_user/register');
            } else {
                $upload_data = $this->upload->data();
                $gambar_path = $upload_data['file_name'];
                
                $verification_code = rand(100000, 999999);
                
                $data = array(
                    'usr_name' => $this->input->post('usr_name'),
                    'usr_email' => $this->input->post('usr_email'),
                    'usr_password' => password_hash($this->input->post('usr_password'), PASSWORD_BCRYPT),
                    'usr_handphone' => $this->input->post('usr_handphone'),
                    'usr_alamat' => $this->input->post('usr_alamat'),
                    'usr_gambar' => $gambar_path,
                    'tgl_dibuat' => date('Y-m-d'),
                    'email_verified' => 0, 
                    'email_verification_token' => $verification_code
                );
                
                if ($this->M_user->register($data)) {
                    $this->send_verification_email($this->input->post('usr_email'), $verification_code);
                    
                    $this->session->set_flashdata('alertSuccess', 'Registration successful! Please check your email to verify your account.');
                    redirect('C_user/register');
                } else {
                    $this->session->set_flashdata('alertError', 'Registration failed. Please try again.');
                    redirect('C_user/register');
                }
            }
        }
    }
    
    private function send_verification_email($email, $verification_code) {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'examplestoreproject@gmail.com',
            'smtp_pass' => 'sguv oxym cdvz tszn', 
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'smtp_crypto' => 'tls' 
        );
        
        $this->email->initialize($config); 
        
        $this->email->from('examplestoreproject@gmail.com', 'My Store');
        $this->email->to($email);
        
        $verification_link = site_url('C_user/verify_email/register/' . urlencode($email) . '/' . urlencode($verification_code));
        
        $this->email->subject('Email Verification');
        $this->email->message('Click the following link to verify your email: <a href="' . $verification_link . '">Verify Email</a>');
        
        if ($this->email->send()) {
            return true;
        } else {
            log_message('error', $this->email->print_debugger());
            return false;
        }
    }
    
    public function verify_email($page,$email, $verification_code) {
        
        $mail =urldecode($email);
        
        $user = $this->M_user->get_user_by_email($mail);
     
        if ($user) {
            if ($user->email_verification_token == $verification_code) {
                
                
                $this->session->set_flashdata('alertSuccess', 'Email verification successful! You can now log in.');
                redirect('C_user/'.$page); 
                
            } else {
                $this->session->set_flashdata('alertError', 'Invalid verification code. Please try again.');
                redirect('C_user/'.$page); 
            }
        } else {
            $this->session->set_flashdata('alertError', 'Invalid email address. Please try again.');
            redirect('C_user/'.$page); 
        }
    }
    
    public function login(){
        $this->form_validation->set_rules('usr_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('usr_password', 'Password', 'required');
        
        if($this->form_validation->run() == false){
            
            $this->load->view('template/header');
            $this->load->view('user/V_login');
            $this->load->view('template/footer');
        }else{
            $email = $this->input->post('usr_email');
            $password = $this->input->post('usr_password');
            $user = $this->M_user->get_user_by_email($email);
            
            if($user){
                if(password_verify($password,$user->usr_password)){
                    $this->session->set_flashdata('alertSuccess', 'Email and Password is match');
                    redirect('C_user/home'); 
                }else{
                    $this->session->set_flashdata('alertError', 'Password is wrong');
                    redirect('C_user/login'); 
                }
            }else{
                $this->session->set_flashdata('alertError', 'Email not found');
                redirect('C_user/login'); 
            }
            
            
        }
    }
    
    public function recovery_password() {
        
        
        $this->form_validation->set_rules('usr_email', 'Email', 'required|valid_email');
        if($this->form_validation->run() == false){
            
            $this->load->view('template/header');
            $this->load->view('user/V_recovery');
            $this->load->view('template/footer');
            
        }else{
            var_dump($_POST);
          
            $verification_code = rand(100000, 999999);
            $email = $this->input->post('usr_email');
            
            
            if($this->M_user->get_user_by_email($email)){
                
                if( $this->M_user->update_email_token($verification_code,$email)){
                    $this->send_code_recovery_password($email,$verification_code);
                    $this->session->set_flashdata('alertSuccess', 'Email verification has send to your email');
                    redirect('C_user/recovery_password');
                }else{
                    
                    $this->session->set_flashdata('alertError', 'Gagal mengganti pasword');
                    redirect('C_user/recovery_password');
                }
            }else{
            
                $this->session->set_flashdata('alertError', 'Gagal menemukan email');
                redirect('C_user/recovery_password');
            }
            
        }
    }

    

    private function send_code_recovery_password($email,$verification_code){
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'examplestoreproject@gmail.com',
            'smtp_pass' => 'sguv oxym cdvz tszn', 
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'smtp_crypto' => 'tls' 
        );

        $this->email->initialize($config); 

        $this->email->from('examplestoreproject@gmail.com', 'My Store');
        $this->email->to($email);
        $page = "recovery_password";
        $verification_link = site_url('C_user/token_verify/' . urlencode($email) . '/' . urlencode($verification_code));

        $this->email->subject('Password Recovery');
        $this->email->message('Click the following link to recovery your password: <a href="' . $verification_link . '">Verify Email</a>');

        if ($this->email->send()) {
            return true;
        } else {
            log_message('error', $this->email->print_debugger());
            return false;
        }
    }

    public function token_verify( $email, $verification_code) {
        $mail = urldecode($email);
        $user = $this->M_user->get_user_by_email($mail);
    
        if ($user) {
            if ($user->email_verification_token == $verification_code) {
                $this->session->set_userdata('email', $mail);

          
                $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

                if ($this->form_validation->run() == false) {
                    $this->load->view('template/header');
                    $this->load->view('user/V_change_password');
                    $this->load->view('template/footer');
                } else {
                    $new_password = $this->input->post('new_password');

                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    if ($this->M_user->change_password($hashed_password, $mail)) {
                        $this->session->set_flashdata('alertSuccess', 'Password has been changed successfully. Please log in again.');
                        $this->session->unset_userdata('email'); 
                        redirect('C_user/login');
                    } else {
                        $this->session->set_flashdata('alertError', 'Failed to change the password. Please try again.');
                        redirect('c_user/recovery_password');

                    }
                }
           
            } else {
                $this->session->set_flashdata('alertError', 'Invalid verification code. Please try again.');
                redirect('C_user/' . $page);
            }
        } else {
            $this->session->set_flashdata('alertError', 'Invalid email address. Please try again.');
            redirect('C_user/' . $page);
        }
    }
    
}
