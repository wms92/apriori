<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        
    }
	
	public function index()
	{
        $this->load->view('member/Login');
	}
		
	public function doLogin() {
        $dataPost = $this->input->post();
		/* debugCode($dataPost); */
        if ($this->m_login->checkLogin($dataPost['username'], $dataPost['pass'])) {
            //echo "success";
			redirect('admin/dashboard');
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');
            redirect('login');
        }
    }
	
    function logout() {
        $this->session->unset_userdata('loginData');
        redirect('admin/login');
    }
	
	public function register_user(){
		$post 	= $this->input->post();
		$dataArray = array(
			"nama_user" => $post['nama'],
			"email"	    => $post['email'],
			"username"	=> $post['username'],
			"password"	=> md5($post['pass']),
		);
		$insert = $this->db->insert("user",$dataArray);
		if($insert){
			$this->session->set_flashdata('registerOK', 'Ya');
            redirect('login');
			
		}else{
			$this->session->set_flashdata('registerNOT_OK', 'Ya');
            redirect('login');
		}
	}

	public function profile($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->m_login->checkProfile($id);
		$data['v_content']  = 'member/profile';
		$this->load->view('member/layout', $data);
	}
}
