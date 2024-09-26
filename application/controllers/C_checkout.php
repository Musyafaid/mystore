<?php
class C_checkout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_barang');
    }

    public function buy() {
        $cart_items= $this->cart->contents();


        $date = new \DateTime('now');
        $usr_id = $this->session->userdata('userId');

        
        
        foreach ($cart_items as $item) {
            $seller = $this->M_barang->get_seller_by_barang_id($item['id']);
            foreach ($seller as $sel) {
                $data_pemesanan = [
                    'pj_id' => $sel,
                    'usr_id' => $usr_id,
                    'pm_tgl' =>  $date->format('Y-m-d'),
                    'metode_pembayaran_id' => 1
                ];
        
                $pm_id = $this->M_barang->insert_pemesanan($data_pemesanan);
        
                $data_pemesanan_detail = [
                    'pm_id' => $pm_id,
                    'brg_id' => $item['id'], // ID barang dari item keranjang
                    'detail_qty' => $item['qty'], // Jumlah barang
                    'detail_price' => $item['price'], // Harga barang
                    'detail_status' => 'pending' // Status awal, sesuaikan jika perlu
                ];
        
                

                if($this->M_barang->insert_pemesanan_detail($data_pemesanan_detail) ){
                    $this->session->set_flashdata('alertSuccess', 'Barang Berhasil di beli');
                    $this->cart->destroy(); 
                    redirect('C_home/landing/');
                }else{
                    $this->session->set_flashdata('alertError', 'Update failed. Please try again.');
                    redirect('C_home/landing/');
                    
                }
            }
        }
        
      
        
    }
}