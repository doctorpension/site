<?php

/*****************************
*
*	Class for interacting with 
*	WakeUp Core
*
*****************************/

class WakeUp{

	static $api_url = 'http://52.29.159.238:8080/wakeup-management-rest/management/';

	function __construct(){	}

	static function getReport($account_id){
		return Wakeup::Send('accounts/' . $account_id . '/report', 'POST');
	}

	static function send($endpoint, $method, $params = array()){
		  $postData = json_encode($params);
                  $headers =array( 
                            'Content-Type: application/json', 
                            'Content-Length: ' . strlen($postData)
                        );
                  if(isset($_SESSION['version'])){
                    $headers[] = 'If-Match: ' . $_SESSION['version'];
                  }
                $ch = curl_init();  
                $url = Wakeup::$api_url . $endpoint;
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch,CURLOPT_HEADER, false); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers ); 

                if($method == 'POST' || $method == 'PUT'){
                    curl_setopt($ch,CURLOPT_URL,$url);
                    curl_setopt($ch, CURLOPT_POST, count($postData));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); 
                    if($method == 'PUT'){
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                    }
                }
                elseif($method == 'GET'){
                        curl_setopt($ch,CURLOPT_URL,$url . '?' . $postData);
                }
                $output=curl_exec($ch);
                if(curl_error($ch)){
                    echo 'error:' . curl_error($ch) ;
                }
                $info=curl_getinfo($ch);
                $http_code =  $info['http_code'];
                if($http_code != 200){
                    $output = array('reason' => $output, 'request' => $postData, 'url' => Wakeup::$api_url . $endpoint , 'method' => $method);
                }
                else{
                    $output = json_decode($output, 1);
                }
                $output['http_code'] = $http_code;
//			echo 'the info: ' . var_export($info, 1);
// 			echo 'the curl: ' . var_export($ch, 1). ' and the output: ' . var_export($output, 1);
                curl_close($ch);
                return $output;
	}

	static function getHebEntities($text){
		global $heb_entities;
		$return_string = '';
		$chrArray = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
		foreach($chrArray as $char ) {
			if(array_key_exists($char, $heb_entities)){
				$return_string .=$heb_entities[$char];
			}
			else{
				$return_string .= $char;
			}
		}
		return $return_string;
	}	
}




$heb_entities = array(
"א" => "&#1488;",
"ב" => "&#1489;",
"ג" => "&#1490;",
"ד" => "&#1491;",
"ה" => "&#1492;",
"ו" => "&#1493;",
"ז" => "&#1494;",
"ח" => "&#1495;",
"ט" => "&#1496;",
"י" => "&#1497;",
"כ" => "&#1499;",
"ך" => "&#1498;",
"ל" => "&#1500;",
"מ" => "&#1502;",
"ם" => "&#1501;",
"נ" => "&#1504;",
"ן" => "&#1503;",
"ס" => "&#1505;",
"ע" => "&#1506;",
"פ" => "&#1508;",
"ף" => "&#1507;",
"צ" => "&#1510;",
"ץ" => "&#1509;",
"ק" => "&#1511;",
"ר" => "&#1512;",
"ש" => "&#1513;",
"ת" => "&#1514;",
);

?>

