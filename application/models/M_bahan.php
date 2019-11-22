<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bahan extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getListBahan(){
		$this->db->select("*");
		$this->db->from("tbl_bahan");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListBahanId($id){
		$this->db->select("*");
		$this->db->from("tbl_bahan");
		$this->db->where("bahan_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

}