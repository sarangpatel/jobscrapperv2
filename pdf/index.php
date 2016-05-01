<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);

//echo __FILE__;
//$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscraperv2/pdf/';
$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscrapperv2/jobscrapperv2/pdf/';

$dir = dirname(__FILE__).'/';

require_once($dir.'db.php');
require_once($dir.'model.php');
$model= new Model();

if($_REQUEST['action'] == 'download_excel'){
	$data = $model->getData();

	header('Content-Description: File Transfer');
	header('Content-Type: application/force-download');
	header('Content-Disposition: attachment; filename=receipts.csv');
	header('Pragma: no-cache');
	$csv = "Ref ID,Name,Ref Data, Total \n";
	foreach($data as $d){
		$csv .= (50000 + $d['id']). ',"' . $d['full_name'].'",'.$d['ref_date'].',' . $d['total']. "\n";
	}
	echo $csv;
	exit;
}else if($_REQUEST['action'] == 'logout'){
	session_destroy();
	header('location: index.php?action=login');
}else if($_REQUEST['action'] == 'add_receipt'){
	require_once($dir.'html/add_receipt.php');
}else if($_REQUEST['action'] == 'save_receipt'){
//echo '<PRE>'; print_r($_POST);exit;
	$result = $model->addReceipt();
	$_SESSION['msg'] = 'Record inserted';
	require_once($dir.'html/add_receipt.php');
}else if($_REQUEST['action'] == 'list_receipt'){
	$result = $model->listReceipt();
	require_once($dir.'html/list_receipt.php');
}else if($_REQUEST['action'] == 'preview_receipt'){
	$data = $model->previewReceipt($_GET['receipt_id']);
	require_once($dir.'html/preview_receipt.php');
}else if($_REQUEST['action'] == 'send_receipt'){
	$receipt_id = $_GET['receipt_id'];
	require_once($dir.'html/send_receipt.php');
}else if($_REQUEST['action'] == 'mail_receipt'){
	$receipt_id = $_POST['receipt_id'];
	$mail_from = $_POST['from'];
	$mail_to = $_POST['email'];
	$mail_subject = $_POST['subject'];
	$mail_content = nl2br($_POST['description']);
	$action_type = "mail";
	$data = $model->previewReceipt($receipt_id);
	require_once($dir . 'mpdf/mpdf.php');
	$_SESSION['msg'] = 'Mail Sent.';
	require_once($dir.'html/preview_receipt.php');
}else if($_REQUEST['action'] == 'view_pdf'){
	$receipt_id = $_GET['receipt_id'];
	$action_type = "mail";
	$view_browser = "view_browser";
	$data = $model->previewReceipt($receipt_id);
	require_once($dir . 'mpdf/mpdf.php');
	//$_SESSION['msg'] = 'Mail Sent.';
	require_once($dir.'html/preview_receipt.php');
}else if($_REQUEST['action'] == 'set_login'){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == "admin" && $password == "admin"){
		$_SESSION['is_login_user'] = 1;
		$result = $model->listReceipt();
		require_once($dir.'html/list_receipt.php');
		//require_once($dir.'html/home.php');
	}else{
		require_once($dir.'html/login.php');
	}
}else{
	if(empty($_SESSION['is_login_user'])){
		require_once($dir.'html/login.php');
	}else{
		$result = $model->listReceipt();
		//header('location: index.php?action=list_receipt');
		require_once($dir.'html/list_receipt.php');
	}
}


function escapeString(&$item1, $key)
{
	$item1 = mysql_real_escape_string($item1);
}

?>