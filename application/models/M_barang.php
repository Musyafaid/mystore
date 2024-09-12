<?php
class M_barang extends Ci_Model {
    public function get_kategori() {
        return $this->db->get('kategori')->result_array();
    }
    public function get_barang_by_kategori($kategori_id, $limit, $start) {
        $this->db->where('kategori_id', $kategori_id);

        
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
    
    public function get_barang_by_name($item_name,$limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->like('brg_name',$item_name);
        return $this->db->get('barang')->result_array();
    }



    public function count_barang_by_search($item_name) {
        $this->db->like('brg_name', $item_name);
        return $this->db->count_all_results('barang');
    }
}