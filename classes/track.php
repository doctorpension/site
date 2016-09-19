<?php

class Track{
	var $name;
	var $code;
	var $balance;

	function __construct($info){
		$this->name = $info['trackName'];
		$this->balance = $info['balance'];
		$this->code = $info['trackCode'];
	}
}
