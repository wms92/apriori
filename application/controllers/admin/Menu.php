<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_menu');
		$this->load->model('M_bahan');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listBahan'] = $this->M_bahan->getListBahan();
		$data['kode_menu'] = $this->M_menu->kodeTransaksi();
		$data['v_content']  = 'member/menu/add';
		$this->load->view('member/layout', $data);
	}
	
	public function index(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_menu->getListMenu();
		$data['v_content']  = 'member/menu/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_menu->getListMenuId($id);
		$data['listBahan'] = $this->M_bahan->getListBahan();
		$data['v_content']  = 'member/menu/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$upload_path = './uploads/menu/';
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
				$photo = "uploads/menu/".$photo;
			}
		}
		/*====================================== END UPLOADING FEATEURE IMAGE ======================================*/
		$dataArray = array(
			"menu_name"			=> $post['menu_name'],
			"menu_code"			=> $post['menu_code'],
			"menu_gambar"		=> $photo,
			"menu_harga"		=> $post['menu_harga'],
			"menu_stock"		=> $post['menu_stock'],

		);
		$insert = $this->db->insert("tbl_menu",$dataArray);
		$last_id = $this->db->insert_id();
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/menu');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/menu/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
			$dataArray = array(
				"menu_name"			=> $post['menu_name'],
				"menu_code"			=> $post['menu_code'],
				"menu_harga"		=> $post['menu_harga'],
				"menu_stock"		=> $post['menu_stock'],
			);
		

		$upload_path = './uploads/menu/';
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
				$photo = "uploads/menu/".$photo;
				$dataArray['menu_gambar'] = $photo;
			}
		}
		/*====================================== END UPLOADING FEATEURE IMAGE ======================================*/
		$update = $this->db->update("tbl_menu",$dataArray,array("menu_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/menu');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/menu/edit/'.$id); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("tbl_menu",array("menu_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/menu');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/menu'); 
		}
	}

	public function deleteBahan($id,$uri){
		$delete = $this->db->delete("tbl_bahan_menu",array("bahan_menu_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/menu/edit/'.$uri);
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/menu/edit/'.$uri);
		}
	}


	public function addProdukAuto(){
		$dataProduk = ['Nasi Goreng Telur','Nasi Goreng Udang','Nasi Goreng Ayam','Nasi Goreng Daging','Nasi Goreng Paru','Nasi Goreng Lidah','Nasi Goreng Sosis','Nasi Goreng Seafood','Nasi Goreng Kampung Udik','Nasi Ayam Kungpao','Nasi Bola Bola Daging Lada Hitam','Nasi Udang Telur Asin','Nasi Udang Goreng','Nasi Ayam Goreng','Nasi Putih','Nasi Merah','Chicken Katsu','Chicken Cordon Bleu + French Fries','Chicken Rainbow','Burger Beef Petty','Burger Suwir Semur Ayam','Burger Suwir Rendang Daging','Burger Suwir Opor Ayam','Krezi Fet Berger','Burger Lada Edan','Nasi Merah Goreng Telur Ceplok','Nasi Merah Goreng Telur Asin','Nasi Merah Goreng Yancow','Nasi Merah Goreng Teri','Cah Brokoli','Capcay','Cah Tauge Ikan Asin','Mie Goreng Spesial','Mie Goreng Pedas/ Ranjau/ Dinamit','Mie Goreng Seafood','Kwetiaw Goreng','Kwetiaw Siram','Mie Instan Tante','Mie Instan Paktor','Spaghetti Meat Ball','Spaghetti Marinara','Spaghetti Bolognaise','Ropang Ice Cream','Ropang Coklat','Ropang Double Keju','Ropang Coklat Keju','Ropang Coklat Susu','Ropang Keju Susu','Ropang Butter Susu','Ropang Butter Gula','Ropang Butter Selai Kacang','Ropang Selai Nanas','Ropang Selai Strawberry','Ropang Ovalmaltine','Ropang Telur + Cornet','Ropang Mozarella','Air Hangat','Air Kemasan','Teh Tawar Hot','Teh Manis Warm','Es Teh Manis','Hot Lemon Grass Tea','Es Tea Lemon','Lemon Tea Madu','Teh Tarik','Susu Jahe Beureum','Self Mix Mocktail Blue','Self Mix Mocktail Red','Self Mix Mocktail Purple','Melon Susu','Melon Selasih','Sereh Punch','Peach Mojito Min','Peach Mojito Strawberry','Peach Mojito Manggo','Orange Squash','Lemon Squash','Oreo Milk Shake','Strawberry Milk Shake','Chocolate Milk Shake','Avocado Milk Shake','Healty Green Juice','Apel + Jeruk + Wortel','Terong Belanda + Jeruk + Mangga','Alpukat','Jambu','Jeruk','Mangga','Sirsak','Strawberry','Jeruk Panas','Kopi Nusantara','Kopi Tubruk','Hot Chocolatos','Pancake Ice Cream','Pancake Kismis With Milk','Pancake Cheese With Milk','Pisang Kafeloaja (Pisang Panggang)','Triple Snack Kafeloaja','Tape Bakar','Tape Goreng','Singkong Kafeloaja','French friesh with cheese','Pisang Goreng With Cheese &amp; Milk','Spicy Chicken Wing','Biterballen','Banana Split','Choconut Ice Cream','Mushroom sc Bangkok','Cassava Thailand','Sop Iga','Sop Iga Bakar + nasi','Sop Ayam + Nasi','Sop Rawon + Nasi','Sirloin Steak Grill 100G','Sirloin Steak Grill 150G','Tenderloin Steak Grill 100G','Tenderloin Steak Grill 150G','Chicken Steak Grill 100G','Chicken Steak Grill 150G','Berger Beef Petty','Berger Suwir Semur Ayam','Berger Suwir Rendang Daging','Berger Suwir Opor Ayam','Krezi Vegi Berger','Ice Cream Vanilla','Ice Cream Strawberry','Ice Cream Chocolate','Mix Coffee Kafeloaja Hot','Mix Coffee Kafeloaja Ice','Kopi Liong Bulan Bogor 1945','Kopi Aroma Bandung','Kopi Bis Kota Jatinegara Est 1943','Kopi Amin Pontianak','Kopi Bola Dunia Lampung','Kopi House Blend Kafeloaja','Roti Panggang 60CM','Mamamku - Pony','Mamamku - Teddy Bear','Mamamku - Little Star','Kroket Blanda','Nasi Gurih Udang Goreng','Nasi Goreng Special','Nasi Goreng Pedes Wadaw','Bihun Goreng','Es Teh Tawar','Minil Cake - Coko Boom','Minil Cake - Oreo Krimmi','Minil Cake - Stroberi Pingki','Minil Cake - Moka Nat','Minil Cake - Pan Coko Cip','Snow Ice Milk','Snow Ice Milk Oreo','Snow Ice Chocolate','Snow Ice Manggo','Telur Dadar','Telur Ceplok','Sosis','Es Batu','Saus Steak','Saus Carbonara','Sauce Bolognaise','Extra Sambal','Tenderloin Steak Fried 150gr','Tenderloin Steak Fried 100gr','Sirloin Steak Fried 150gr','Sirloin Steak  Fried 100gr','Chicken Steak Fried 150gr','Chicken Steak Fried 100gr'];
		// $dataInsert = [];
		foreach ($dataProduk as $key => $value) {
			$newProduk = [
				"menu_name"		=> $value,
				"menu_code"		=> $this->M_menu->kodeTransaksi(),
				"menu_gambar"		=> '/uploads/menu/FI03072019062349295.jpg',
				"menu_harga"		=> '10000',
				"menu_stock"		=> '100'
			];
			$insert = $this->db->insert("tbl_menu",$newProduk);
			$last_id = $this->db->insert_id();

			// $dataInsert[] = $newProduk;
		}
	}
	public function generateProduk(){
		$this->load->library('PHPExcel.php');
		$tmpfname = FCPATH.'uploads\resto_mei.xls';
		// $tmpfname = $_FILES['file']['tmp_name'];
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		$dataBaru = [];
		for ($row = 2; $row <= $lastRow; $row++) {
			$dataProduk = ['produk_code'=>$worksheet->getCell('D'.$row)->getValue(),
							'produk_name'=>$worksheet->getCell('G'.$row)->getValue(),
							'produk_harga'=>$worksheet->getCell('L'.$row)->getValue()];
			$numbernya = substr($dataProduk['produk_code'],1);
			$codenya = substr($dataProduk['produk_code'],0,1);
			if (is_numeric($dataProduk['produk_harga']) && is_numeric($numbernya) && ctype_alpha($codenya)) {
				$dataBaru[$dataProduk['produk_code']] = $dataProduk;
			}
		}

		foreach ($dataBaru as $key => $value) {
			$nums = $this->db->query("select produk_code from tbl_produk where produk_code = '".$value['produk_code']."'")->num_rows();
			if ($nums == 0) {
				$this->db->insert('tbl_produk',$value);
			}
		}
	}

	public function updateTanggal()
	{
		$tanggalAwal = date('2019-08-01');
		$tanggalMax = date('Y-m-t',strtotime($tanggalAwal));
		$dataTransaksi = $this->db->query("select * from tbl_transaksi where transaksi_tgl >= '".$tanggalAwal."' and transaksi_tgl <= '".$tanggalMax."'")->result();
		foreach ($dataTransaksi as $key => $value) {
			$this->db->update('tbl_transaksi',['transaksi_tgl'=>str_replace('2019', '2018', $value->transaksi_tgl)],['transaksi_id'=>$value->transaksi_id]);
		}
	}

	public function generateExcel(){
		$this->load->library('PHPExcel.php');
		$tmpfname = FCPATH.'uploads/Resto Sep 2018.xls';
		// $tmpfname = $_FILES['file']['tmp_name'];
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();

		$codeTransaksi = '';
		$tanggalTransaksi = '';
		$dataBaru = [];
		for ($row = 2; $row <= $lastRow; $row++) {
			// $getDate = $worksheet->getCell('U'.$row)->getValue();
			// if (!empty($getDate)) {
			// 	echo (($getDate - 25569) * 86400);
			// 	echo date("Y-d-m", (($getDate - 25569) * 86400));
			// 	die;
			// }
			if (!empty($worksheet->getCell('B'.$row)->getValue()) && 
				!empty($worksheet->getCell('D'.$row)->getValue()) && 
				!empty($worksheet->getCell('K'.$row)->getValue()) && 
				is_numeric($worksheet->getCell('K'.$row)->getValue())
				) {
				$codeTransaksi = $worksheet->getCell('B'.$row)->getValue();

			}
			$dataProduk = ['id_menu_code'=>$worksheet->getCell('D'.$row)->getValue(),
							'transaksi_qty'=>$worksheet->getCell('K'.$row)->getValue(),
							'id_transaksi_code'=>$codeTransaksi];
			$numbernya = substr($dataProduk['id_menu_code'],1);
			$codenya = substr($dataProduk['id_menu_code'],0,1);
			if (!empty($codeTransaksi) && !empty($dataProduk['id_menu_code']) && !empty($dataProduk['transaksi_qty'])) {
				if (is_numeric($numbernya) && ctype_alpha($codenya)) {
					if (empty($dataBaru[$codeTransaksi])) {
						$dataBaru[$codeTransaksi] = [];
					}
					$dataBaru[$codeTransaksi][] = $dataProduk;
				}
			}
		}
		$start = strtotime("1 September 2018");
		$end = strtotime("30 September 2018");
		foreach ($dataBaru as $key => $value) {
			$timestamp = mt_rand($start, $end);
			$this->db->insert('tbl_transaksi',['transaksi_no'=>$key,'transaksi_tgl'=>date("Y-m-d", $timestamp)]);
			$this->db->insert_batch('tbl_detail_transaksi',$value);
		}
	}
	
}
