<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);

//echo __FILE__;
$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscraperv2/bbb/admin/';
$front_end_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscraperv2/bbb/';

$dir = dirname(__FILE__).'/';


require_once($dir.'db.php');
require_once($dir.'model.php');

require_once('../vendor/autoload.php');


$bbb = new BigBlueButton\BigBlueButton();
$model= new Model();
//$meetingConfig = 'MEET-';
$_POST = array_map('addslashes', $_POST);
if($_REQUEST['action'] == 'create_classroom'){
	$success_meeting_id = '';
	$meeting_id = $model->createMeeting($_POST['name'],$_POST['admin_name']);
	$createMeetingParam = new BigBlueButton\Parameters\CreateMeetingParameters($meeting_id,$_POST['name']);
	$createMeetingParam->setRecord('true');
	$createMeetingParam->setAutoStartRecording('true');
	//$logout_url = $front_end_url.'frontend.php?action=end_meeting&meeting_id='.;
	//$createMeetingParam->setLogoutUrl();
	$meetingCreated = $bbb->createMeeting($createMeetingParam);
	if($meetingCreated->getReturnCode() == 'SUCCESS'){
		$updateMeeting = array();
		$updateMeeting['return_response' ] = $meetingCreated->getRawXml()->asXML();
		$updateMeeting['attendee_pass' ] = $meetingCreated->getAttendeePassword();
		$updateMeeting['moderator_pass' ] = $meetingCreated->getModeratorPassword();
		$updateMeeting['created_on' ] = strtotime($meetingCreated->getCreationDate());
		$model->updateMeeting($meeting_id,$updateMeeting);
		$_SESSION['msg'] = "Classroom has been successfully created.";
		$success_meeting_id = $meetingCreated->getMeetingId();
		$admin_name = $_POST['admin_name'];
	}else{
		$_SESSION['msg'] = $meetingCreated->getMessage();
	}
	require_once($dir.'html/home.php');
	//$bbb->createMeeting();
	//$model->saveMeeting($data);
	require_once($dir.'html/home.php');
}else if($_REQUEST['action'] == 'join'){
	echo 'Please wait....';
	$meeting_id = addslashes($_REQUEST['meeting_id']);
	$name = addslashes($_REQUEST['name']);
	$type = $_REQUEST['type'];
	$meeting = $model->getMeeting($meeting_id);
	//echo '<PRE>'; print_r($meeting);
	$joinMeetingParam = new BigBlueButton\Parameters\JoinMeetingParameters($meeting_id,$name,$meeting['moderator_pass']);
	$joinURL = $bbb->getJoinMeetingURL($joinMeetingParam);
	if(strpos($joinURL,'http') !== FALSE || strpos($joinURL,'https') !== FALSE ){
		$model->addUser($meeting_id,'moderator',$name);
		echo "<script>window.location.href =  '$joinURL' ;</script>" ;
		exit;
	}else{
		$_SESSION['msg'] = 'Error in Joining';
		require_once($dir.'html/home.php');
		exit;
	}
	//header('Location :' . $joinURL);
}else if($_REQUEST['action'] == 'list_classrooms'){
	$meetingData = $model->getMeetings();
	require_once($dir.'html/list_classrooms.php');
	//$meetingsObj = $bbb->getMeetings();
	//$meetings = $meetingsObj->getMeetings();
	//echo '<PRE>';print_r($meetings);exit;
}else if($_REQUEST['action'] == 'view_recording'){
	$meeting_id = addslashes($_REQUEST['meeting_id']);
	//$meeting = $model->getMeeting($meeting_id);
	$recordingParam = new BigBlueButton\Parameters\GetRecordingsParameters($meeting_id);
	$recordingParam->setState('any');

	$recordings  = $bbb->getRecordingsWithXmlResponseArray($recordingParam);
	$playbackURL = $recordings[0]['playbackFormatUrl'][0].'';
	if($playbackURL != ''){
		echo "<script>window.location.href =  '$playbackURL' ;</script>" ;
		exit;
	}else{
		$_SESSION['msg'] = 'Recordings will available after 10 - 20 mins, once meeting is completed';
		header('location: index.php?action=list_classrooms' );
	}
	/*$meetingInfoParam = new BigBlueButton\Parameters\GetMeetingInfoParameters($meeting_id,$meeting['moderator_pass']);
	$meetingObj = $bbb->getMeetingInfo($meetingInfoParam);
	$meetingData = $meetingObj->getMeetingInfo(); */
}else if($_REQUEST['action'] == 'classroom_info'){
	$meeting_id = addslashes($_REQUEST['meeting_id']);
	$meeting = $model->getMeeting($meeting_id);
	/*$meetingInfoParam = new BigBlueButton\Parameters\GetMeetingInfoParameters($meeting_id,$meeting['moderator_pass']);
	$meetingObj = $bbb->getMeetingInfo($meetingInfoParam);
	$meetingData = $meetingObj->getMeetingInfo();
	echo '<PRE>';
	echo ($meetingData->getstartTime()).'<br />' ;
	echo ($meetingData->getDuration()) .'<br />';
	echo ($meetingData->getModeratorCount()).'<br />';
	echo ($meetingData->getMaxUsers()).'<br />';
	$attendees = $meetingObj->getAttendees();
	print_r($attendees);
	foreach($attendees as $attendee){
		echo $attendee->getFullName().','. $attendee->getRole().'<br />';
	}*/

}else{
	require_once($dir.'html/home.php');
}




?>