<?php

class M_login extends CI_Model {

    function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get();
		//debugCode($query->num_rows());
        if($query->num_rows()>0){
            $querycheck = $query->result();
            
			$dataArr = array(
				'UserID'	=> $querycheck[0]->user_id,
				'userName'	=> $querycheck[0]->username,
				"lvlUser"		=> $querycheck[0]->user_status
			);
            
            $this->session->set_userdata('loginData',$dataArr);
            return true;
        }else{
            $this->session->set_flashdata('GagalLogin', 'Ya');    
            return false;
        }  
    }
	
	public function checkemail($email){
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->where('email', $email);
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}

	public function checkProfile($user_id){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
}