<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);

//echo __FILE__;
$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/pdf/';
$dir = dirname(__FILE__).'/';


require_once($dir.'db.php');
require_once($dir.'model.php');
$model= new Model();
if($_REQUEST['action'] == 'add_receipt'){
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
}else if($_REQUEST['action'] == 'set_login'){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == "admin" && $password == "admin"){
		$_SESSION['is_login_user'] = 1;
		require_once($dir.'html/home.php');
	}else{
		require_once($dir.'html/login.php');
	}
}else{
	if(empty($_SESSION['is_login_user'])){
		require_once($dir.'html/login.php');
	}else{
		$result = $model->listReceipt();
		require_once($dir.'html/home.php');
	}
}


function escapeString(&$item1, $key)
{
	$item1 = mysql_real_escape_string($item1);
}

?>