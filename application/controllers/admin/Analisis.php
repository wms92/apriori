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

        // get all menu
        $menu = $this->m_menu->getListMenu();
        $menuByCode = [];
        foreach($menu as $k => $val) {
            $key = $val->menu_code;
            $menuName = $val->menu_name;
            $menuByCode[$key] = $menuName;
        }

        // relase memory
        $menu = [];

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
            $menuNameByTrans = [];
            foreach($valExtract as $menuCode) {
                $menuNameByTrans[] = $menuByCode[$menuCode];
            }

            $resTemp = sprintf("Jika pelanggan membeli %s maka pelanggan akan membeli %s", implode(",", $menuNameByTrans), $menuByCode[$lastVal]);
            $res[] = $resTemp;
        }
        
        echo json_encode(['result' => $res], true);
    }

    public function aprioriv3() {
        $get = $this->input->get();

        $startDate = $get['start_date'];
        $endDate = $get['end_date'];
        $minSupport = is_numeric($get['support']) ? $get['support'] : 20;
        $confidence = is_numeric($get['confidence']) ? $get['confidence'] : 75;

        // get all menu
        $menu = $this->m_menu->getListMenu();
        $menuByCode = [];
        foreach($menu as $k => $val) {
            $key = $val->menu_code;
            $menuName = $val->menu_name;
            $menuByCode[$key] = $menuName;
        }

        // relase memory
        $menu = [];

        // load apriori library
        $param = ['min_support' => $minSupport, 'confidence' => $confidence];

        $this->load->library('aprioriv3', $param);
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
            // $this->aprioriv3->addTransaction($key, $dt);
            $alltransaction[] = implode(",", $dt);
        }

        $result = $this->aprioriv3->process($alltransaction);

        $res = [];
        foreach($result as $k => $val) {
            $freqItem = explode(",", $k);
            $mappingMenuName = function($item, $menuByCode) {
                $itemTotal = count($item);
                if($itemTotal > 1) {
                    $itemName = [];
                    foreach($item as $k => $val) {
                        if($k == $itemTotal - 1) {
                            $itemName[] = sprintf("dan %s", $menuByCode[$val]);
                            continue;
                        }
                        $itemName[] = $menuByCode[$val];
                    }

                    return implode(", ", $itemName);
                } else {
                    return $menuByCode[$item[0]];
                }
                
            };

            $resTemp = sprintf("Jika pembeli membeli %s", $mappingMenuName($freqItem, $menuByCode));
            foreach($val as $item => $conf) {
                $itemArr = explode(",", $item);
                $res[] = sprintf("%s maka pembeli akan membeli %s dengan confidence %d%%", $resTemp, $mappingMenuName($itemArr, $menuByCode), $conf);
            }
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
        $itemFreq = [];
        $menuResult = [];

        foreach($alltransaction as $k => $dt) {
            $item = $dt->id_menu_code;
            $transaction[] = $item;

            if(array_key_exists($item, $itemFreq)) {
                $itemFreq[$item] += 1;
            } else {
                $itemFreq[$item] = 1;
            }
            
        }

        // sorting transaction item
        
        asort($itemFreq);
        
        $itemFreqCode = array_keys($itemFreq);
        $menuResult[] = $menu[$itemFreqCode[0]];
        

        $itemFreq = [];

        // selection menu not sold
        foreach($transaction as $val) {
            if(isset($menu[$val])) {
                unset($menu[$val]);
            }
        }

        
        foreach($menu as $key => $item) {
            $menuResult[] = $item;
        }

        $menu = [];

        echo json_encode(['result' => $menuResult], true);
    }
}