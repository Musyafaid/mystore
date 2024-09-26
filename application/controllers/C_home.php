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


    public function wilayah()
    {
       
        var_dump($this->input->post());
        $this->load->view('template/header');
        $this->load->view('component/V_alamat');
        $this->load->view('template/footer');
        
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

        if($this->session->userdata('userId')){
            $textbtn = "logout";
        }else{
            $textbtn = "login";
        }

        $this->session->set_userdata('textbtn',$textbtn);

        $data = array(
            'kategori' => $this->get_kategori(),
            'barang'   => $this->M_barang->get_barang($config['per_page'], $page)
           
        );

        
            $this->session->set_flashdata('kategori','All items'); 
       
             
        
    

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
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        
        $this->pagination->initialize($config);
        
        $page = $this->uri->segment(4, 0); 
        
        
        $data = array(
            'kategori' => $this->get_kategori(),
            'barang'   => $this->get_barang_by_kategori($kategori_id, $config['per_page'], $page)
        );
        if (!empty($data['barang'])) {
           $this->session->set_flashdata('kategori',$data['barang'][0]['kategori_name']); 
        } else {
            
            $this->session->set_flashdata('kategori','No data available');
        }
        
        
        
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
    
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">'; // Center pagination
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



    public function add_to_cart() {
        if(!$this->session->userdata('userId')){
            redirect('C_user/login/');
        }else{

            $data = array(
                'id' => $this->input->post('brg_id'),
                'name' => $this->input->post('brg_name'),
                'qty' => $this->input->post('quantity'),
                'price' => $this->input->post('brg_harga'),
                'max_qty' => $this->input->post('max_qty'),
                'gambar' => $this->input->post('brg_gambar')
                
            );
            
            var_dump($data);
            
            $this->cart->insert($data);
            $this->session->set_flashdata('alertSuccess', 'Item added to cart successfully!');
            redirect('C_home/view_cart/'); 
        }
        }
    
        
        public function view_cart() {
            if(!$this->session->userdata('userId')){
                redirect('C_user/login/');
            }else{
                $this->form_validation->set_rules('province_id', 'Provinsi', 'required');
                $this->form_validation->set_rules('city_id', 'Kota/Kabupaten', 'required');
                $this->form_validation->set_rules('district_id', 'Kecamatan', 'required');
                $this->form_validation->set_rules('subdistrict_id', 'Kelurahan', 'required');
                $this->form_validation->set_rules('address', 'Alamat Lengkap', 'required');
                
                
                
                if($this->form_validation->run() == false){
                    $data['cart_items'] = $this->cart->contents(); 
                    $data['total'] = $this->cart->total(); 
                    var_dump( $data['cart_items']);
                    $this->session->set_userdata('checkout', count($data['cart_items']));
                    $this->load->view('template/header');
                    $this->load->view('component/V_cart', $data); 
                    $this->load->view('template/footer');
                   
                }else{
                    var_dump($this->input->post());

                    $data = array(
                        'usr_id'          => $this->session->userdata('userId'), // Assuming usr_id is posted or from session
                        'provinsi'        => $this->input->post('selected_province_name'),
                        'kota'            => $this->input->post('selected_city_name'),
                        'kecamatan'       => $this->input->post('selected_district_name'),
                        'kelurahan'       => $this->input->post('selected_subdistrict_name'),
                        'alamat_lengkap'  => $this->input->post('address'), // Full address from form
                        'kode_pos'        => $this->input->post('selected_postal_code'),
                        'catatan'        => $this->input->post('catatan')
                    );

                 
                    if($this->M_barang->insert_alamat($data)){
                        redirect('C_checkout/buy/');
                    }else{
                        echo "Gagal mengirim alamat";
                    }

                }

            }
    }

    public function remove_item($rowid) {
        if(!$this->session->userdata('userId')){
            redirect('C_user/login/');
        }else{

            $this->cart->remove($rowid); 
            $this->session->set_flashdata('alertSuccess', 'Item berhasil dihapus dari cart.');
            redirect('C_home/view_cart'); 
        }
    }

    public function clear_cart() {
        if(!$this->session->userdata('userId')){
            redirect('C_user/login/');
        }else{

            $this->cart->destroy(); 
            $this->session->set_flashdata('alertSuccess', 'Cart berhasil dikosongkan.');
            redirect('C_home/view_cart');
        }
    }

    public function update_cart() {
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');
    
        if ($rowid && $qty) {
            $data = [
                'rowid' => $rowid,
                'qty' => $qty
            ];
    
            $this->cart->update($data);
    
            echo json_encode(['status' => 'success']);
       
        } else {
            echo json_encode(['status' => 'failed']);
        }
    }


    
    
    
    
    
    
    
    
}