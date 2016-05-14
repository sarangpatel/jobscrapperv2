<?php

session_start();
error_reporting(0);
ini_set('max_execution_time', 0);

$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscraperv2/bbb/admin/';
$front_end_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscraperv2/bbb/';

$dir = dirname(__FILE__).'/';

require_once($dir.'admin/db.php');
require_once($dir.'admin/model.php');

require_once('vendor/autoload.php');

$bbb = new BigBlueButton\BigBlueButton();
$model= new Model();
//$meetingConfig = 'MEET-';
$_POST = array_map('addslashes', $_POST);

if($_REQUEST['action'] == 'invite'){
	$meeting_id = addslashes($_REQUEST['meeting_id']);
	require_once($dir.'admin/html/join_attendee.php');
}else if($_REQUEST['action'] == 'join'){
	echo 'Please wait....';
	$name = $_POST['name'];
	$meeting_id = $_POST['meeting_id'];
	$meeting = $model->getMeeting($meeting_id);
	//echo '<PRE>'; print_r($meeting);
	$joinMeetingParam = new BigBlueButton\Parameters\JoinMeetingParameters($meeting_id,$name,$meeting['attendee_pass']);
	$joinURL = $bbb->getJoinMeetingURL($joinMeetingParam);
	if(strpos($joinURL,'http') !== FALSE || strpos($joinURL,'https') !== FALSE ){
		$model->addUser($meeting_id,'viewer',$name);
		echo "<script>window.location.href =  '$joinURL' ;</script>" ;
		exit;
	}else{
		$_SESSION['msg'] = 'Error in Joining';
		require_once($dir.'html/home.php');
		exit;
	}
	//echo $joinURL;
	//echo "<script>window.location.href =  '$joinURL' ;</script>" ;
	//header('Location :' . $joinURL);
}else{
	echo 'No action';
	exit;
}


?>