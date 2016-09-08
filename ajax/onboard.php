<?php
header('Content-Type: application/json');
include('../includes/application.php');
require_once VENDOR_DIR . '/autoload.php'; 
require_once VENDOR_DIR . '/phpoffice/phpword/src/PhpWord/Autoloader.php'; 
require_once VENDOR_DIR . '/phpmailer/phpmailer/PHPMailerAutoload.php';
require_once CLASSES_DIR . '/credit_guard.php';
require_once CLASSES_DIR . '/gmailer.php';
require_once CLASSES_DIR . '/wakeup.php';
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;


switch($_POST['action']){
	case 'get_user_info':
		getRegInfo($_POST['field'], $_POST['value']);
		break;
	case 'save_email':
		createUser();
		break;
	case 'update_user':
		updateUser();
		break;
	case 'send_code':
		send_sms($_POST['phone'], $_POST['teudat_zehut']);
		break;
	case 'verify_code':
		verify_code($_POST['phone'], $_POST['code'], $_POST['teudat_zehut']);
		break;
        case 'get_payment_url':
                getPaymentUrl();
                break;
	case 'onboard':
		onboardUser();
		break;
        case 'set_agreement_session_values':
                setAgreementSession($_POST);
                break;
	case 'showAgreement':
		getAgreement();
		break;
	case 'sendAgreement':
		generateAgreementPDF($_POST['firstname'], $_POST['lastname'], $_POST['tz'], $_POST['street'], $_POST['street_number'], $_POST['city'], $_POST['email'], $_POST['cell'], $_POST['phone'], $_POST['dob']); 
		break;
	case 'getCost':
		getCost($_POST['token_value']);
		break;
}

function getRegInfo($field, $value){
    if($field == 'reg_id'){
        die(json_encode(Wakeup::getByRegId($value)));
    }
    echo  json_encode(Wakeup::getByEmail($value));
}

function createUser(){
	$res = Wakeup::createUser($_POST['email'], $_POST['firstName'], $_POST['lastName'], 1);
	$user_id = 0;
	if($res['http_code'] == 200){
            $user_id = $res['id'];
            setcookie('started_questions', $user_id, time() + 60*60*24*30, '/');
	}
        $_SESSION['version'] = isset($res['version']) ? $res['version'] : '';
	//if it's not, then what?/
	echo json_encode($res);
}

function updateUser(){
	foreach($_POST as $key => $val){
		$_SESSION[$key] = $val;
	}
        $res = Wakeup::updateUser($_POST);
        if($res['http_code'] == 200){
            $_SESSION['version'] = $res['version'];
        }
        echo json_encode($res);
}


function send_sms($phone, $tz){
	$res = Wakeup::SendSMS($phone, $tz);
	echo json_encode($res);
}

function verify_code($phone, $code, $tz){
	$res = Wakeup::VerifyCode($phone, $code, $tz);
	echo json_encode($res);
}

function onboardUser(){
        unset($_POST['action']);
        $res = Wakeup::onboardUser($_POST);
        if($res['http_code'] == 200){
            $gender = $res['male'] == true ? 'male' : 'female';
		setcookie('registered', $_POST['email'], time() + 60*60*24*30, '/');
		setcookie('registered_date', time(), time() + 60*60*50*24*30, '/');
		setcookie('first_name', $_POST['firstName'], time() + 60*60*24*30, '/');
		setcookie('gender', $gender, time() + 60*50&24*30, '/');
                getPaymentUrl();
                die();
	}
	echo json_encode($res);
}



function generateAgreementPDF($fname, $lname, $tz, $street, $street_num,  $city, $email, $phone, $cell, $dob){
	$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(TEMPLATES_DIR . '/agreement_template.docx');
	$templateProcessor->setValue('firstname',Wakeup::getHebEntities($fname));
	$templateProcessor->setValue('lastname', Wakeup::getHebEntities($lname));
	$templateProcessor->setValue('tz', Wakeup::getHebEntities($tz));
	$templateProcessor->setValue('street', Wakeup::getHebEntities($street));
	$templateProcessor->setValue('street_number', Wakeup::getHebEntities($street_num));
	$templateProcessor->setValue('city', Wakeup::getHebEntities($city));
	$templateProcessor->setValue('email', Wakeup::getHebEntities($email));
	$templateProcessor->setValue('phone', Wakeup::getHebEntities($phone));
	$templateProcessor->setValue('cell', Wakeup::getHebEntities($cell));
	$templateProcessor->setValue('dob', Wakeup::getHebEntities($dob));
	$filename = DOCS_DIR . "/{$tz}_" . time() . '.docx';
	$templateProcessor->saveAs($filename);
	$cmd = ' /bin/unoconv -vvvv -f pdf ' . $filename ;// ' 2>&1';
	$res = exec($cmd, $results, $ret_val);
	if($ret_val == 0){
		unlink($filename);
		sendAgreement(str_replace('.docx', '.pdf', $filename), $email, $fname);
		//sendAgreement($filename, $email, $fname);
		echo json_encode(array('res' => 'success'));
	}
	else{
		echo json_encode(array('res' => 'fail', 'info' => var_export($ret_val, 1), 'result' => $res, 'full_report' => var_export($results, 1)));
 	}
}

function my_htmlspecialchars_encode($text) {
       return strtr($text, get_html_translation_table(HTML_ENTITIES, ENT_XHTML, 'UTF-8'));
}


function setAgreementSession($args){
    $agreement_params = array('firstname', 'lastname', 'tz', 'street', 'street_number', 'city', 'email', 'phone', 'cell', 'dob');
    $_SESSION['agreement_params'] = array();
    foreach($args as $key => $val){
        if(in_array($key, $agreement_params)){
            $_SESSION['agreement_params'][$key] = $val;
        }
    }
    echo json_encode(array('status' => 'success'));
}

function getAgreement(){
        if(!isset($_SESSION['agreement_params'])){
            return '';
        }
        $args = $_SESSION['agreement_params'];
	$html = file_get_contents(TEMPLATES_DIR . '/agreement_template.html');
	$address = $args['street'] . ' ' . $args['street_number'] ;
	$address .= " " . $args['city'];
	$search = array('%%firstname%%', '%%lastname%%', '%%tz%%', '%%address%%', '%%email%%', '%%phone%%', '%%cell%%', '%%dob%%');
	$replace = array(Wakeup::getHebEntities($args['firstname']), Wakeup::getHebEntities($args['lastname']), Wakeup::getHebEntities($args['tz']), Wakeup::getHebEntities($address), Wakeup::getHebEntities($args['email']), $args['phone'], $args['cell'], $args['dob']);
	$string = str_replace($search, $replace, $html);
 header('Content-Type: application/json; charset=UTF-8');
        unset($_SESSION['agreement_params']);
	$json = json_encode(array('html' => utf8_encode($string)));	 
	echo $json;
} 


function sendAgreement($file_name, $email, $first_name){
	$mail = new Gmailer();
	$mail->addAddress($email,'');
	$mail->setSubject(L::Agreement_Email_Subject);
	$html = file_get_contents('../assets/templates/agreement_email.html');
	$html = str_replace('{{ firstname }}', $first_name, $html);
	$mail->setHTML($html);
	$mail->addAttachment($file_name);
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->getError();
	} 
}

function getCost($token_value){
	$amount =  Wakeup::getOnboardCost($token_value);
	echo json_encode(array('amount' => $amount));
}

function getPaymentUrl($token_value = ''){
    $amount = Wakeup::getOnBoardCost($token_value);
    $data = array('total' => $amount,
        'tz' =>'327184271',// $_SESSION['idNumber'],
        'email' => $_SESSION['email'],
        'user_id' => $_SESSION['id'],
        'description' => 'Payment for WakeUp',
        'from' => 'onboard'
    );
    $cg = new CreditGuard();
    $cg->setInfo($data);
    $response = $cg->getPageUrl('verify');
    if($response['status'] == 'success'){
        $_SESSION['unique_id_cg'] = $response['unique_id'];
    }

    echo json_encode($response);

}

?>
