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
}



?>
