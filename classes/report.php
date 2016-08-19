<?php

/*****************************
*
*   Class for interacting with
*   Reports
*
*****************************/

class Report{
	var $firstName;
	var $currentPortfolio;
	var $recommendedPortfolio;
	var $insurance;
	var $total_increase;
	var $isTakzivit;
	
	
	function loadData($json){
		$all_data = json_decode($json, true);
		$this->firstName = $all_data['firstName'];
		$this->currentPortfolio = new Portfolio($all_data['currentPolicies'], $all_data['currentPortfolioAggregated']);
		$this->recommendedPortfolio = new Portfolio($all_data['recommendedPolicies'], $all_data['recommendedPortfolioAggregated']);
		$this->insurance = $all_data['insurance'];
		$this->total_increase = ($this->recommendedPortfolio->$totalProjectedLump - $this->currentPortfolio->totalProjectedLump);
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
	
	function getTotal($portfolio){
		return $this->getPortfolio($portfolio)->totalBalance;
	}
	
	function getRisk($portfolio){
		return $this->getPortfolio($portfolio)->riskLevel;
	}
	
	function getYearlyFee($portfolio){
		return $this->getPortfolio($portfolio)->annualFees;
	}
	
	function riskMatches($portfolio){
		return $this->getPortfolio($portfolio)->riskMatches;
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