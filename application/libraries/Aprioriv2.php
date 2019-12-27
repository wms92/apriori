<?php
/** PHPExcel root directory */
if (!defined('PHPML_ROOT')) {
    define('PHPML_ROOT', dirname(__FILE__) . '/');
    require(PHPML_ROOT . 'PHPML/autoload.php');
}

use Phpml\Association\Apriori;

class Aprioriv2 {
    private $minSupportCount;

    private $confidence;

    private $transactionList = array();

    private $associator;

    public function __construct($param) {
        $this->minSupportCount = $param['min_support'] / 100;
        $this->confidence = $param['confidence'] / 100;
        $this->associator = New Apriori($this->minSupportCount, $this->confidence);
    }

    public function addTransaction($transactionID, $itemList) {
        if(array_key_exists($transactionID, $this->transactionList)) {
            return false;
        }

        $this->transactionList[] = $itemList;
    }

    public function processTransaction() {
        $labels = [];
        $this->associator->train($this->transactionList, $labels);
        return $this->associator->apriori();
    }
}

?>