<?php

class Fund{
	var $name;
	var $type;
	var $risk_level;
	var $deposit_fee;
	var $accumulation_fee;
	var $total_balance;
	var $match_profile;
	var $better_fit_profile;
	var $improved_fees;
	var $formatted_data;
	var $tracks = array();
	
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
		$this->accumulation_fee = $info['accumulationFee'];
		$this->total_balance = $info['totalBalance'];
		$this->match_profile = $info['betterFitProfile'];
		$this->improved_fees = $info['improvedFees'];
		foreach($info['investmentTrackInfos'] as $track){
			$this->tracks[$track['trackCode']] = new Track($track);
		}
		$this->formatted_data =  number_format($this->total_balance) . " " . $this->deposit_fee . " " . $this->accumulation_fee . " " . $this->risk_level;
	}

	function getType(){
		return $this->fund_types[$this->type];
	}
	
	function getCodes(){
		return array_keys($this->tracks);
	}

	function getTrackBalance($code){
		return array_key_exists($code, $this->tracks) ? 
				$this->tracks[$code]->balance :
				null;
	}
}

?>
