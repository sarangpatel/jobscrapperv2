<?php
require_once('../vendor/autoload.php');
ini_set('display_errors',0);
error_reporting(1);

ini_set('max_execution_time', 0);

$url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscraperv2/bbb/';
$dir = dirname(__FILE__).'/';
array_walk($_POST, 'escapeString');
array_walk($_GET, 'escapeString');
$request = $_GET['request'];
$verb = '';

//REF : http://coreymaynard.com/blog/creating-a-restful-api-with-php/
/*header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
*/
header("Content-Type: text/xml");

$args = explode('/', rtrim($request, '/'));
$endpoint = array_shift($args);
if (array_key_exists(0, $args) && ctype_alpha($args[0])) {
		$verb = array_shift($args);
}

if(!empty($verb)){
	$methodName = $endpoint.'_'.$verb;
	$response = $methodName();
	echo $response;
	exit;
}else{
	$methodName = $endpoint;
	$response = $methodName();
	echo $response;
	exit;
}
//echo '<PRE>';


//http://localhost/jobscraperv2/bbb/api/meeting/create/
//POST params : meeting_id,meeting_name,attendee_password,moderator_password,max_participants
function meeting_create(){
	$return = array();
	extract($_POST);
	$bbb = new BigBlueButton\BigBlueButton();
	$createMeetingParam = new BigBlueButton\Parameters\CreateMeetingParameters($meeting_id,$meeting_name);
	$createMeetingParam->setMaxParticipants($max_participants);
	$createMeetingParam->setAttendeePassword($attendee_password);
	$createMeetingParam->setModeratorPassword($moderator_password);
	$createMeetingParam->setRecord('true');
	$createMeetingParam->setAutoStartRecording('true');
	$meetingCreated = $bbb->createMeeting($createMeetingParam);
	//print_r($meetingCreated);exit;
	if($meetingCreated->getReturnCode() == 'SUCCESS'){
		$xml =  $meetingCreated->getRawXml()->asXML();
		//$success_meeting_id = $meetingCreated->getMeetingId();
	}else{
		$xml =  $meetingCreated->getRawXml()->asXML();
	}
	return $xml;
}//end function


//http://localhost/jobscraperv2/bbb/api/meeting/join/
//POST params : meeting_id,username,password
function meeting_join(){
	$return = array();
	extract($_POST);
	$bbb = new BigBlueButton\BigBlueButton();
	$joinMeetingParam = new BigBlueButton\Parameters\JoinMeetingParameters($meeting_id,$username,$password);
	$joinURL = $bbb->getJoinMeetingURL($joinMeetingParam);
	//return file_get_contents($joinURL);
	$xml = '<?xml version="1.0"?> <response><returncode>SUCCESS</returncode>';
	$xml .= '<joinurl><![CDATA['. $joinURL . ']]></joinurl></response>';
	return $xml;
}

//http://localhost/jobscraperv2/bbb/api/meeting/activemeetings/
function meeting_activemeetings(){
	$return = array();
	$bbb = new BigBlueButton\BigBlueButton();
	$meetingsObj = $bbb->getMeetings();
	//$meetings = $meetingsObj->getMeetings();
	$xml = $meetingsObj->getRawXml()->asXML();
	return $xml;
}

//http://localhost/jobscraperv2/bbb/api/recording/2/
//http://localhost/jobscraperv2/bbb/api/recording/meet2
//GET params : meeting_id
function recording(){
	global $args;
	$meeting_id = $args[0];
	$bbb = new BigBlueButton\BigBlueButton();
	$recordingParam = new BigBlueButton\Parameters\GetRecordingsParameters($meeting_id);
	$recordingParam->setState('any');
	$recordingURL = $bbb->getRecordingsUrl($recordingParam);
	$xml = '<?xml version="1.0"?> <response><returncode>SUCCESS</returncode>';
	$xml .= '<recordingurl><![CDATA['. $recordingURL . ']]></recordingurl></response>';
	return $xml;
	//return file_get_contents($recordings);
}


function escapeString(&$item1, $key)
{
	$item1 = addslashes($item1);
}



?>