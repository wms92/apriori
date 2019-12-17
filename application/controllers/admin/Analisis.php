<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analisis extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
        $this->load->model('m_analisis');
        $this->load->model('m_menu');
    }

    public function index() {
        $data['userLogin']  = $this->session->userdata('loginData');
        $data['v_content'] = 'member/analisis/analisis';
        $this->load->view("member/layout", $data);
    }

    public function apriori() {
        $get = $this->input->get();

        $startDate = $get['start_date'];
        $endDate = $get['end_date'];
        $minSupport = is_numeric($get['support']) ? $get['support'] : 20;

        // load apriori library
        $param = ['min_support' => $minSupport];

        $this->load->library('apriori', $param);

        $alltransaction = $this->m_analisis->transasction($startDate, $endDate);
        $transaction = [];
        foreach($alltransaction as $k => $dt) {
            $key = $dt->transaksi_no;
            $item = $dt->id_menu_code;
            $transaction[$key][] = $item;
        }

        // release memory
        $alltransaction = [];

        // start analisis
        foreach($transaction as $key => $dt) {
            $item = sprintf("{%s}", implode(",", $dt));
            $this->apriori->addTransaction($key, $item);
        }

        $this->apriori->processTransactions();
        $results = $this->apriori->formattedSet();
        $res = [];

        foreach($results as $result) {
            $value = trim($result," \t\n\r\0\x0B{}");
            $valExtract = explode(",", $value);
            $lasInd = count($valExtract) - 1;
            $lastVal = $valExtract[$lasInd];
            $valExtract = array_slice($valExtract, 0, -1);

            $resTemp = sprintf("Jika pelanggan membeli %s maka pelanggan akan membeli %s", implode(",", $valExtract), $lastVal);
            $res[] = $resTemp;
        }
        
        echo json_encode(['result' => $res], true);
    }

    public function notsold() {
        $get = $this->input->get();

        $startDate = $get['start_date'];
        $endDate = $get['end_date'];

        
        $allMenu = $this->m_menu->getListMenu();
        $menu = [];
        // mapping menu
        foreach($allMenu as $key => $dmenu) {
            $menuCode = $dmenu->menu_code;
            $menuName = $dmenu->menu_name;
            $menu[$menuCode] = $menuName;
        }

        // release memory
        $allMenu = [];

        $alltransaction = $this->m_analisis->transasction($startDate, $endDate);
        $transaction = [];
        foreach($alltransaction as $k => $dt) {
            $item = $dt->id_menu_code;
            $transaction[] = $item;
        }

        // selection menu not sold
        foreach($transaction as $val) {
            if(isset($menu[$val])) {
                unset($menu[$val]);
            }
        }

        $menuResult = [];
        foreach($menu as $key => $item) {
            $menuResult[] = $item;
        }

        $menu = [];

        echo json_encode(['result' => $menuResult], true);
    }
}