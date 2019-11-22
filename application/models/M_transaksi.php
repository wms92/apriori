<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getListTransaksi(){
		$this->db->select("*");
		$this->db->from("tbl_transaksi");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListTransaksiId($id){
		$this->db->select("*");
		$this->db->from("tbl_transaksi as tt");
		$this->db->where("tt.transaksi_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getListTransaksiByDate($start, $end){
		$this->db->select("*");
		$this->db->from("tbl_transaksi");
		$this->db->where("transaksi_tgl >=",$start);
		$this->db->where("transaksi_tgl <=",$end);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getListAllTransaksi(){
		$this->db->select("*");
		$this->db->from("tbl_transaksi as tt");
		$this->db->join("tbl_detail_transaksi as tdt","tdt.id_transaksi = tt.transaksi_id");
		$this->db->join("tbl_produk as tp","tp.produk_id = tdt.id_produk");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}

}