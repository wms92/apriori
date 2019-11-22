<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getListProduk(){
		$this->db->select("*");
		$this->db->from("tbl_produk");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListProdukId($id){
		$this->db->select("*");
		$this->db->from("tbl_produk");
		$this->db->where("produk_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function kodeTransaksi(){
	  	$this->db->select('RIGHT(tbl_produk.produk_code,4) as code_produk', FALSE);
	  	$this->db->order_by('produk_code','DESC');    
	  	$this->db->limit(1);    
	  	$query = $this->db->get('tbl_produk');  //cek dulu apakah ada sudah ada kode di tabel.    
	  	if($query->num_rows() <> 0){      
		   	//cek kode jika telah tersedia    
		   	$data = $query->row();      
		   	$kode = intval($data->code_produk) + 1; 
	  	} else{      
		   	$kode = 1;  //cek jika kode belum terdapat pada table
	  	}
		  	$tgl=date('dmY'); 
		  	$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
		  	$kodetampil = "P"."0".$batas;  //format kode
		  	return $kodetampil;  
 	}

}