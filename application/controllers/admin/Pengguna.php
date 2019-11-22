<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_pengguna');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/pengguna/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_pengguna->getListPengguna();
		$data['v_content']  = 'member/pengguna/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_pengguna->getListPenggunaId($id);
		$data['v_content']  = 'member/pengguna/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$upload_path = './uploads/profile/';
		/*====================================== BEGIN UPLOADING FEATEURE IMAGE ======================================*/
		$photo = "";
		if ($_FILES['photo']['name'] <> "") {
			$ext           = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$photo = "FI".date("dmYHis").rand(100,999).".".$ext;

			$config['upload_path']   = $upload_path;
			$config['allowed_types'] = 'PNG|png|JPG|jpg|JPEG|jpeg';
			$config['file_name']     = $photo;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('photo')){
				$error = 'error: '. $this->upload->display_errors();
				echo $error;
				die();
			}else{
				$photo = "/uploads/profile/".$photo;
			}
		}
		/*====================================== END UPLOADING FEATEURE IMAGE ======================================*/
		$dataArray = array(
			"username"	=> $post['username'],
			"password"	=> md5($post['password']),
			"user_foto"		=> $photo,
			"user_name"	=> $post['full_name'],
			"user_status" => $post['user_status'],
			"user_jenis_kelamin" => $post['jk'],
			"is_deleted" => 0
		);
		$insert = $this->db->insert("tbl_user",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/pengguna/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/pengguna/add'); 
		}
	}
	
	public function doUpdate($id){
		$userLogin  = $this->session->userdata('loginData');
		$post = $this->input->post();
		
		if($post['password'] != ""){
			$dataArray = array(
				"username"	=> $post['username'],
				"password"	=> md5($post['password']),
				"user_name"	=> $post['full_name'],
				"user_status" => $userLogin['lvlUser'],
				"user_jenis_kelamin" => $post['jk']
			);
		}else{
			$dataArray = array(
				"username"	=> $post['username'],
				"user_name"	=> $post['full_name'],
				"user_status" => $userLogin['lvlUser'],
				"user_jenis_kelamin" => $post['jk']
			);
		}

		$upload_path = './uploads/profile/';
		/*====================================== BEGIN UPLOADING FEATEURE IMAGE ======================================*/
		$photo = "";
		if ($_FILES['photo']['name'] <> "") {
			$ext           = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$photo = "FI".date("dmYHis").rand(100,999).".".$ext;

			$config['upload_path']   = $upload_path;
			$config['allowed_types'] = 'PNG|png|JPG|jpg|JPEG|jpeg';
			$config['file_name']     = $photo;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('photo')){
				$error = 'error: '. $this->upload->display_errors();
				echo $error;
				die();
			}else{
				$photo = "/uploads/profile/".$photo;
				$dataArray['user_foto'] = $photo;
			}
		}
		/*====================================== END UPLOADING FEATEURE IMAGE ======================================*/
		$update = $this->db->update("tbl_user",$dataArray,array("user_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			if ($id == '3' or $id == '2'){
				redirect('admin/login/profile/'.$id);
			} else {
				redirect('admin/pengguna/daftar');
			}
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/pengguna/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("tbl_user",array("user_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/pengguna/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/pengguna/daftar'); 
		}
	}
	
}
