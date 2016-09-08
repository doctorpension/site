<?php
require_once('../includes/application.php');
require_once(CLASSES_DIR . 'signnow.php');
header('Content-Type: application/json');
require_once(CLASSES_DIR . 'signnow.php');
$file = isset($_REQUEST['testFile']) ? $_REQUEST['testFile'] : 'data.json';
define('TEMPLATES_FILE', 'move_pension.docx'); 

$unoconvPath = 'sudo /usr/bin/unoconv ';

// construct url form path and file
$url = TEMPLATES_DIR .$file;

$rawData = file_get_contents($url);
$data = json_decode($rawData);
// overwrite form data into json data
$data->SHEM_P4RATI = (isset($_REQUEST['fname']))? $_REQUEST['fname'] : $data->SHEM_P4RATI;
$data->SHEM_MISHPACHA = (isset($_REQUEST['lname']))? $_REQUEST['lname'] :  $data->SHEM_MISHPACHA;
$data->EMAIL = (isset($_REQUEST['email']))? $_REQUEST['email'] :  $data->EMAIL;
// 2. read docx
// include phpword
require_once LIBS_DIR . 'PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(TEMPLATES_DIR . '/'.TEMPLATES_FILE);

// 3. replace dynamic text
foreach($data as $k => $v){
	$templateProcessor->setValue($k,Wakeup::getHebEntities($v));
}


// 4. save as docs
$filename = str_replace('-', '', $data->MISPAR_TEL).'__' . time() . '.docx';
$filename = str_replace(' ','_',$filename);
$templateProcessor->saveAs(DOCS_DIR . '/'.$filename);	


// 5. convert to pdf
$cmd = $unoconvPath. ' -vvvv -f pdf '.DOCS_DIR.'/'.$filename;
$res = exec($cmd, $results, $ret_val);
if($ret_val == 0){
	//send the api request here
	// 6. signnow
	$return = tsSignNowProcess(DOCS_DIR.'/'.str_replace('.docx','.pdf',$filename));
}else{
$return = array('status'=>  'failure', 
	'error' => 'could not create pdf');
}

echo json_encode($return);

function tsSignNowProcess($pdf){
	$return = array('status'=>'');
	$tsSign = new SignNow();
	if(isset($tsSign->clientToken->error)){
		$return['status'] = 'failure';
		$return['error'] = 'could not get client token';
	}else{
		$uploadDocRespone = $tsSign->uploadDocument($pdf);
		if(isset($uploadDocRespone->errors)){
			$return['status'] = 'failure';
			$return['error'] = 'could not upload pdf';
		}else{
			$return['status'] = 'success';
			$tsSign->docId = $uploadDocRespone->id;
			$return['docId'] = $tsSign->docId;
		}
	}
	return $return;
}
?>
