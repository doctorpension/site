<?php 


class SignNow {
	public $clientId;
	public $clientSecret;
	public $grantType;
	public $scope;
	public $encodedCredentials;
	public $clientToken;
	public $userName;
	public $password;
	public function __construct() {
		$this->userName    = SIGNNOW_USER_NAME; 
		$this->password    = SIGNNOW_PASSWORD;
		$this->grantType    = "password";
		$this->scope    = "*";
		$this->clientId   =SIGNNOW_CLIENT_ID; 
		$this->clientSecret    = SIGNNOW_CLIENT_SECRET; 
		$this->encodedCredentials =SIGNNOW_ENCODED_CREDENTIALS; 
		// On class invocation grab a new client token.
		$this->clientToken = $this->getOAuthToken();
	}
	// Auth
	public function getOAuthToken () {
		$url        = 'https://api-eval.cudasign.com/oauth2/token';
		$header     = array("Accept: application/json", "Authorization: Basic ".$this->encodedCredentials);
		$parameters = array('username'=> $this->userName,'password' => $this->password, 'grant_type'=> $this->grantType,'scope'=> $this->scope);

		return json_decode(self::makeCurlRequest ($url, $header, $parameters));
	}
	// Uploading a document.
	public function uploadDocument ($file) {
		$url        = "https://api-eval.cudasign.com/document/fieldextract/";
		$header     = array(
			"Accept: application/json", 
			"Authorization: Bearer ".$this->clientToken->access_token, 
			'file=@FILE_NAME'
		);
		$parameters['file'] = new CurlFile($file); 
		$response   = json_decode(self::makeCurlRequest ($url, $header, $parameters));
		return $response;
	}
	// To make a curl request to the sign now api.
	public static function makeCurlRequest ($url, $header="", $parameters="", $post=true) {
		$handle = curl_init(); 
		curl_setopt($handle, CURLOPT_URL, $url); 
		if(isset($header) && !empty($header)) { 
			curl_setopt($handle, CURLOPT_HTTPHEADER, $header); 
		}
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); 
		if($post) { 
			curl_setopt($handle, CURLOPT_POST, true); 
		}
		if(isset($parameters) && !empty($parameters)) { 
			curl_setopt($handle, CURLOPT_POSTFIELDS, $parameters); 
		}
		$response = curl_exec($handle); 
		return $response;
	}
}

?>
