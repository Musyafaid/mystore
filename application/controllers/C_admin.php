<?php
class C_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('encryption');

        if (!$this->session->userdata('sellerId') ) {
            redirect('C_seller/login');
        }
    }

    private function get_kategori() {
        return $this->M_barang->get_kategori();
    }

    private function get_barang_by_kategori($kategori_id, $limit, $page) {
        return $this->M_barang->get_barang_by_kategori($kategori_id, $limit, $page);
    }

    private function get_barang_by_id($item_id) {
        return $this->M_barang->get_barang_by_id($item_id);
    }

    private function get_barang_by_name($item_name, $limit, $start) {
        return $this->M_barang->get_barang_by_name($item_name, $limit, $start);
    }

    public function index() {

        $data['allproduct'] = $this->M_barang->count_barang_by_seller_id($this->session->userdata('sellerId')) ;

        $this->load->view('template/header');
        $this->load->view('dashboard/V_sidebar');
        $this->load->view('dashboard/V_navbar');
        $this->load->view('dashboard/V_content');
        $this->load->view('component/V_dashboard',$data);
        $this->load->view('dashboard/V_content_footer');
        $this->load->view('template/footer');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('C_seller/login');
    }

    public function get_barang() {
        $config['base_url'] = 'http://localhost:8080/project1/C_admin/get_barang/';
        $config['total_rows'] = $this->M_barang->count_barang_by_seller_id($this->session->userdata('sellerId'));
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;

        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        $page = ($page) ? $page : 0;

        $data = array(
            'kategori' => $this->get_kategori(),
            'barang'   => $this->M_barang->get_all_barang_by_seller_id($this->session->userdata('sellerId'), $config['per_page'], $page),
            'start' => $page
        );
        
    
        foreach ($data['barang'] as &$barang) {
            $barang['encrypted_brg_id'] = $this->encrypt_id($barang['brg_id']);
        }
        
        
       
    
        $this->session->set_flashdata('kategori', 'All items');

        $this->load->view('template/header');
        $this->load->view('dashboard/V_sidebar');
        $this->load->view('dashboard/V_navbar');
        $this->load->view('dashboard/V_content');
        $this->load->view('component/V_table_data', $data);
        $this->load->view('dashboard/V_add_barang', $data);
        $this->load->view('component/V_alert');
        $this->load->view('dashboard/V_content_footer');
        $this->load->view('template/footer');
    }

    public function add_barang() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 10048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('brg_gambar')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('alertError', 'Upload failed. Please try again.');
            redirect('C_admin/add_barang');
        } else {
            $upload_data = $this->upload->data();
            $gambar_path = 'uploads/' . $upload_data['file_name'];
            $data_barang = array(
                'pj_id' => $this->session->userdata('sellerId'),
                'kategori_id' => $this->input->post('kategori_id'),
                'brg_name' => $this->input->post('brg_name'),
                'description' => $this->input->post('description'),
                'brg_harga' => $this->input->post('brg_harga'),
                'brg_stok' => $this->input->post('brg_stok'),
                'brg_gambar' => $gambar_path
            );

            if ($this->M_barang->insert_barang($data_barang)) {
                $this->session->set_flashdata('alertSuccess', 'Data barang berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('alertError', 'Data barang Gagal ditambahkan.');
            }

            redirect('C_admin/get_barang');
        }
    }
    
    private function encrypt_id($id) {
        return $this->encryption->encrypt($id);
    }
    
    private function decrypt_id($encrypted_id) {
        return $this->encryption->decrypt($encrypted_id);
    }
    

    public function update() {
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 10048;
        $config['encrypt_name'] = TRUE;
    
        $this->load->library('upload', $config);
        
        $encrypted_id = $this->input->get('brg_id');
        $barang_id = $this->decrypt_id($encrypted_id);
        
        if ($barang_id === false) {

            redirect('C_admin/get_barang');
            return;
        }
        $data = array(
            'kategori' => $this->get_kategori(),
            'barang'   => $this->M_barang->get_barang_by_id($barang_id)
        );
    
        $this->form_validation->set_rules('kategori_id', 'Category ID', 'required|integer');
        $this->form_validation->set_rules('pj_id', 'Seller ID', 'required|integer');
        $this->form_validation->set_rules('brg_name', 'Product Name', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[10]|max_length[255]');
        $this->form_validation->set_rules('brg_harga', 'Price', 'required|numeric');
        $this->form_validation->set_rules('brg_stok', 'Stock', 'required|integer');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('kategori', 'All items');
    
            $this->load->view('template/header');
            $this->load->view('dashboard/V_sidebar');
            $this->load->view('dashboard/V_navbar');
            $this->load->view('dashboard/V_content');
            $this->load->view('dashboard/V_update_barang', $data);
            $this->load->view('component/V_alert');
            $this->load->view('dashboard/V_content_footer');
            $this->load->view('template/footer');
    
        } else {
            if (!$this->upload->do_upload('brg_gambar')) {
                foreach ($data['barang'] as $barang) {
                    $upload_data['file_name'] = $barang['brg_gambar'];
                }
            } else {
                $upload_data = $this->upload->data();
            }
    
            if ($this->M_barang->update_barang($barang_id, $this->input->post(), $upload_data['file_name'])) {
                $this->session->set_flashdata('alertSuccess', 'Data barang berhasil diupdate.');
                redirect('C_admin/get_barang/');
            } else {
                $this->session->set_flashdata('alertError', 'Update failed. Please try again.');
                redirect('C_admin/get_barang/');
            }
        }
    }
    
    public function delete_barang() {
        $encrypted_id = $this->input->get('brg_id');
        $barang_id = $this->decrypt_id($encrypted_id);
        
        if ($barang_id === false) {
            redirect('C_admin/get_barang/');
            return;
        }
    
        if ($this->M_barang->delete_barang($barang_id)) {
            $this->session->set_flashdata('alertSuccess', 'Data barang berhasil dihapus.');
        } else {
            $this->session->set_flashdata('alertError', 'Delete failed. Please try again.');
        }
        
        redirect('C_admin/get_barang/');
    }
    
    
    
}
