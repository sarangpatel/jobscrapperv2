<?php
session_start();
error_reporting(0);
$site_url = 'https://'.$_SERVER['HTTP_HOST'].'/jobscraperv2/grouplocator/';

$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscrapperv2/';
$dir = dirname(__FILE__).'/';
require($dir.'db.php');
require($dir.'model.php');
$model= new Model();
$site_url = $_GET['site_url'];
//echo $site_url;
if($_POST['action'] == 'site_data'){
}else{
	$site_jobs = $model->displaySiteJobs($site_url);
	require_once('html/home.php');
}


function pr($a){
	echo '<PRE>';
	print_r($a);
	echo '</PRE>';
}


?>