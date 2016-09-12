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
	var $worstCase;
	
	var $riskFitTexts = array('GOOD' => 'טובה', 'HIGH' => 'גבוהה', 'LOW' => 'נמוכה');

	function __construct($policies, $aggregations, $insurance, $totalBalance){
		$this->pensia = new Product();
		$this->hishtalmut = new Product();
		$this->gemel = new Product();
		$this->minhalim = new Product();
		$this->insurance = new Insurance($insurance);
		$this->setAggregations($aggregations);
		$this->setProducts($policies);
		$this->totalBalance = $totalBalance;
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
		$this->riskLevelFit = $aggregations['riskLevelFit'];
		$this->annualFees = $aggregations['projectedAnnualFees'];
		//$this->worstCase = $aggregations['worstCase'];
		$this->worstCase = 20;
	}
	
	function setProductAggregations(){
		$this->pensia->setPercent($this->totalBalance);
		$this->hishtalmut->setPercent($this->totalBalance);
		$this->gemel->setPercent($this->totalBalance);
		$this->minhalim->setPercent($this->totalBalance);
	}
	
	function getProductPoints(){
		return $this->minhalim->getPercent() . ',' .
			 $this->hishtalmut->getPercent() . ',' .
			 $this->gemel->getPercent() . ',' .
			 $this->pensia->getPercent();
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

	function riskFitText(){
		return $this->riskFitTexts[$this->riskLevelFit];
	}
}

	
?>
