<?php

//Author : rizky@kpptechnology.co.id 
ini_set('display_errors', 0);
class Myknapsack
{
	protected $CI;
	protected $n;
	protected $wMax;
	protected $weight;
	protected $data;
	protected $solution;
	protected $take;

    function __construct()
    {
        
		$this->CI =& get_instance();
		
        
		
    }

    public function doCalculate($n,$wMax,$list_barang){
    	$value = "";
    	$weight = "";

    	for($i=1;$i<=$n;$i++)
        {
                $v = rand(1, 10);   // value is set random
                $w = rand(1, 10);   // weight is set random
                $value[$i] = $v;
                $weight[$i] = $w;
        }

        // die(var_dump($value));

        $data = "";
        $solution = "";

        for($x=0;$x<=$wMax;$x++){

	            $data[0][$x] = 0;
	    }        

	        // set data value on [0...n][0] to "0"

        for($x=0;$x<=$n;$x++){

        		$data[$x][0] = 0;
        }
        // solution of knapsack problem
        for($i=1; $i<=$n; $i++){
            for($j=0; $j<=$wMax;$j++)
            {
                $option1 = $data[$i-1][$j];
                $option2 = -1000000;
                if($j-$weight[$i]>=0)
                    $option2 = $value[$i]+$data[$i-1][$j-$weight[$i]];

                $data[$i][$j] = max($option1, $option2);
                if($option2 > $option1)       // solution is initialized by "1"
                    $solution[$i][$j] = 1;     // to find the combination item later
            }

        }

        $take="";
        $as = $wMax;
        $total_weight = 0;
        $list_angkut = "";
        for($i=$n; $i>0; $i--)
        {
            
            if(isset($solution[$i][$as]) && $solution[$i][$as]==1)
            {
                $take[$list_barang[$i]] = true;
                $as = $as-$weight[$i];
                $total_weight  = $total_weight+$weight[$i];
                $list_angkut[] = $list_barang[$i];
            }
            else{
                $take[$list_barang[$i]] = false;
            }
        }


        //print item

        echo "Items Value  : ";
        for($i=1; $i<=$n; $i++){
            echo $value[$i]." ";
        }
        echo "<br>";
        echo "Items Weight : ";
        for($i=1; $i<=$n; $i++){
            echo $weight[$i]." ";
        }
        echo "<br>";
        
        //print solution
        echo "Array solution of knapsack problem <br>";
        for($i=0; $i<=$n; $i++)
        {
            for($j=0; $j<=$wMax; $j++)
            {
                echo $data[$i][$j]." ";
            }
            echo "<br>";
        }

        echo "<br>Result solution of knapsack problem ";
        echo "<br>ITEM |  VALUE | WEIGHT | TAKE";
        for($i=1; $i<=$n; $i++)
        {
            echo "<br>".$list_barang[$i]." | ".$value[$i]." | ".$weight[$i]." | ".$take[$list_barang[$i]];

        }
        echo "<br>";
        echo "The best of total value to be taken is ".$data[$n][$wMax]." and total weight ".$total_weight;
		
		$my_return = array("list_angkut" => $list_angkut,
						   "list_angkut_lengkap" => $take,
						   "total_weight" => $weight,
						   "keuntungan" => $data[$n][$wMax]);
		return $my_return;
		// die;

    }


     public function doCalculate2($n,$wMax,$list_barang,$myValue,$myWeight){
    	$value = $myValue;
    	$weight = $myWeight;

    	// for($i=1;$i<=$n;$i++)
     //    {
     //            $v = rand(1, 10);   // value is set random
     //            $w = rand(1, 10);   // weight is set random
     //            $value[$i] = $v;
     //            $weight[$i] = $w;
     //    }

        // die(var_dump($value));

        $data = "";
        $solution = "";

        for($x=0;$x<=$wMax;$x++){

	            $data[0][$x] = 0;
	    }        

	        // set data value on [0...n][0] to "0"

        for($x=0;$x<=$n;$x++){

        		$data[$x][0] = 0;
        }
        // solution of knapsack problem
        for($i=1; $i<=$n; $i++){
            for($j=0; $j<=$wMax;$j++)
            {
                $option1 = $data[$i-1][$j];
                $option2 = -1000000;
                if($j-$weight[$i]>=0)
                    $option2 = $value[$i]+$data[$i-1][$j-$weight[$i]];

                $data[$i][$j] = max($option1, $option2);
                if($option2 > $option1)       // solution is initialized by "1"
                    $solution[$i][$j] = 1;     // to find the combination item later
            }

        }

        $take="";
        $as = $wMax;
        $total_weight = 0;
        $list_angkut = "";
        for($i=$n; $i>0; $i--)
        {
            
            if(isset($solution[$i][$as]) && $solution[$i][$as]==1)
            {
                $take[$list_barang[$i]] = true;
                $as = $as-$weight[$i];
                $total_weight  = $total_weight+$weight[$i];
                $list_angkut[] = $list_barang[$i];
            }
            else{
                $take[$list_barang[$i]] = false;
            }
        }


        //print item
        /*
        echo "Items Value  : ";
        for($i=1; $i<=$n; $i++){
            echo $value[$i]." ";
        }
        echo "<br>";
        echo "Items Weight : ";
        for($i=1; $i<=$n; $i++){
            echo $weight[$i]." ";
        }
        echo "<br>";
        
        //print solution
        echo "Array solution of knapsack problem <br>";
        for($i=0; $i<=$n; $i++)
        {
            for($j=0; $j<=$wMax; $j++)
            {
                echo $data[$i][$j]." ";
            }
            echo "<br>";
        }

        echo "<br>Result solution of knapsack problem ";
        echo "<br>ITEM |  VALUE | WEIGHT | TAKE";
        for($i=1; $i<=$n; $i++)
        {
            echo "<br>".$list_barang[$i]." | ".$value[$i]." | ".$weight[$i]." | ".$take[$list_barang[$i]];

        }
        echo "<br>";
        echo "The best of total value to be taken is ".$data[$n][$wMax]." and total weight ".$total_weight;
		*/
		$my_return = array("list_angkut" => $list_angkut,
						   "list_angkut_lengkap" => $take,
						   "total_weight" => $total_weight,
						   "keuntungan" => $data[$n][$wMax]);
		return $my_return;
		// die;

    }


    public function init($list){
		// echo "<pre>";
		// var_dump($list);
		// echo "</pre>";
		// die;
    	$my_list = $list;
    	$jumlah_barang = count($my_list);
    	$total_volum = $this->total_volum($my_list);
    	$my_return = "";
    	$a=1;
    	$total_operasional = 0;
    	$total_tarif = 0;
    	while($total_volum > 0) {
			  $cari_armada = $this->CI->M_umum->cari_armada($total_volum);
			  $total_operasional = $total_operasional+$cari_armada['biaya_operasional'];
			  $generate = $this->generate($my_list); 
			  $hitung = $this->doCalculate2($jumlah_barang,$cari_armada['maks_volum'],$generate['list_barang'],$generate['list_value'],$generate['list_weight']);
			  $my_return[$a] = array("id_tipe_mobil" => $cari_armada['id_tipe_mobil'],
			  						 "list_item" => $hitung['list_angkut'],
			  						 "tarif" => $hitung['keuntungan'],
			  						 "operasional" =>$cari_armada['biaya_operasional'],
			  						 "total_volume_diangkut" => $hitung['total_weight'],
			  						 "keuntungan" => $hitung['keuntungan']-$cari_armada['biaya_operasional']);
			  
			  foreach($hitung['list_angkut'] as $value){
			  	unset($my_list[$value]);
			  }

			  $total_volum=$total_volum-$hitung['total_weight'];
			  $total_tarif = $total_tarif+$hitung['keuntungan'];
			  $a++;
		} 
		$my_return2 = array("role_angkut" => $my_return,
							"total_tarif" => $total_tarif,
							"total_operasional" => $total_operasional,
							"total_keuntungan" => $total_tarif-$total_operasional,
							);
		return $my_return2;

    }

    public function total_volum($list){
    	$my_volum = 0;
    	foreach ($list as $key => $value) {
    		$my_volum=$my_volum+$value['volume'];
    	}
    	return $my_volum;
    }

    public function generate($list){
    	$total = count($list);
    	$i=1;
    	$my_return = "";
    	$list_barang="";
    	$list_value ="";
    	$list_weight="";
    	foreach($list as $key => $value){
    		$list_barang[$i] = $key;
    		$list_value[$i] = $value['harga'];
    		$list_weight[$i] = $value['volume'];
    		$i++;
    	}
    	$my_return['list_barang'] = $list_barang;
    	$my_return['list_value'] = $list_value;
    	$my_return['list_weight'] = $list_weight;
    	return $my_return;
    }
	


	
	
}	
