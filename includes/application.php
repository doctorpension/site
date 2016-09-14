<?php
DEFINE("CLASSES_DIR", __DIR__ . "/../classes/");
DEFINE("VENDOR_DIR", __DIR__ . "/../vendor/");
define("LIBS_DIR", __DIR__ . '/../libs/');
define('TEMPLATES_DIR',__DIR__ .  '/../templates/'); 
define('DOCS_DIR', __DIR__ . '/../generated_files');
require_once(CLASSES_DIR . 'wakeup.php');

if(isset($_SESSION['user'])){
	require_once(CLASSES_DIR . 'report.php');
	require_once(CLASSES_DIR . 'fund.php');
	require_once(CLASSES_DIR . 'portfolio.php');
	require_once(CLASSES_DIR . 'report.php');
	require_once(CLASSES_DIR . 'product.php');
	require_once(CLASSES_DIR . 'insurance.php');
	require_once(CLASSES_DIR . 'track.php');
}


?>
