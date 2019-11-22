<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stok_bahan extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

	public function getListStokBahan(){
		$this->db->select("*, sum(stok_bahan) as stok_bahan");
		$this->db->from("tbl_stok_bahan as tw");
		$this->db->join("tbl_bahan as tj","tj.bahan_id = tw.id_bahan");
		$this->db->group_by('bahan_id');
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListStokBahanId($id){
		$this->db->select("*");
		$this->db->from("tbl_stok_bahan");
		$this->db->where("stok_bahan_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

}