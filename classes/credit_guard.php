<?php
	

class CreditGuard{

	private $tid = CG_TID;
        private $mid = CG_MID;
	private $user = CG_USER;
	private $password = CG_PASS;
	private $cg_gateway_url = "https://cguat2.creditguard.co.il/xpo/Relay";
	private $command;
	private $total;
	private $cc_num;
	private $cvv;
	private $cc_exp;
        private $return_url_info;
        private $from;
	private $currency = 'ILS';
	private $tz;
        private $user_email;
	private $user_id;
        private $full_user_id;
        private $tx_id;
	private $xml;
        private $verification;
	private $uid;


	function setInfo(array $data){
		$this->total = $data['total'];
		$this->tz = $data['tz'];
                $this->user_email = $data['email'];
                $this->description = $data['description'];
                $this->full_user_id = $data['user_id'];
                $this->user_id = substr($this->full_user_id, 0, 18);
                $this->from = $data['from'];
                $this->generateUid();
                $this->generateUrlInfo();
	}

        function generateUid(){
            $str = base64_encode($this->user_id . ';;' . time());
            if(strlen($str) > 60){
                $str = substr($str, 0, 60);
            }
            $this->uid = $str;
        }
    
        function generateUrlInfo(){
            $this->return_url_info = '/cg/' . $this->from . '/' . $this->full_user_id . '/';
        }

	/*Build Ashrait XML to post*/
	function setTransactionXML(){
            $this->xml = '<?xml version=\'1.0\' encoding=\'ISO-8859-8\'?>
                <ashrait>
                    <request>
                        <language>heb</language>
                        <command>' . $this->command . '</command>
                        <requestId/>
                        <version>1001</version>
                        <doDeal>
                            <terminalNumber>'.$this->tid.'</terminalNumber>
                            <mid>' . $this->mid . '</mid>
                            <successUrl>https://' .  DOMAIN . $this->return_url_info . '/success</successUrl>
                            <errorUrl>https://' .  DOMAIN . $this->return_url_info . '/error</errorUrl>
                            <cancelUrl>https://' .  DOMAIN . $this->return_url_info . '/cancel</cancelUrl>
                            <transactionCode>Phone</transactionCode>
                            <transactionType>Debit</transactionType>
                            <total>'.$this->total.'</total>
                            <creditType>RegularCredit</creditType>
                            <cardNo>CGMPI</cardNo>
                            <uniqueid>' . $this->uid . '</uniqueid>
                            <validation>TxnSetup</validation>
                            <mpiValidation>' . $this->verification . '</mpiValidation>
                            <numberOfPayments/>
                            <customerData>
                                <userData1 for="teudat_zehut">' . $this->tz . '</userData1>
                                <userData2/>
                                <userData3/>
                                <userData4/>
                                <userData5/>
                            </customerData>
                            <currency>' . $this->currency . '</currency>
                            <firstPayment/>
                            <email>' . $this->user_email .'</email>
                            <periodicalPayment/>
                            <description>' . $this->description . '</description>
                        </doDeal>
                    </request>
                </ashrait>';
	}

        function setQueryXML(){
            $this->xml = '<ashrait>
                <request>
                    <version>1000</version>
                    <language>ENG</language>
                    <dateTime/>
                    <command>inquireTransactions</command>
                    <inquireTransactions>
                        <terminalNumber>' . $this->tid . '</terminalNumber>
                        <mainTerminalNumber/>
                        <queryName>mpiTransaction</queryName>
                        <mid>' . $this->mid . '</mid>
                        <mpiTransactionId>' . $this->tx_id . '</mpiTransactionId>
                        <userData1></userData1>
                        <userData2></userData2>
                        <userData3></userData3>
                        <userData4></userData4>
                        <userData5></userData5>
                    </inquireTransactions>
                </request>
            </ashrait>';
        }

	function send(){
	//init curl connection
		$poststring = 'user='.$this->user;
		$poststring .= '&password='.$this->password;
		$poststring .= '&int_in=' . $this->xml;
	   $CR = curl_init();
	   curl_setopt($CR, CURLOPT_URL, $this->cg_gateway_url);
	   curl_setopt($CR, CURLOPT_POST, 1);
//	   curl_setopt($CR, CURLOPT_FAILONERROR, true);
	   curl_setopt($CR, CURLOPT_POSTFIELDS, $poststring);
	   curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);
	/*	curl_setopt($CR, CURLOPT_VERBOSE, true);
		$verbose = fopen('php://temp', 'w+');
		curl_setopt($CR, CURLOPT_STDERR, $verbose);
	*/


//           echo 'the request: ' . var_export($poststring,1);
	   //actual curl execution perfom
	   $result = curl_exec( $CR );
	   $error = curl_error ( $CR );
/*	    printf("cUrl error (#%d): %s<br>\n", curl_errno($CR),
           htmlspecialchars(curl_error($CR)));*/
	   // on error - die with error message
	/*	rewind($verbose);
		$verboseLog = stream_get_contents($verbose);
	*/
//echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";
//echo 'the error: ' . var_export($error, 1);
	   if( !empty( $error )) {
		  return '<error type="curl">' . $error . '</error>';
		}
			
	   curl_close( $CR );
		return $result;
	}

    function parseResponse($result, $action = 'getPaymentUrl'){
        if(strpos(strtoupper($result),'HEB')){ $result = iconv("utf-8", "iso-8859-8", $result); }
        $xmlObj = simplexml_load_string($result);
        if(isset($xmlObj->response->result)){
            $resp_code = $xmlObj->response->doDeal->status;
            if($resp_code == 0){
                $unique_id  = json_decode(json_encode($xmlObj->response->doDeal->uniqueid), 1);
                $resp = array('status' => 'success',
                    'unique_id' => $unique_id[0]
                );
                if($action == 'getPaymentUrl'){
                    $redirect_url = json_decode(json_encode($xmlObj->response->doDeal->mpiHostedPageUrl), 1); 
                    $resp['redirect_url'] = $redirect_url[0];
                }
                elseif($action == 'query'){
                    $resp['row'] = $xmlOb->response->inquireTransactions->row;
               }
                return $resp;
            }
            else{
                return array('status' => 'failure',
                    'reason' =>(string) $xmlObj->response->doDeal->statusText,
              //     'xml' => $this->xml 
                );
            }
        }
        else{
                echo 'the response: ' . $result;
                mail('hgolov@gmail.com', 'Gateway Error', 
                        '<code> '.$xmlObj->response->result.'</code>'.
                        '<message>'.$xmlObj->response->message.'</message>'.
                            '<additional_info>'.$xmlObj->response->additionalInfo . '</additional_info>');
            return array('status'=>'failure');
            }
	}

	function getPageUrl($action = 'charge'){
            $this->command = 'doDeal';
            if($action == 'charge'){
                $this->verification = 'AutoComm';
            }
            else if($action == 'verify'){
                $this->verification = 'Verify';
            }
            $this->setTransactionXML();
            $res = $this->send();
            return $this->parseResponse($res);
	}

        function getTransaction($tx_id){
            $this->tx_id = $tx_id;
            $this->command = 'query';
            $this->setQueryXML();
            $res = $this->send();
            return $this->parseResponse($res);           
        }
}
?>	
