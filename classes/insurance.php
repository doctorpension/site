<?php

class Insurance{

	var $disabilityPension;
	var $disabilityBenefit;
	var $survivorPension;
	var $survivorBenefit;

	function __construct($insurance){
		$this->disabilityPension = $insurance['disabilityPension'];
		$this->disabilityBenefit = $insurance['disabilityBenefit'];
		$this->survivorPension = $insurance['survivorPension'];
		$this->survivorBenefit = $insurance['survivorBenefit'];
	}

	function getBenefit($benefit){
		switch($benefit){
			case 'disabilityPension':
				return $this->disabilityPension;
			case 'disabilityBenefit':
				return $this->disabilityBenefit;
			case 'survivorPension':
				return $this->survivorPension;
			case 'survivorBenefit':
				return $this->survivorBenefit;
		}
	}
}





?>
