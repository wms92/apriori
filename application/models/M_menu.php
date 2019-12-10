<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getListMenu(){
		$this->db->select("*");
		$this->db->from("tbl_menu");
		$this->db->order_by("menu_name","asc");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListMenuId($id){
		$this->db->select("*");
		$this->db->from("tbl_menu");
		$this->db->where("menu_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function kodeTransaksi(){
	  	$this->db->select('RIGHT(tbl_menu.menu_code,4) as code_menu', FALSE);
	  	$this->db->order_by('menu_code','DESC');    
	  	$this->db->limit(1);    
	  	$query = $this->db->get('tbl_menu');  //cek dulu apakah ada sudah ada kode di tabel.    
	  	if($query->num_rows() <> 0){      
		   	//cek kode jika telah tersedia    
		   	$data = $query->row();      
		   	$kode = intval($data->code_menu) + 1; 
	  	} else{      
		   	$kode = 1;  //cek jika kode belum terdapat pada table
	  	}
		  	$tgl=date('dmY'); 
		  	$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
		  	$kodetampil = "M"."0".$batas;  //format kode
		  	return $kodetampil;  
 	}

}