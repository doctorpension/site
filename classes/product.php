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
		$this->percent = $this->total/$total;
	}
	
	function getFunds(){
		return $this->funds;
	}
}



?>