<?php
header('Content-Type: application/json');
include('../includes/application.php');
require('../includes/db_connect.php');
require_once VENDOR_DIR . '/autoload.php';
require_once VENDOR_DIR . '/phpmailer/phpmailer/PHPMailerAutoload.php';
require_once CLASSES_DIR . '/gmailer.php';

switch($_POST['action']){
	case 'add_to_list':
		sendEmailForWaitingList($_POST['email']);
		break;
}

function sendEmailForWaitingList($email){
	global $mysqli;
	$res = $mysqli->query("INSERT INTO waiting_list (email) values ('" . 
	   		$mysqli->real_escape_string ($email) . "')");
	if (!$res && $mysqli->errno != 1062){
		$mail = new Gmailer();
		$mail->addAddress(DEFAULT_EMAIL_FROM_EMAIL,'');
		$mail->setSubject('Add email to waiting list, sql failed');
		$mail->setHTML('Add this email to list: '. $email . PHP_EOL . 'The sql error: '. $mysqli->error);
		if (!$mail->send()) {
				echo "Mailer Error: " . $mail->getError();
		}
	}
	echo json_encode(array('status' => 'success'));
}


?>
