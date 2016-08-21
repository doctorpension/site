<?php

require_once('classes/wakeup.php');

if(isset($_SESSION['user'])){
	require_once('classes/report.php');
	require_once('classes/fund.php');
	require_once('classes/portfolio.php');
	require_once('classes/report.php');
	require_once('classes/product.php');
	require_once('classes/insurance.php');
}


?>
