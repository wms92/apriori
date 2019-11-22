<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	function __construct() {
        parent::__construct();
				$this->load->library('form_validation');
    }

	public function index()
	{
		$data['msg'] = $this->session->flashdata('msg');
    	$this->load->view('daftar', $data);
	}

	public function register() {
		$post = $this->input->post();

		$dataArray = array(
			"nama_pengguna" => $post['nama'],
			"jk" 			=> $post['jk'],
			"umur" 			=> $post['umur'],
			"email" 		=> $post['email'],
			"username"		=> $post['username'],
			"password"		=> md5($post['password'])
		);
		$insert = $this->db->insert("pengguna",$dataArray);
		if($insert){
			$this->session->set_flashdata("Berhasil menambahkan data","berhasil");
			redirect('login');
		}else{
			$this->session->set_flashdata("Gagal menambahkan data","gagal");
			redirect('daftar'); 
		}
	}

}
