<?php

class Track{
	var $name;
	var $balance;

	function __construct($info){
		$this->name = $info['trackName'];
		$this->balance = $info['balance'];
	}
}
