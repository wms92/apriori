<?php
class M_api extends CI_Model {
	private $signature_valid;
	function __construct() {
		parent::__construct ();
		$this->load->database ();
		$this->checking_signature($this->input->post('signature')); // checking signature,
	} 
		
	function sendOutput($dataArray, $status, $miss_param = array()) {
		$descriptionStatus = array ( 
				"200" => "OK",
				"400" => "Validation Error", // harusnya int dia kirim str
				"401" => "Auth Denied", // signature salah
				"402" => "Invalid Parameter", // kurang paramater post
				"403" => "User Access Token Expired",
				"501" => "Internal Server Error" ,
				"405" => "Data Kosong" 
		); 
		
		$defaultArray = array (
				'greeting' => 'Welcome',
				'pic' => 'Rizky Muhammad', 
				'server_time' => date ( 'd-m-Y H:i:s' ),
				'status' => $status,
				'status_desc' => $descriptionStatus [$status],
				'results' => array () ,
				'kurang_parameter' => $miss_param
		);
		
		$defaultArray = array_merge ( $defaultArray, $dataArray );
		$json = json_encode ( $defaultArray );
		$this->save_access_log ( $json, $status, $miss_param ); // saving access log
		header ( 'Access-Control-Allow-Origin: *' );
		header ( 'Access-Control-Expose-Headers: Access-Control-Allow-Origin' );
		header ( "HTTP/1.1 200 OK" );
		header ( 'Content-Type: application/json' );
		echo $json;
		die ();
	}
	
	/*
	 * Untuk memvalidasi parameter benar semuanya terkirim dan tidak null
	 * Untuk memvalidasi parameter benar semuanya terkirim dan tidak null
	 *
	 */
	function requireValidation($param) {
		// function utk check requirement wajib
		$invalid = 0;
		$invalid_param = array ();
		foreach ( $param as $key => $value ) {
			if ($value == "" || ! ($key) || $value == " ") {
				$invalid ++;
				$invalid_param [] = $key;
			}
		}
		
		$hasil = array (
				'invalid' => $invalid,
				'invalid_index' => $invalid_param,
				'status' => ($invalid > 0) ? false : true 
		);
		if (! $hasil ['status']) {
			$this->sendOutput ( array (
					'pic' => "Yulia. F <yulia@kpptechnology.co.id>" 
			), 402, $invalid_param );
		} else {
			return $hasil;
		}
	}
	function get_fb_email($key) {
		$url = 'https://graph.facebook.com/me?fields=email&access_token=' . $key;
		$get = file_get_contents ( $url );
		$export = json_decode ( $get, true );
		return $export ['email'];
	}
	function checking_signature($key) {
		$this->db->from("tblSignatureApi");
		$this->db->where('SignatureKey',$key); 
		$query = $this->db->get();
		if ($query->num_rows () > 0) {
			$this->signature_valid = $key; 
			return true;
		} else {
			$this->sendOutput ( array (
					'pic' => "Rizky Muhammad" 
			), 401 );
		}
	}
	function get_client_ip() {
		$ipaddress = '';
		if (getenv ( 'HTTP_CLIENT_IP' ))
			$ipaddress = getenv ( 'HTTP_CLIENT_IP' );
		else if (getenv ( 'HTTP_X_FORWARDED_FOR' ))
			$ipaddress = getenv ( 'HTTP_X_FORWARDED_FOR' );
		else if (getenv ( 'HTTP_X_FORWARDED' ))
			$ipaddress = getenv ( 'HTTP_X_FORWARDED' );
		else if (getenv ( 'HTTP_FORWARDED_FOR' ))
			$ipaddress = getenv ( 'HTTP_FORWARDED_FOR' );
		else if (getenv ( 'HTTP_FORWARDED' ))
			$ipaddress = getenv ( 'HTTP_FORWARDED' );
		else if (getenv ( 'REMOTE_ADDR' ))
			$ipaddress = getenv ( 'REMOTE_ADDR' );
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	function save_access_log($output, $status, $miss_param = array()) {
		$method_request = $this->uri->segment ( 3 ); // not use 
		$request_param = $this->input->post (); // will return the array ?  
		 
		$data_insert = array (
				"SignatureKey" => $this->input->post ( 'signature' ),
				"IpClient" => $this->get_client_ip (),
				// "IpClientForward" => ($_SERVER ['HTTP_X_FORWARDED_FOR']) ? $_SERVER ['HTTP_X_FORWARDED_FOR'] : $this->get_client_ip (),
				"IpClientForward" => (getenv('HTTP_X_FORWARDED_FOR')) ? getenv('HTTP_X_FORWARDED_FOR') : $this->get_client_ip (),
				"UserAccessToken" => $this->input->post ( 'user_access_token' ),
				"MethodRequest" => $this->uri->segment ( 3 ),
				"RequestParam" => json_encode ( $request_param ),
				"ResponseApi" => $output,
				"ResponseStatus" => $status,
				"CreatedDate" => date ( 'Y-m-d H:i:s' ),
				"MissedParam" => json_encode ( $miss_param ) 
		);
		$this->db->insert ( 'tblApiAccessLog', $data_insert );
		return true;
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen ( $characters );
		$randomString = '';
		for($i = 0; $i < $length; $i ++) {
			$randomString .= $characters [rand ( 0, $charactersLength - 1 )];
		}
		return $randomString;
	}
}

?>