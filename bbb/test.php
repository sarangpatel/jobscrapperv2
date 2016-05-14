<?php
error_reporting(-1);
require_once('vendor/autoload.php');
$bbb = new BigBlueButton\BigBlueButton();

$createMeetingParam = new BigBlueButton\Parameters\CreateMeetingParameters('meeeting-id2','my test meeting');
print_r($bbb->createMeeting($createMeetingParam));
//exit;

$joinMeetingParam = new BigBlueButton\Parameters\JoinMeetingParameters('meeeting-id2','moderator1','9x5KTpuN');
echo $bbb->getJoinMeetingURL($joinMeetingParam);
?>