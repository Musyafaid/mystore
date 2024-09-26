<?php
class C_checkout extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->model('M_user');
        $this->load->library('midtrans');
        $this->midtrans->config(array('server_key' => 'SB-Mid-server-WAWrwB05nx2IycDZaQhQilNw', 'production' => false));
    }

    public function buy() {
        $cart_items = $this->cart->contents();
        $gross_amount = 0;
        $date = new \DateTime('now');
        $usr_id = $this->session->userdata('userId');

        $this->db->trans_start(); 

        
        if($this->session->userdata('alamat')){
            $alamat = $this->session->userdata('alamat');
        }

        $item_details = [];
        foreach ($cart_items as $item) {
            $seller = $this->M_barang->get_seller_by_barang_id($item['id']);
            $gross_amount += $item['subtotal'];
            
            $item_details[] = [
                'id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'name' => $item['name']
            ];

            foreach ($seller as $sel) {
                $data_pemesanan = [
                    'pj_id' => $sel,
                    'usr_id' => $usr_id,
                    'pm_tgl' =>  $date->format('Y-m-d'),
                    'metode_pembayaran_id' => 1 // Default to manual or Midtrans later
                ];

                $pm_id = $this->M_barang->insert_pemesanan($data_pemesanan);

                $data_pemesanan_detail = [
                    'pm_id' => $pm_id,
                    'brg_id' => $item['id'],
                    'detail_qty' => $item['qty'],
                    'detail_price' => $item['price'],
                    'detail_status' => 'pending'
                ];

                if (!$this->M_barang->insert_pemesanan_detail($data_pemesanan_detail)) {
                    $this->session->set_flashdata('alertError', 'Failed to process the order.');
                    $this->db->trans_rollback(); 
                    redirect('C_home/landing');
                    return;
                }
            }
        }

        $data['user'] = $this->M_user->get_user_by_id($usr_id);



        $transaction_details = [
            'order_id' => uniqid(),
            'gross_amount' => $gross_amount
        ];

        foreach($data['user'] as $user){
            $billing_address = array(
                'first_name'    => $user['usr_name'],
                'last_name'     => "",
                'address'       => $alamat['alamat_lengkap'],
                'city'          => $alamat['kota'],
                'postal_code'   => $alamat['kode_pos'],
                'phone'         => $user['usr_handphone'],
                'country_code'  => 'IDN'
            );
            $customer_details = [
                'first_name' => $user['usr_name'], 
                'last_name'     => "",
                'email' => $user['usr_email'],
                'phone' => $user['usr_handphone'],
                'billing_address'  => $billing_address
            ];
        }

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details
        ];

        try {
            $snapToken = $this->midtrans->getSnapToken($transaction_data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('alertError', 'Transaction failed.');
                $this->session->set_userdata('checkout',0);
                redirect('C_home/landing');
            } else {
                $data['snapToken'] = $snapToken;
                $this->session->set_userdata('checkout',0);
                $this->cart->destroy();
                $this->load->view('checkout_snap', $data);
            }
        } catch (Exception $e) {
            log_message('error', 'Midtrans Error: ' . $e->getMessage());
            $this->session->set_flashdata('alertError', 'Failed to initiate payment.');
            redirect('C_home/landing');
        }
    }
}
