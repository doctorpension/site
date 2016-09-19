<?php

class Product{
	var $funds = array();
	var $total;
	var $percent;
	
	function addFund($fund){
		$this->funds[] = $fund;
		$this->total += $fund->total_balance;
	}

	function setPercent($total){
		$this->percent = ($this->total/$total * 100);
	}
	
	function getPercent($format = true){
		if($format){
			return number_format($this->percent, 2);
		}
		return $this->percent;
	}

	function getFunds(){
		return $this->funds;
	}

	function getCodes(){
		$codes = array();
		foreach($this->funds as $fund){
			$codes = array_merge($codes, $fund->getCodes());	
		}
		return $codes;
	}

	function getTrackBalance($code){
		$balance = null;
		if(!in_array($code, $this->getCodes())){
			return $balance;
		}
		foreach($this->funds as $fund){
			$balance = $fund->getTrackBalance($code);
			if($balance){
				return $balance;
			}
		}
	}
}



?>
