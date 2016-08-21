<?php

class Portfolio{

	var $pensia;
	var $hishtalmut;
	var $gemel;
	var $minhalim;
	var $totalBalance;
	var $totalProjectedLump;
	var $totalPension;
	var $riskLevel;
	var $riskMatches;
	var $annualFees;
	var $isTakzivit = false;
	
	
	function __construct($policies, $aggregations){
		$this->pensia = new Product();
		$this->hishtalmut = new Product();
		$this->gemel = new Product();
		$this->minhalim = new Product();
		$this->setAggregations($aggregations);
		$this->setProducts($policies);
		$this->setProductAggregations();
	}
	
	
	function setProducts($policies){
		foreach($policies as $current_policy){
			$this_fund = new Fund($current_policy);
			switch($this_fund->getType()){
				case 'pensia':
					$this->pensia->addFund($this_fund);
					break;
				case 'hishtalmut':
					$this->hishtalmut->addFund($this_fund);
					break;
				case 'gemel':
					$this->gemel->addFund($this_fund);
					break;
				case 'minhalim':
					$this->minhalim->addFund($this_fund);
					break;
				case 'takzivit':
					$this->isTakzivit = true;
			}
		}
	}

	function setAggregations($aggregations){
		$this->totalBalance = $aggregations['totalBalance'];
		$this->totalProjectedLump = $aggregations['projectedLumpSumAtRetirement'];
		$this->totalPension = $aggregations['projectedPensionAtRetirement'];
		$this->riskLevel = $aggregations['riskLevel'];
		//$this->riskMatches = $aggregations['riskMatches'];
		$this->riskMatches = 0;
		$this->annualFees = $aggregations['projectedAnnualFees'];
	}
	
	function setProductAggregations(){
		$this->pensia->setPercent($this->totalBalance);
		$this->hishtalmut->setPercent($this->totalBalance);
		$this->gemel->setPercent($this->totalBalance);
		$this->minhalim->setPercent($this->totalBalance);
	}
	
	function getProduct($product_name){
		switch($product_name){
			case 'pensia':
				return $this->pensia;
			case 'hishtalmut':
				return $this->hishtalmut;
			case 'gemel':
				return $this->gemel;
			case 'minhalim':
				return $this->minhalim;
		}
		
	}
	
}

?>
