<?php
class C_home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    private function get_kategori() {
        return $this->M_barang->get_kategori();
    }

    private function get_barang_by_kategori($kategori_id,$limit,$page) {
        return $this->M_barang->get_barang_by_kategori($kategori_id,$limit,$page);
    }

    private function get_barang_by_id($item_id){
       return $this->M_barang->get_barang_by_id($item_id);
    }

    private function get_barang_by_name($item_name,$limit,$start){
        return $this->M_barang->get_barang_by_name($item_name,$limit,$start);
    }

    public function landing() {
        $config['base_url'] = 'http://localhost:8080/project1/C_home/landing/';
        $config['total_rows'] = $this->M_barang->count_barang();
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        $config['num_links'] = 5; 

        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">'; // Center pagination
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        
        // Add disabled state for previous and next links
        $config['prev_tag_open'] = '<li class="page-item';
        $config['prev_tag_close'] = '">';
        $config['next_tag_open'] = '<li class="page-item';
        $config['next_tag_close'] = '">';
        $config['prev_link'] = '<a class="page-link" href="#">Previous</a>';
        $config['next_link'] = '<a class="page-link" href="#">Next</a>';
        $config['prev_tag_open'] = '<li class="page-item disabled">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item disabled">';
        $config['next_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        $page = ($page) ? $page : 0;

        $data = array(
            'kategori' => $this->get_kategori(),
            'barang'   => $this->M_barang->get_barang($config['per_page'], $page)
        );

        $this->load->view('template/header');
        $this->load->view('component/V_navbar', $data);
        $this->load->view('home/V_item', $data);
        $this->load->view('component/V_copyright');
        $this->load->view('template/footer');
        
    }
    public function kategori($kategori_id) {
        $config['base_url'] = 'http://localhost:8080/project1/C_home/kategori/' . $kategori_id.'/';
        $config['total_rows'] = $this->M_barang->count_barang_by_kategori($kategori_id);
        $config['per_page'] = 8;
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">'; // Center pagination
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        
        $config['prev_tag_open'] = '<li class="page-item';
        $config['prev_tag_close'] = '">';
        $config['next_tag_open'] = '<li class="page-item';
        $config['next_tag_close'] = '">';
        $config['prev_link'] = '<a class="page-link" href="#">Previous</a>';
        $config['next_link'] = '<a class="page-link" href="#">Next</a>';
        $config['prev_tag_open'] = '<li class="page-item disabled">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item disabled">';
        $config['next_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $page = $this->uri->segment(4, 0); 
        
        
        $data = array(
            'kategori' => $this->get_kategori(),
            'barang'   => $this->get_barang_by_kategori($kategori_id, $config['per_page'], $page)
        );
        
        
        $this->load->view('template/header');
        $this->load->view('component/V_navbar', $data);
        $this->load->view('home/V_item', $data);
        $this->load->view('template/footer');
    }
    
    public function detail_item($item_id) {
        $data = array(
            'kategori' => $this->get_kategori(),
            'barang' => $this->get_barang_by_id($item_id)
            
        );
        
        $this->load->view('template/header');
        $this->load->view('component/V_navbar', $data);
        $this->load->view('component/V_detail', $data);
        $this->load->view('template/footer');
        
        
    }
    
    public function search() {
        $this->load->library('pagination');
    
        $keyword = $this->input->post('keyword') ;
        if ($keyword) {
            $this->session->set_userdata('keyword', $keyword);
        }
    
        $config['base_url'] = base_url('C_home/search'); 
        $config['total_rows'] = $this->M_barang->count_barang_by_search($this->session->userdata('keyword'));
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;
    
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
    
        $this->pagination->initialize($config);
    
        $start = (int) $this->uri->segment(3, 0);
    
        

        $data = array(
            'kategori' => $this->get_kategori(),
            'barang'   => $this->M_barang->get_barang_by_name($this->session->userdata('keyword'), $config['per_page'], $start)
        );
    
        $this->load->view('template/header');
        $this->load->view('component/V_navbar', $data);
        $this->load->view('home/V_item', $data);
        $this->load->view('component/V_copyright');
        $this->load->view('template/footer');
    }
    
    
}