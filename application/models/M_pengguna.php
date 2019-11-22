<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengguna extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function get_level(){
		$this->db->select("*");
		$this->db->from("level");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListPengguna(){
		$this->db->select("*");
		$this->db->from("tbl_user");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListPenggunaId($id){
		$this->db->select("*");
		$this->db->from("tbl_user");
		$this->db->where("user_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

}