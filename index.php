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
if($_GET['action'] == 'site'){
	$sites = $model->getActiveSites();
	$sites_job_count = $model->getActiveSitesWithJobs();
	//pr($sites_job_count);
	require_once('html/site.php');
}else if($_GET['action'] == 'job'){
	$site_id = $_GET['site_id'];
	$sites = $model->getActiveSites();
	$s_id = empty($site_id) ? $sites[0]['id'] : $site_id;
	$site_jobs = $model->getSiteJob($s_id);
	//pr($site_jobs);exit;
	require_once('html/job.php');
}else if($_GET['action'] == 'ajax_table'){
	//pr($_GET);exit;
	$data = $model->getAjaxTableData();
	echo json_encode($data);
	exit;
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