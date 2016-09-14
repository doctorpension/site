<?php

require_once VENDOR_DIR . '/autoload.php';
require_once VENDOR_DIR . '/phpmailer/phpmailer/PHPMailerAutoload.php';
class Gmailer{
	
	private $mailer;
	
	function __construct(){
		$this->mailer = new PHPMailerOAuth;
		date_default_timezone_set('Europe/London');
		$this->mailer->isSMTP();
		$this->mailer->SMTPDebug = 0;
		$this->mailer->setFrom('admin@doctorpension.com', 'WakeUp Pension');
		//$this->mailer->Debugoutput = 'html';
		//set hebrew
		$this->mailer->CharSet = 'UTF-8';
		$this->mailer->Host = 'smtp.gmail.com';
		$this->mailer->Port = 587;
		$this->mailer->SMTPSecure = 'tls';
		$this->mailer->SMTPAuth = true;
		$this->mailer->AuthType = 'XOAUTH2';
		$this->mailer->oauthUserEmail = "admin@doctorpension.com";
		$this->mailer->oauthClientId = OAUTH_CLIENT_ID;
		$this->mailer->oauthClientSecret = OAUTH_CLIENT_SECRET;
		$this->mailer->oauthRefreshToken = OAUTH_REFRESH_TOKEN;
	}
	
	function setFrom($email, $name){
		$this->mailer->setFrom($email, $name);
	}

	function addAddress($email, $name){
		$this->mailer->addAddress($email, utf8_encode($name));
	}
	
	function setSubject($subject){
		$this->mailer->Subject = $subject;
	}

	function setHTML($html){
		$this->mailer->msgHTML($html);
	}

	function addAttachment($file_name){
		$this->mailer->addAttachment($file_name);
	}
	
	function send(){
		return $this->mailer->send();
	}

	function getError(){
		return $this->mailer->ErrorInfo;
	}
	

}

?>
