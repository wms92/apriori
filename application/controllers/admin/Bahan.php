<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bahan extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_bahan');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/bahan/add';
		$this->load->view('member/layout', $data);
	}
	
	public function index(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_bahan->getListBahan();
		$data['v_content']  = 'member/bahan/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_bahan->getListBahanId($id);
		$data['v_content']  = 'member/bahan/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		
		$dataArray = array(
			"bahan_name"	=> $post['bahan_name'],
			"bahan_satuan"	=> $post['bahan_satuan'],

		);
		$insert = $this->db->insert("tbl_bahan",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/bahan');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/bahan/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
		
			$dataArray = array(
				"bahan_name"	=> $post['bahan_name'],
				"bahan_satuan"	=> $post['bahan_satuan'],
			);
		
		
		$update = $this->db->update("tbl_bahan",$dataArray,array("bahan_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/bahan');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/bahan'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("tbl_bahan",array("bahan_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/bahan');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/bahan'); 
		}
	}
	
}
