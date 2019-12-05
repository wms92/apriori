<?php 

require_once FCPATH ."/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pos extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_menu');
		$this->load->model('m_transaksi');
	}

	public function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['barang_data'] = $this->m_menu->getlistMenu();
		$data['no_transaksi'] = $this->getNoOrder();
		// $data['dataApriod'] = $this->getApriori();
		$data['base_foto'] = base_url();
		$data['v_content'] = "member/pos/pos";
		$this->load->view("member/layout", $data);
	}

	public function getApriori($id_barang,$is_api = "api"){
		$dataAll = array();
		if ($is_api == 'api') {
			$id_barang = explode('-', $id_barang);
			$id_barang = implode("','", $id_barang);
		}
		// ini item yang di pilih oleh kasir di pos
		$dataSelectCodeBarang = [];
		$dataSelectBarang = $this->db->query("select menu_code from tbl_menu where menu_code in ('".$id_barang."')")->result();
		foreach ($dataSelectBarang as $key => $value) {
			$dataSelectCodeBarang[] = $value->menu_code;
		}

		$dataBarangs = $this->db->query('select * from tbl_menu')->result_array();
		$dataBarang= [];
		foreach ($dataBarangs as $key => $value) {
			$dataBarang[$value['menu_code']] = $value;
		}


		// Item Set bulan
		$tanggal = array();
		$dataBulan = array();
		// $bulanNya = ['2019-02','2019-05','2019-06'];
		// $bulanNya = ['2018-01','2018-02','2018-05','2018-07','2018-08','2018-09','2018-10','2018-11','2018-12','2019-02','2019-05','2019-06'];
		for($i=1;$i<13;$i++) {
			$dateAwal = mktime(0, 0, 0, date("m")-($i), date("d"), date("Y"));
			$tanggalAwal = date('Y-m-d',$dateAwal);
			if ($i == 1) {
				$tanggalMax = date('Y-m-d');
			}else{
				$dateMax = mktime(0, 0, 0, date("m")-(($i-1)), date("d"), date("Y"));
				$tanggalMax = date('Y-m-d',$dateMax);
			}


			// $tanggalAwal = date($bulanNya[$i].'-01');
			// $tanggalMax = date('Y-m-t',strtotime($tanggalAwal));
			//contoh jika sekarang awalnya tanggal 01-08-2019 maka maxnya 01-07-2019
			//kalau sudah masuk looping ke dua jadi tanggal 01-07-2019 maka maxnya 01-06-2019 
			
			//ini mengambil data transaksi yang menganduk produk yang dipilih
			$tanggal[] = array('awal' => $tanggalAwal,'max' => $tanggalMax);
			$pilihTransaksi = [];
			$selectTransaksi = $this->db->query("select t.transaksi_no from tbl_detail_transaksi dt
					inner join tbl_transaksi t on t.transaksi_no = dt.id_transaksi_code
					where t.transaksi_tgl >= '".$tanggalAwal."' and t.transaksi_tgl <= '".$tanggalMax."' and dt.id_menu_code in ('".$id_barang."') limit 10")->result();
			$no_menu = [];
			$data = [];
			foreach ($selectTransaksi as $key => $value) {
				$this->db->select('p.menu_code,p.menu_name');
				$this->db->from('tbl_detail_transaksi dt');
				$this->db->join('tbl_transaksi t','t.transaksi_no = dt.id_transaksi_code');
				$this->db->join('tbl_menu p','p.menu_code = dt.id_menu_code');
				$this->db->where('t.transaksi_no',$value->transaksi_no);
				if (count($no_menu)>0) {
					$this->db->where_not_in('p.menu_code', $no_menu);
				}
				$datanya = $this->db->get()->result_array();
				foreach ($datanya as $keys => $values) {
					$no_menu[] = $values['menu_code'];
				}
				$data = array_merge($data,$datanya);
			}
			$dataBulan['bulan '.$i] = $data;
		}

		// jumlah data tabular per item
		$dataTotalBarang = [];
		$dataDummyBulan = [];
		$dataAll['itemset'] = $dataBulan;
		foreach ($dataBulan as $key => $value) {
			foreach ($value as $keys => $values) {
				$dataDummyBulan[$key][$values['menu_code']] = $values;
				$dataBarang[$values['menu_code']] = $values['menu_name'];
				if (empty($dataTotalBarang[$values['menu_code']])) {
					$dataTotalBarang[$values['menu_code']] = 1;
				}else{
					$dataTotalBarang[$values['menu_code']] += 1;
				}
			}
		}
		// echo json_encode($dataAll);
		// die;


		// data tabular
		$dataTabular = array('tabular_name'=>$dataBarang);
		foreach ($dataBulan as $key => $value) {
			foreach ($value as $keys => $values) {
				foreach ($dataBarang as $keyt => $valuet) {
					if (empty($dataTabular[$key][$keyt])) {
						$dataTabular[$key][$keyt] = '0';
						if ($values['menu_code'] == $keyt) {
							$dataTabular[$key][$keyt] = 1;
						}
					}
				}
			}
		}

		// data support jumlah barang tabular di bagi 12 bulan
		$dataSupport = [];
		$dataAll['tabular'] = $dataTabular;
		foreach ($dataTotalBarang as $key => $value) {
			$dataSupport[$key] = ($value/count($dataBulan));
		}

		$dataAll['datanilaiSupport'] = $dataTotalBarang;

		// $minimalitemSupport = 0.1;
		$itemSetSupport = $dataSupport;
		// foreach ($itemSetSupport as $key => $value) {
		// 	if ($value < $minimalitemSupport) {
		// 		unset($itemSetSupport[$key]);
		// 	}
		// }


		// ini penyocokan data item set 2
		$dataAll['dataSupport'] = $itemSetSupport;
		$id_barang = explode('","', $id_barang);
		$itemSet2 = $dataAll['dataSupport'];
		$itemSet2_new = $dataAll['dataSupport'];
		$itemSetPasangan = [];
		foreach ($itemSet2 as $key => $value) {
			array_shift($itemSet2_new);
			foreach ($itemSet2_new as $key2 => $value2) {
				if ($key != $key2) {
					$itemSetPasangan[] = array('nilai'=>0,'isi'=>array($key,$key2));
				}
			}
		}

		// jika di itemset 2 ada di bulan itu, maka itemset bertambah nilainya
		foreach ($dataDummyBulan as $key => $value) {
			foreach ($itemSetPasangan as $keyt => $valuet) {
				$pasangan = 0;
				foreach ($valuet['isi'] as $keyts => $valuets) {
					if (!empty($value[$valuets])) {
						$pasangan +=1;
					}
				}
				if ($pasangan == 2) {
					$itemSetPasangan[$keyt]['nilai'] +=1;
				}
			}
		}

		$dataAll['tabular'] = $dataTabular;
		$dataAll['dataSupportPasangan'] = $itemSetPasangan;

		// penyeleksian itemset 2 hanya muncul dibawah 2 , maka di hilangkan
		$itemSetPasanganNew = $itemSetPasangan;
		$minimalitemSupport = 2;

		$temConfidenMin = [];
		$no = 0;
		foreach ($itemSetPasanganNew as $key => $value) {
			if ($value['nilai'] < $minimalitemSupport) {
				if ($no<2) {
					$temConfidenMin[] = $value;
					$no++;
				}
				unset($itemSetPasanganNew[$key]);
			}
		}
		$dataAll['dataSupportPasanganNew'] = $itemSetPasanganNew;

		// perhitungan nilai itemset2 di bagi dengan nilai data itemset2 pertama
		foreach ($itemSetPasanganNew as $key => $value) {
			$dataAll['nilaiConfident'][$key] = array('nilai'=>$value['nilai']/$dataTotalBarang[$value['isi'][0]],'isi'=>$value['isi']);
		}

		// $itemTerbanyak = array('nilai' => 0, 'index' => -1);

		// jika nilai konfident tidak ada yang diatas 20% maka hitungan apriori selesai
		if(empty($dataAll['nilaiConfident']) || count($dataAll['nilaiConfident']) == 1){
			$dataAll['dataConfident'] = [];
			$dataAll['dataConfidentMin'] = $temConfidenMin;
			$dataAll['dataApriori'] = [];
			$dataAll['barang'] = $dataBarang;
			if ($is_api == "api") {
				echo json_encode($dataAll);
				return true;
			}else{
				return $dataAll;
			}
		}

		$minimalConfidend = 0.40;
		$itemConfidentNew = $dataAll['nilaiConfident'];
		foreach ($itemConfidentNew as $key => $value) {
			// perhitungan nilai itemset di bawah 60% atau 0.6
			if ($value['nilai'] < $minimalConfidend) {
				unset($itemConfidentNew[$key]);
			}else{
				// jika barang sudah di beli maka tidak akan di rekomendasikan
				$checkKesamaan = 0;
				foreach ($value['isi'] as $keys => $values) {
				 	if (in_array($values, $dataSelectCodeBarang)) {
				 		$checkKesamaan +=1;
			 		}
				}
				// penghapusan rekomendasi kesamaan barang yang sudah di beli
				if ($checkKesamaan == 2) {
					unset($itemConfidentNew[$key]);
				}else{
					// penghapusan jika item set yang tidak ada sangkut pautnya dengan item yang dibeli dan direkomendasikan
					if (in_array($value['isi'][0], $dataSelectCodeBarang)) {
						// if ($itemTerbanyak['nilai'] < $value['nilai']) {
						// 	$itemTerbanyak = array('nilai' => $value['nilai'], 'index' => $key);
						// }
					}else{
						unset($itemConfidentNew[$key]);
					}
				}
			}
		}
		function cmp($a, $b) {
		    return $a['nilai'] < $b['nilai'];
		}

		usort($itemConfidentNew, "cmp");

		$temConfiden = [];
		$no = 0;
		foreach ($itemConfidentNew as $key => $value) {
			if ($no < 2) {
				$temConfiden[] = $value;
				$no ++;
			}
		}

		$dataAll['dataConfident'] = $temConfiden;
		$dataAll['dataConfidentMin'] = $temConfidenMin;
		$dataAll['barang'] = $dataBarang;

		if ($is_api == "api") {
			echo json_encode($dataAll);
		}else{
			return $dataAll;
		}
		// die;
	}

	public function tampilApriori($id_barang)
	{
		$id_barangnew = implode(',', $id_barang);

		$data['userLogin'] = $this->session->userdata('loginData');
		$data['dataApriod'] = $this->getApriori($id_barangnew,'web');
		$data['id_barang'] = implode('-', $id_barang);
		$data['v_content'] = "member/pos/hasil";
		$this->load->view("member/layout", $data);
	}

	public function downLoadExcel($id_barang)
	{
		$id_barang = explode('-', $id_barang);
		$id_barang = implode("','", $id_barang);
		$dataAll = $this->getApriori($id_barang,'web');
		$dataAll = json_encode($dataAll);
		$dataAll = json_decode($dataAll);
		$bulan = count($dataAll->itemset);
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$no =3;
		$temp = "A";
		$sheet->setCellValue('A2', 'Item Set Perbulan');
		foreach ($dataAll->itemset as $key => $value) {
			$sheet->setCellValue('A'.$no, $key);
			$text = '';
			foreach ($value as $keys => $values) {
				if ($keys != 0) {
					$text .= ',';
				}
				$text .= $values->menu_code;
			}
			$sheet->setCellValue('B'.$no, $text);
			$no++;
		}

		$no+=2;
		$sheet->setCellValue('A'.$no, 'Item Set Tabular');
		$no++;
		foreach ($dataAll->tabular as $key => $value) {
			if ($key == 'tabular_name') {
				$sheet->setCellValue('A'.$no, 'Bulan');
				$temp = "B";
				foreach ($value as $keys => $values) {
					$sheet->setCellValue($temp.$no, $keys);
					$temp++;
				}
			}else{
				$sheet->setCellValue('A'.$no, $key);
				$temp = "B";
				foreach ($value as $keys => $values) {
					$sheet->setCellValue($temp.$no, $values);
					$temp++;
				}
			}
			$no++;
		}


		$no+=2;
		$sheet->setCellValue('A'.$no, 'Support Per item');
		$no++;
		foreach ($dataAll->datanilaiSupport as $key => $value) {
			$sheet->setCellValue('A'.$no, $key);
			$sheet->setCellValue('B'.$no, ($value*$bulan).'%');
			$no++;
		}

		$no+=2;
		$sheet->setCellValue('A'.$no, 'Support 2-item Set');
		$no++;
		foreach ($dataAll->dataSupportPasangan as $key => $value) {
			$text = '';
			foreach ($value->isi as $keys => $values) {
				if ($keys != 0) {
					$text .= ',';
				}
				$text .= $values;
			}
			$sheet->setCellValue('A'.$no, $text);
			$sheet->setCellValue('B'.$no, ($value->nilai*$bulan).'%');
			$no++;
		}

		$no+=2;
		$sheet->setCellValue('A'.$no, 'Support 2-item Set Min 2 kali muncul');
		$no++;
		foreach ($dataAll->dataSupportPasanganNew as $key => $value) {
			$text = '';
			foreach ($value->isi as $keys => $values) {
				if ($keys != 0) {
					$text .= ',';
				}
				$text .= $values;
			}
			$sheet->setCellValue('A'.$no, $text);
			$sheet->setCellValue('B'.$no, ($value->nilai*$bulan).'%');
			$no++;
		}

		$no+=2;
		$sheet->setCellValue('A'.$no, 'Nilai Confidence');
		$no++;
		foreach ($dataAll->nilaiConfident as $key => $value) {
			$text = '';
			foreach ($value->isi as $keys => $values) {
				if ($keys == 0) {
					$text .= 'Jika membeli ';
				}else{
					$text .= ', maka akan membeli ';
				}
				$text .= $values;
			}
			$sheet->setCellValue('A'.$no, $text);
			$sheet->setCellValue('B'.$no, ($value->nilai*100).'%');
			$no++;
		}

		$no+=2;
		$sheet->setCellValue('A'.$no, 'Nilai Confidence Min 40%');
		$no++;
		foreach ($dataAll->dataConfident as $key => $value) {
			$text = '';
			foreach ($value->isi as $keys => $values) {
				if ($keys == 0) {
					$text .= 'Jika membeli ';
				}else{
					$text .= ', maka akan membeli ';
				}
				$text .= $values;
			}
			$sheet->setCellValue('A'.$no, $text);
			$sheet->setCellValue('B'.$no, ($value->nilai*100).'%');
			$no++;
		}

		// if (!empty($dataAll->data3Confiden)) {
		// 	$no+=2;
		// 	$sheet->setCellValue('A'.$no, 'Nilai Confidence 3 Set');
		// 	$no++;
		// 	foreach ($dataAll->data3Confiden as $key => $value) {
		// 		$text = '';
		// 		foreach ($value->isi as $keys => $values) {
		// 				if ($keys == 0) {
		// 					$text .= 'Jika membeli ';
		// 					$text .= $values;
		// 				}else if ($keys == 1) {
		// 					$text .= ', maka akan membeli ';
		// 					$text .= $values;
		// 				}else{
		// 					$text .= ' dan ';
		// 					$text .= $values;
		// 				}
		// 		}
		// 		$sheet->setCellValue('A'.$no, $text);
		// 		$sheet->setCellValue('B'.$no, ($value->nilai*100).'%');
		// 		$no++;
		// 	}
		// }

		// if (!empty($dataAll->data3Confiden)) {
		// 	$no+=2;
		// 	$sheet->setCellValue('A'.$no, 'Nilai Confidence 3 Set 30%');
		// 	$no++;
		// 	foreach ($dataAll->dataHasil3Confiden as $key => $value) {
		// 		$text = '';
		// 		foreach ($value->isi as $keys => $values) {
		// 			if ($keys == 0) {
		// 				$text .= 'Jika membeli ';
		// 				$text .= $values;
		// 			}else if ($keys == 1) {
		// 				$text .= ', maka akan membeli ';
		// 				$text .= $values;
		// 			}else{
		// 				$text .= ' dan ';
		// 				$text .= $values;
		// 			}
		// 		}
		// 		$sheet->setCellValue('A'.$no, $text);
		// 		$sheet->setCellValue('B'.$no, ($value->nilai*100).'%');
		// 		$no++;
		// 	}
		// }

		$writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="dataApriori.xls"'); /*-- $filename is  xsl filename ---*/
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

	}

	function getNoOrder(){
		$this->db->where('tbl_transaksi.transaksi_tgl',date('Y-m-d'));
        $sales = $this->db->get('tbl_transaksi')->result();
        $num = count($sales) + 1;
        $number_increment = sprintf('%03d',$num);
        $number = date('Ymd').$number_increment;
        return $number;
	}

	public function posTransaksi(){
		$dataUser = $this->session->userdata('loginData');
		$pos = $this->input->post();

		$dataBarang = $this->db->query('select * from tbl_menu p ')->result();
		$dataBarangs= [];
		foreach ($dataBarang as $key => $value) {
			$dataBarangs[$value->menu_code] = [];
			$dataBarangs[$value->menu_code][] = $value;
		}

		$dataArray = array(
			'transaksi_no' => $this->getNoOrder(),
			'transaksi_tgl' => date('Y-m-d'),
			'id_user' => $dataUser['UserID'],
		);

		$insert = $this->db->insert("tbl_transaksi" , $dataArray);
		$dataPembelian = array();
		$dataPemakaianStok = array();
		$id_insert = $this->db->insert_id();
		$jumlahBarang = rand(1,5);
		// $dataPilihBarang = [];
		foreach ($pos['barang_keluar'] as $key => $value) {
			$dataPembelian[] = array('id_transaksi_code' => $dataArray['transaksi_no'],
											'id_menu_code' => $value['menu_code'],
											'transaksi_qty'=>$value['jumlah']);
			$this->db->set('menu_stock', 'menu_stock-'.$value['jumlah'], FALSE);
			$this->db->where('menu_code', $value['menu_code']);
			$this->db->update('tbl_menu');

			// $dataPilihBarang[] = $value['menu_id'];

		}
		$this->db->insert_batch('tbl_detail_transaksi',$dataPembelian);

		if($insert){
			$this->m_umum->generatePesan("Berhasil transaksi","berhasil");
			redirect('admin/pos/');
		}else{
			$this->m_umum->generatePesan("Gagal transaksi","gagal");
			redirect('admin/pos/');
		}
	}
}
?>