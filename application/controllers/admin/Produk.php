<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_produk');
		$this->load->model('M_bahan');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listBahan'] = $this->M_bahan->getListBahan();
		$data['kode_produk'] = $this->M_produk->kodeTransaksi();
		$data['v_content']  = 'member/produk/add';
		$this->load->view('member/layout', $data);
	}
	
	public function index(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_produk->getListProduk();
		$data['v_content']  = 'member/produk/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_produk->getListProdukId($id);
		$data['listBahan'] = $this->M_bahan->getListBahan();
		$data['v_content']  = 'member/produk/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$upload_path = './uploads/produk/';
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
				$photo = "uploads/produk/".$photo;
			}
		}
		/*====================================== END UPLOADING FEATEURE IMAGE ======================================*/
		$dataArray = array(
			"produk_name"		=> $post['produk_name'],
			"produk_code"		=> $post['produk_code'],
			"produk_gambar"		=> $photo,
			"produk_harga"		=> $post['produk_harga'],
			"produk_stock"		=> $post['produk_stock'],

		);
		$insert = $this->db->insert("tbl_produk",$dataArray);
		$last_id = $this->db->insert_id();
		if($insert){
			foreach ($post['produk_bahan'] as $key => $value) {
				# code...
			
				$dataArray = array(
					"id_bahan"			=> $value['id_bahan'],
					"jumlah_pemakaian"	=> $value['jumlah_digunakan'],
					"id_produk"			=> $last_id,
				);
				$insert = $this->db->insert("tbl_bahan_produk",$dataArray);
				
			}
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/produk');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/produk/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
			$dataArray = array(
				"produk_name"		=> $post['produk_name'],
				"produk_code"		=> $post['produk_code'],
				"produk_harga"		=> $post['produk_harga'],
				"produk_stock"		=> $post['produk_stock'],
			);
		

		$upload_path = './uploads/produk/';
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
				$photo = "uploads/produk/".$photo;
				$dataArray['produk_gambar'] = $photo;
			}
		}
		/*====================================== END UPLOADING FEATEURE IMAGE ======================================*/
		$update = $this->db->update("tbl_produk",$dataArray,array("produk_id" => $id));
		if($update){
			if (!empty($post['produk_bahan_edit'])) {
				foreach ($post['produk_bahan_edit'] as $key => $value) {
					# code...
				
					$dataArray = array(
						"id_bahan"			=> $value['id_bahan'],
						"jumlah_pemakaian"	=> $value['jumlah_digunakan'],
						"id_produk"			=> $id,

					);
					 $this->db->update("tbl_bahan_produk",$dataArray,array("bahan_produk_id" => $value['id_bahan_produk']));
					
				}
			}
			if (!empty($post['produk_bahan'])) {
				foreach ($post['produk_bahan'] as $key => $value) {
					# code...
				
					$dataArray = array(
						"id_bahan"			=> $value['id_bahan'],
						"jumlah_pemakaian"	=> $value['jumlah_digunakan'],
						"id_produk"			=> $id,

					);
					$insert = $this->db->insert("tbl_bahan_produk",$dataArray);
					
				}
			}
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/produk');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/produk/edit/'.$id); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("tbl_produk",array("produk_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/produk');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/produk'); 
		}
	}

	public function deleteBahan($id,$uri){
		$delete = $this->db->delete("tbl_bahan_produk",array("bahan_produk_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/produk/edit/'.$uri);
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/produk/edit/'.$uri);
		}
	}


	public function addProdukAuto(){
		$dataProduk = ['Nasi Goreng Telur','Nasi Goreng Udang','Nasi Goreng Ayam','Nasi Goreng Daging','Nasi Goreng Paru','Nasi Goreng Lidah','Nasi Goreng Sosis','Nasi Goreng Seafood','Nasi Goreng Kampung Udik','Nasi Ayam Kungpao','Nasi Bola Bola Daging Lada Hitam','Nasi Udang Telur Asin','Nasi Udang Goreng','Nasi Ayam Goreng','Nasi Putih','Nasi Merah','Chicken Katsu','Chicken Cordon Bleu + French Fries','Chicken Rainbow','Burger Beef Petty','Burger Suwir Semur Ayam','Burger Suwir Rendang Daging','Burger Suwir Opor Ayam','Krezi Fet Berger','Burger Lada Edan','Nasi Merah Goreng Telur Ceplok','Nasi Merah Goreng Telur Asin','Nasi Merah Goreng Yancow','Nasi Merah Goreng Teri','Cah Brokoli','Capcay','Cah Tauge Ikan Asin','Mie Goreng Spesial','Mie Goreng Pedas/ Ranjau/ Dinamit','Mie Goreng Seafood','Kwetiaw Goreng','Kwetiaw Siram','Mie Instan Tante','Mie Instan Paktor','Spaghetti Meat Ball','Spaghetti Marinara','Spaghetti Bolognaise','Ropang Ice Cream','Ropang Coklat','Ropang Double Keju','Ropang Coklat Keju','Ropang Coklat Susu','Ropang Keju Susu','Ropang Butter Susu','Ropang Butter Gula','Ropang Butter Selai Kacang','Ropang Selai Nanas','Ropang Selai Strawberry','Ropang Ovalmaltine','Ropang Telur + Cornet','Ropang Mozarella','Air Hangat','Air Kemasan','Teh Tawar Hot','Teh Manis Warm','Es Teh Manis','Hot Lemon Grass Tea','Es Tea Lemon','Lemon Tea Madu','Teh Tarik','Susu Jahe Beureum','Self Mix Mocktail Blue','Self Mix Mocktail Red','Self Mix Mocktail Purple','Melon Susu','Melon Selasih','Sereh Punch','Peach Mojito Min','Peach Mojito Strawberry','Peach Mojito Manggo','Orange Squash','Lemon Squash','Oreo Milk Shake','Strawberry Milk Shake','Chocolate Milk Shake','Avocado Milk Shake','Healty Green Juice','Apel + Jeruk + Wortel','Terong Belanda + Jeruk + Mangga','Alpukat','Jambu','Jeruk','Mangga','Sirsak','Strawberry','Jeruk Panas','Kopi Nusantara','Kopi Tubruk','Hot Chocolatos','Pancake Ice Cream','Pancake Kismis With Milk','Pancake Cheese With Milk','Pisang Kafeloaja (Pisang Panggang)','Triple Snack Kafeloaja','Tape Bakar','Tape Goreng','Singkong Kafeloaja','French friesh with cheese','Pisang Goreng With Cheese &amp; Milk','Spicy Chicken Wing','Biterballen','Banana Split','Choconut Ice Cream','Mushroom sc Bangkok','Cassava Thailand','Sop Iga','Sop Iga Bakar + nasi','Sop Ayam + Nasi','Sop Rawon + Nasi','Sirloin Steak Grill 100G','Sirloin Steak Grill 150G','Tenderloin Steak Grill 100G','Tenderloin Steak Grill 150G','Chicken Steak Grill 100G','Chicken Steak Grill 150G','Berger Beef Petty','Berger Suwir Semur Ayam','Berger Suwir Rendang Daging','Berger Suwir Opor Ayam','Krezi Vegi Berger','Ice Cream Vanilla','Ice Cream Strawberry','Ice Cream Chocolate','Mix Coffee Kafeloaja Hot','Mix Coffee Kafeloaja Ice','Kopi Liong Bulan Bogor 1945','Kopi Aroma Bandung','Kopi Bis Kota Jatinegara Est 1943','Kopi Amin Pontianak','Kopi Bola Dunia Lampung','Kopi House Blend Kafeloaja','Roti Panggang 60CM','Mamamku - Pony','Mamamku - Teddy Bear','Mamamku - Little Star','Kroket Blanda','Nasi Gurih Udang Goreng','Nasi Goreng Special','Nasi Goreng Pedes Wadaw','Bihun Goreng','Es Teh Tawar','Minil Cake - Coko Boom','Minil Cake - Oreo Krimmi','Minil Cake - Stroberi Pingki','Minil Cake - Moka Nat','Minil Cake - Pan Coko Cip','Snow Ice Milk','Snow Ice Milk Oreo','Snow Ice Chocolate','Snow Ice Manggo','Telur Dadar','Telur Ceplok','Sosis','Es Batu','Saus Steak','Saus Carbonara','Sauce Bolognaise','Extra Sambal','Tenderloin Steak Fried 150gr','Tenderloin Steak Fried 100gr','Sirloin Steak Fried 150gr','Sirloin Steak  Fried 100gr','Chicken Steak Fried 150gr','Chicken Steak Fried 100gr'];
		// $dataInsert = [];
		foreach ($dataProduk as $key => $value) {
			$newProduk = [
				"produk_name"		=> $value,
				"produk_code"		=> $this->M_produk->kodeTransaksi(),
				"produk_gambar"		=> '/uploads/produk/FI03072019062349295.jpg',
				"produk_harga"		=> '10000',
				"produk_stock"		=> '100'
			];
			$insert = $this->db->insert("tbl_produk",$newProduk);
			$last_id = $this->db->insert_id();

			$dataArray = array(
				"id_bahan"			=> '2',
				"jumlah_pemakaian"	=> '1',
				"id_produk"			=> $last_id,
			);
			$insert = $this->db->insert("tbl_bahan_produk",$dataArray);

			// $dataInsert[] = $newProduk;
		}
	}
	
}
