<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stok_bahan extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_stok_bahan');
		$this->load->model('M_bahan');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listBahan']	= $this->M_bahan->getListBahan();
		$data['v_content']  = 'member/stok_bahan/add';
		$this->load->view('member/layout', $data);
	}
	
	public function index(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_stok_bahan->getListStokBahan();
		$data['v_content']  = 'member/stok_bahan/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_stok_bahan->getListStokBahanId($id);
		$data['listBahan']	= $this->M_bahan->getListBahan();
		$data['v_content']  = 'member/stok_bahan/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		
		$dataArray = array(
			"id_bahan"		=> $post['id_bahan'],
			"stok_bahan"		=> $post['stok_bahan'],

		);
		$insert = $this->db->insert("tbl_stok_bahan",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/stok_bahan');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/stok_bahan/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
		
			$dataArray = array(
				"id_bahan"		=> $post['id_bahan'],
				"stok_bahan"		=> $post['stok_bahan'],
			);
		
		
		$update = $this->db->update("tbl_stok_bahan",$dataArray,array("stok_bahan_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/stok_bahan');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/stok_bahan/edit/'.$id); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("tbl_stok_bahan",array("stok_bahan_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/stok_bahan');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/stok_bahan'); 
		}
	}
	
}
