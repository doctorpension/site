<?php

class Portfolio{

	var $totalBalance;
	var $pensia;
	var $hishtalmut;
	var $gemel;
	var $minhalim;
	var $projectedTotalBalance;
	var $totalProjectedLump;
	var $totalPension;
	var $riskLevel;
	var $riskLevelFit;
	var $annualFees;
	var $isTakzivit = false;
	var $insurance;
	var $insuranceMatches;
	
	function __construct($policies, $aggregations, $insurance){
		$this->pensia = new Product();
		$this->hishtalmut = new Product();
		$this->gemel = new Product();
		$this->minhalim = new Product();
		$this->insurance = new Insurance($insurance);
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
		$this->projectedTotalBalance = $aggregations['projectedTotalBalance'];
		$this->totalProjectedLump = $aggregations['projectedLumpSumAtRetirement'];
		$this->totalPension = $aggregations['projectedPensionAtRetirement'];
		$this->riskLevel = $aggregations['riskLevel'];
		//$this->riskLevelFit = $aggregations['riskLevelFit'];
		$this->riskLevelFit = 0;
		$this->annualFees = $aggregations['projectedAnnualFees'];
	}
	
	function setProductAggregations(){
		$this->pensia->setPercent($this->projectedTotalBalance);
		$this->hishtalmut->setPercent($this->projectedTotalBalance);
		$this->gemel->setPercent($this->projectedTotalBalance);
		$this->minhalim->setPercent($this->projectedTotalBalance);
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

	function riskMatches(){
		return $this->riskLevelFit == 'GOOD';
	}
	
}

?>
