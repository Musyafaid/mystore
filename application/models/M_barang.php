<?php
class M_barang extends Ci_Model {
    public function get_kategori() {
        return $this->db->get('kategori')->result_array();
    }
    public function get_barang_by_kategori($kategori_id, $limit, $start) {
        $this->db->select('barang.*, kategori.kategori_name');
        $this->db->where('kategori.kategori_id', $kategori_id);
        $this->db->join('kategori', 'barang.kategori_id = kategori.kategori_id', 'inner');
        $this->db->limit($limit, $start);
        $query = $this->db->get('barang');
        return $query->result_array();

    }
    
    public function get_barang($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('barang');
        return $query->result_array();
    }
    
    public function count_barang() {
        return $this->db->count_all('barang');
    }
    public function count_barang_by_kategori($kategori_id) {
        $this->db->where('kategori_id', $kategori_id);
        return $this->db->count_all_results('barang');
    }
    
    public function get_barang_by_id($item_id) {
        $this->db->where('brg_id',$item_id);
        $this->db->join('seller', 'seller.pj_id = barang.pj_id', 'inner');
        $query = $this->db->get('barang');
        return $query->result_array();
    }
    
    public function get_seller_by_barang_id($barang_id) {
        $this->db->where('brg_id',$barang_id);
        $this->db->select('pj_id');
        $query = $this->db->get('barang');
        return $query->row();
    }
    public function get_barang_by_name($item_name,$limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->like('brg_name',$item_name);
        return $this->db->get('barang')->result_array();
    }
    

    public function insert_pemesanan($data) {
        $this->db->insert('pemesanan', $data);
        return $this->db->insert_id(); 
    }
    
    public function insert_pemesanan_detail($data) {
       return $this->db->insert('pemesanan_detail',$data);
    
    }
    public function insert_alamat($data) {
       return $this->db->insert('alamat_pengiriman',$data);
    
    }
    
    
    public function count_barang_by_search($item_name) {
        $this->db->like('brg_name', $item_name);
        return $this->db->count_all_results('barang');
    }
    
    public function get_all_barang_by_seller_id($sellerId,$limit,$start) {
        $this->db->limit($limit, $start);
        $this->db->where('seller.pj_id',$sellerId);
        $this->db->join('seller', 'seller.pj_id = barang.pj_id', 'inner');
        $query = $this->db->get('barang');
        return $query->result_array();
    }
    public function count_barang_by_seller_id($sellerId) {
        $this->db->where('pj_id', $sellerId);
        
        return$this->db->count_all_results('barang');
    }

    public function insert_barang($data_barang) {
        return $this->db->insert('barang',$data_barang);
    }

    public function update_barang($brg_id,$data_barang,$img_path) {
        $data_barang['brg_gambar'] = $img_path;
        $this->db->where('brg_id', $brg_id);
        return $this->db->update('barang',$data_barang);
    }

    public function delete_barang($brg_id) {
        $this->db->where('brg_id', $brg_id);
        return $this->db->delete('barang');
    }
}