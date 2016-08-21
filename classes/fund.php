<?php

class Fund{
	var $name;
	var $type;
	var $risk_level;
	var $deposit_fee;
	var $total_balance;
	var $match_profile;
	var $better_fit_profile;
	var $improved_fees;
	
	var $fund_types = array('KEREN_PENSIA_HADASHA_MEKIFA' => 'pensia' ,
                    'KEREN_PENSIA_HADASHA_CLALIT' =>  'pensia' ,
                     'KEREN_HISHTALMUT' => 'hishtalmut' ,
					'KUPAT_GEMEL'=>   'gemel',
					'BITUAH_MENAALIM' => 'minhalim',
					'KEREN_PENSIA_VATIKA' => 'takzivit');
 	
	
	function __construct($info){
		$this->name = $info['fundName'];
		$this->type = $info['fundType'];
		//$this->risk_level = $info['risk_level'];
		$this->risk_level = 3;
		$this->deposit_fee = $info['depositFee'];
		$this->total_balance = $info['totalBalance'];
		$this->match_profile = $info['betterFitProfile'];
		$this->improved_fees = $info['improvedFees'];
	}

	function getType(){
		return $this->fund_types[$this->type];
	}
	
}

?>
