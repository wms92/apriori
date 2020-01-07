<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
apriori class - apriori data nminer
version 0.1 beta 5/24/2015

Copyright (c) 2015, Wagon Trader

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class Apriori{

    protected $CI;
    
    public $minSupportCount;
    
    public $iteration = 1;
    
    public $tranactionList = array();
    
    public $itemList = array();
    
    public $frequentSet = array();
    
    public $candidateSet = array();
    
    public function __construct($param){
        $this->CI =& get_instance();
        if(!isset($param['min_support'])) {
            $this->minSupportCount = 2;
        } else {
            $this->minSupportCount = $param['min_support'];
        }
         
    }
    
    //adding transaction and performing first iteration
    public function addTransaction($transactionID,$itemList){
        
        if( array_key_exists($transactionID,$this->tranactionList) ){
            return false;
        }
        
        $this->tranactionList[$transactionID] = $itemList;
        
        $items = explode(',',$itemList);
        foreach($items as $item){
            $item = trim($item," \t\n\r\0\x0B{}");
            if( array_key_exists($item,$this->itemList) ){
                $this->itemList[$item]++;
            }else{
                $this->itemList[$item] = 1;
            }
            if( !array_key_exists($item,$this->frequentSet) ){
                if( $this->itemList[$item] == $this->minSupportCount ){
                    $this->frequentSet[] = $item;
                }
            }
        }
        
        return true;
    }
    
    public function processTransactions(){
        
        $this->iteration++;
        if( $this->iteration == 2 ){
            $this->buildCandidateSet();
            $this->countCandidateSet();
            $this->processTransactions();
        }else{
            $this->pruneFrequentSet();
            if( empty($this->candidateSet) ){
                return;
            }else{
                $this->countCandidateSet();
                $this->processTransactions();
            }
            
        }
        
    }
    
    public function formattedSet(){
        $return = [];
        foreach( $this->frequentSet as $value ){
            $return[] = '{'.$value.'}';
        }
        
        return $return;
        
    }
    
    //build candidate set on second iteration
    protected function buildCandidateSet(){
        
        sort($this->frequentSet);
        $n = count($this->frequentSet);
        $r = 2;
        
        for($x=0;$x<$n;$x++){
            $main = $this->frequentSet[$x];
            for($y=$x+1;$y<$n;$y++){
                $this->candidateSet[] = $main.','.$this->frequentSet[$y];
            }
        }
        
    }
    
    //count candidate set and build new frequent set
    protected function countCandidateSet(){
        
        $this->frequentSet = array();
        foreach( $this->tranactionList as $value ){
            $value = trim($value," \t\n\r\0\x0B{}");
            $tran = explode(',',$value);
            
            $n = count($this->candidateSet);
            for($x=0;$x<$n;$x++){
                $cand = explode(',',$this->candidateSet[$x]);
                if( !array_diff($cand,$tran) ){
                    @$candidateCount[$x]++;
                    if( $candidateCount[$x] == $this->minSupportCount ){
                        $this->frequentSet[] = $this->candidateSet[$x];
                    }
                }
            }
            sort($this->frequentSet);
        }
        
    }
    
    //build k+1 and then prune to build new candidate set
    protected function pruneFrequentSet(){
        
        //build k+1
        $n = count($this->frequentSet);
        $lastMain = '';
        $k1 = [];
        for($x=0;$x<$n;$x++){
            $items = explode(',',$this->frequentSet[$x]);
            array_pop($items);
            $main = implode(',',$items);
            if( $main == $lastMain ){continue;}
            for($y=$x+1;$y<$n;$y++){
                $items = explode(',',$this->frequentSet[$y]);
                array_pop($items);
                $check = implode(',',$items);
                if( $main == $check ){continue;}
                $k1[] = $main.','.$this->frequentSet[$y];
            }
            $lastMain = $main;
            
        }
        
        //prune and re-build candidate set
        $this->candidateSet = array();
        foreach( $k1 as $set ){
            $sub = $this->getSubsets($set,$this->iteration-1);
            if( !array_diff($sub,$this->frequentSet) ){
                $this->candidateSet[] = $set;
            }
        }
        
    }
    
    protected function getSubsets($set,$size){
        
        $items = explode(',',$set);
        $n = count($items);
        
        for($x=0;$x<$n;$x++){
            $item = array();
            $c = 0;
            while($c<$size-1){
                if( $c+$x < $n ){
                    $item[] = $items[$c+$x];
                }
                $c++; 
            }
            $main = implode(',',$item);
            
            for($y=$x+$size-1;$y<$n;$y++){
                $sub[] = $main.','.$items[$y];
            }
        }
        
        return $sub;
        
    }
}
?>