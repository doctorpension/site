<?php

/*****************************
*
*   Class for interacting with
*   Reports
*
*****************************/

class Report{
	var $raw_data;
	var $firstName;
	var $currentPortfolio;
	var $recommendedPortfolio;
	var $insurance;
	var $total_increase;
	var $isTakzivit;
	
	function __construct($account_id){
		$this->loadData($account_id);
	}

	function loadData($account_id){
		$this->raw_data = Wakeup::getReport($account_id);
	//	echo 'the raw data:' . var_export($this->raw_data, 1);
		$this->firstName = $this->raw_data['firstName'];
		$this->currentPortfolio = new Portfolio($this->raw_data['currentPolicies'], $this->raw_data['currentPortfolioAggregated'], $this->raw_data['insurance']['currentCoverages']);
		$this->currentPortfolio->insuranceMatches = $this->raw_data['insurance']['fit'];
		$this->currentPortfolio->totalBalance = $this->raw_data['totalBalance'];
		$this->recommendedPortfolio = new Portfolio($this->raw_data['recommendedPolicies'], $this->raw_data['recommendedPortfolioAggregated'], $this->raw_data['insurance']['recommendedCoverages']);
		$this->insurance = $this->raw_data['insurance'];
		$this->total_increase = ($this->recommendedPortfolio->totalProjectedLump - $this->currentPortfolio->totalProjectedLump);
		$this->isTakzivit = $this->currentPortfolio->isTakzivit;
	}
	
	
	function getIncrease(){
		return $this->total_increase;
	}
	
	function getPortfolio($portfolio){
		return $portfolio == 'current' ? $this->currentPortfolio : $this->recommendedPortfolio;
	}
	
	function getBoxFunds($portfolio, $product){
		return $this->getPortfolio($portfolio)->getProduct($product)->getFunds();
	}
	
	function getSettlement($portfolio){
		return $this->getPortfolio($portfolio)->totalProjectedLump;
	}
	
	function getPension($portfolio){
		return $this->getPortfolio($portfolio)->totalPension;
	}
	
	function getProjectedTotal($portfolio){
		return $this->getPortfolio($portfolio)->projectedTotalBalance;
	}
	
	function getCurrentTotal(){
		return $this->currentPortfolio->totalBalance;
	}

	function getRisk($portfolio){
		return $this->getPortfolio($portfolio)->riskLevel;
	}
	
	function getYearlyFee($portfolio){
		return $this->getPortfolio($portfolio)->annualFees;
	}
	
	function riskMatches($portfolio){
		return $this->getPortfolio($portfolio)->riskMatches();
	}
	
	function insuranceMatches(){
		return $this->currentPortfolio->insuranceMatches;
	}
	
	function getInsurance($portfolio, $benefit){
		return $this->getPortfolio($portfolio)->insurance->getBenefit($benefit);
	}

	function getInsuranceFormatted($portfolio, $benefit){
		return number_format($this->getInsurance($portfolio, $benefit), 0);
	}
}
/*
FROM ANIL'S ORIGINAL WORK ON REPORT
function processBell($d, $arr){
	foreach($arr as $x){
		cl('////////////////////// processing '.$x);
		$y = $x.'Bell';
		$d->$y = true;
		$a = $d->currentPolicies->$x;
		$b = $d->recommendedPolicies->$x;
		if(count($a) == count($b)){
			cl('count of companies match [count:' .count($a).' vs '.count($b).']');
			$d->$y = false;
			foreach($a as $cn){
				$cAmnt = $cn->amount;
				$cNm = $cn->name;
				cl('processing company: ' . $cNm . '(Amount:' . $cAmnt.')');
				$cNmFound=false;
				foreach($b as $rd){
					if($rd->name == $cNm){
						$cNmFound=true;

						if($rd->amount == $cAmnt){
							$d->$y = false;
						}else{
							cl($x.' -> '.$cNm.' amount MISMATCH '.$cAmnt.' vs '.$rd->amount);
							$d->$y = true;
							continue;
						}
					}
				}
				if($cNmFound===false){
					cl('company name '.$cNm.' not found in recommended data');
					$d->$y = true;
				}
			}
		}else{
			cl('count of companies DONT match [count:' .count($a).' vs '.count($b).']');
			continue;
		}
	}



	return $d;
}
*/



?>
