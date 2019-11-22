<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Depan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_diagnosa');
		$this->load->model('m_gejala');
		$this->load->model('m_penyakit');
	}
	
	
	public function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$data['data_penyakit'] = $this->m_penyakit->listPenyakit();
		$this->load->view('depan', $data); 
	}
	
}