<?php
class M_analisis extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function transasction($startDate, $endDate) {
        $this->db->select("*");
        $this->db->from("tbl_transaksi t");
        $this->db->join("tbl_detail_transaksi dt","t.transaksi_no = dt.id_transaksi_code");
        $this->db->order_by("transaksi_tgl","asc");
        
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }
}