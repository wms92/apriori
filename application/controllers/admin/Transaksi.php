<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_transaksi');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/transaksi/add';
		$this->load->view('member/layout', $data);
	}

	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$post = $this->input->post();
		$data['listData']	= $this->M_transaksi->getListTransaksiByDate();
		$data['v_content']  = 'member/transaksi/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function index(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/transaksi/add';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_transaksi->getListTransaksiId($id);
		$data['v_content']  = 'member/transaksi/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$post = $this->input->post();
		
		$dataArray = array(
			"transaksi_no"		=> $post['transaksi_no'],
			"transaksi_tgl"		=> $post['transaksi_tgl'],
			"id_user"			=> $data['userLogin']['UserID']

		);
		$insert = $this->db->insert("tbl_kelas",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/kelas/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/kelas/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
		
			$dataArray = array(
				"kelas_nama"		=> $post['nama'],
			);
		
		
		$update = $this->db->update("tbl_kelas",$dataArray,array("kelas_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/kelas/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/kelas/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("tbl_transaksi",array("transaksi_id" => $id));
		if($delete){
			$hapus = $this->db->delete("tbl_detail_transaksi",array("id_transaksi" => $id));
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/transaksi');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/transaksi'); 
		}
	}

	public function getNoOrder($tanggal){
		$this->db->where('tbl_transaksi.transaksi_tgl',$tanggal);
        $sales = $this->db->get('tbl_transaksi')->result();
        $num = count($sales) + 1;
        $number_increment = sprintf('%03d',$num);
        $number = date("Ymd", strtotime($tanggal) ).$number_increment;
        return $number;
	}


	public function addAutomatic()
	{
		$dataUser = $this->session->userdata('loginData');
		$dataBarang = $this->db->query('select * from tbl_menu')->result();
		$dataBarangs= [];
		foreach ($dataBarang as $key => $value) {
			// $dataBarangs[$value->menu_id] = [];
			$dataBarangs[$value->menu_id] = $value;
		}
		$tglTransaksi = array(
								'2018-07-15',
								'2018-07-24',
								'2018-08-15',
								'2018-08-24',
								'2018-09-03',
								'2018-09-16',
								'2018-10-10',
								'2018-10-21',
								'2018-11-14',
								'2018-11-26',
								'2018-12-21',
								'2018-12-09',
								'2019-01-01',
								'2019-01-17',
								'2019-02-05',
								'2019-02-20',
								'2019-03-15',
								'2019-03-26',
								'2019-04-07',
								'2019-04-24',
								'2019-05-19',
								'2019-05-06',
								'2019-06-19',
								'2019-06-06',
								'2019-07-19',
								'2019-07-06',
								'2019-08-19',
								'2019-08-06',
								'2019-09-19',
								'2019-09-06',
								'2019-10-19',
								'2019-10-06',
								'2019-11-19',
								'2019-11-06',
								'2019-12-19',
								'2019-12-06',
								'2020-01-19',
								'2020-01-06');
		for($i=0;$i<300;$i++){
			$tanggal = $tglTransaksi[rand(0,37)];
			$no_transaksi = $this->getNoOrder($tanggal);
			$dataArray = array(
				'transaksi_no' => $no_transaksi,
				'transaksi_tgl' => $tanggal,
				'id_user' => $dataUser['UserID'],
			);	

			$insert = $this->db->insert("tbl_transaksi" , $dataArray);
			$dataPembelian = array();
			$id_insert = $this->db->insert_id();
			$jumlahBarang = rand(1,5);
			for ($j=0;$j<$jumlahBarang;$j++) {
				$id_barang = rand(1,305);
				$dataPembelian[] = array('id_transaksi' => $id_insert,
											'id_transaksi_code' => $no_transaksi,
												'id_menu_code' => $dataBarangs[$id_barang]->menu_code,
												'transaksi_qty'=>rand(1,3));
			}
			$this->db->insert_batch('tbl_detail_transaksi',$dataPembelian);
		}
	}

	public function export(){
	    // Load plugin PHPExcel nya
	    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	    
	    // Panggil class PHPExcel nya
	    $excel = new PHPExcel();
	    // Settingan awal fil excel
	    $excel->getProperties()->setCreator('My Notes Code')
	                 ->setLastModifiedBy('My Notes Code')
	                 ->setTitle("Data Siswa")
	                 ->setSubject("Siswa")
	                 ->setDescription("Laporan Semua Data Siswa")
	                 ->setKeywords("Data Siswa");
	    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	    $style_col = array(
	      	'font' => array('bold' => true), // Set font nya jadi bold
	      	'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	      	),
	      	'borders' => array(
	        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	      	)
	    );
	    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	    $style_row = array(
	      	'alignment' => array(
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      		),
	      	'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	      	)
	    );
	    $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
	    $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
	    // Buat header tabel nya pada baris ke 3
	    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
	    $excel->setActiveSheetIndex(0)->setCellValue('B3', "NO TRANSAKSI"); // Set kolom B3 dengan tulisan "NIS"
	    $excel->setActiveSheetIndex(0)->setCellValue('C3', "TANGAL TRANSAKSI"); // Set kolom C3 dengan tulisan "NAMA"
	    $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA BARANG"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	    $excel->setActiveSheetIndex(0)->setCellValue('E3', "JUMLAH TRANSAKSI"); // Set kolom E3 dengan tulisan "ALAMAT"
	    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
	    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
	    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
	    $transaksi = $this->M_transaksi->getListAllTransaksi();
	    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
	    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
	    foreach($transaksi as $data){ // Lakukan looping pada variabel siswa
	      	$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
	      	$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->transaksi_no);
	      	$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->transaksi_tgl);
	      	$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->menu_name);
	      	$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->transaksi_qty);
	      
	      	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	      	$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
	      	$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
	      	$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
	      	$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	      	$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
	      
	      	$no++; // Tambah 1 setiap kali looping
	      	$numrow++; // Tambah 1 setiap kali looping
	    }
	    // Set width kolom
	    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
	    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
	    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
	    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
	    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
	    
	    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	    // Set orientasi kertas jadi LANDSCAPE
	    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	    // Set judul file excel nya
	    $excel->getActiveSheet(0)->setTitle("Laporan Data Transaksi");
	    $excel->setActiveSheetIndex(0);
	    // Proses file excel
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment; filename="Data Transaksi.xlsx"'); // Set nama file excel nya
	    header('Cache-Control: max-age=0');
	    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	    $write->save('php://output');
  	}
	
}
