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
	var $boxRows = array();
	
	var $product_types = array('pensia', 'hishtalmut', 'gemel', 'minhalim');

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
		$this->currentPortfolio->worstCase = 30;
		$this->recommendedPortfolio = new Portfolio($this->raw_data['recommendedPolicies'], $this->raw_data['recommendedPortfolioAggregated'], $this->raw_data['insurance']['recommendedCoverages']);
		$this->recommendedPortfolio->worstCase = 15;
		$this->setBoxRows();
		$this->insurance = $this->raw_data['insurance'];
		$this->total_increase = ($this->recommendedPortfolio->projectedTotalBalance - $this->currentPortfolio->projectedTotalBalance);
		$this->isTakzivit = $this->currentPortfolio->isTakzivit;
	}
	
	function setBoxRows(){
		foreach($this->product_types as $product){
			$this->boxRows[$product] =  max(
				sizeof($this->currentPortfolio->getProduct($product)->getFunds()), 
				sizeof($this->recommendedPortfolio->getProduct($product)->getFunds())
			);
		}
	}
	
	function getIncrease(){
		return $this->total_increase;
	}
	
	function getPortfolio($portfolio){
		return $portfolio == 'current' ? $this->currentPortfolio : $this->recommendedPortfolio;
	}
	
	function getBoxRows($product){
		return $this->boxRows[$product];	
	}

	function getBoxFunds($portfolio, $product){
		$funds = $this->getPortfolio($portfolio)->getProduct($product)->getFunds(); 
		$current_len = sizeof($funds);
		$target_len = $this->getBoxRows($product);
		while($current_len < $target_len){
			$funds[] = '';
			$current_len++;
		}
		return $funds;
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
	
	function getRiskFitText($portfolio){
		return $this->getPortfolio($portfolio)->riskFitText();
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

	function getWorstCase($portfolio){
		return $this->getPortfolio($portfolio)->worstCase;
	}


	function displayBoxFunds($portfolio, $product){
	?><ul>
			<?php 
		foreach($this->getBoxFunds($portfolio, $product) as $row){
			if(is_string($row)){
				echo '<li class="no-border">&nbsp;</li>';
			}
			else{
				echo '<li data-details="' . $row->formatted_data . '" data-name="' . $row->name . '" data-risk="'.$row->risk_level.'"><span>'.$row->name.'</span><em>₪'.number_format($row->total_balance).'</em></li>';
			}
		}
		?>	
			</ul> <?php
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
