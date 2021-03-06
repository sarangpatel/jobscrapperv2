<?php
class Model{
	
	public function Model(){
	
	}//end function


	function displaySiteJobs($site_url){
		//phpinfo();
		$siteJobs= array();
		$sql = "SELECT * from sites where site_url = '$site_url' limit 1;";
		//echo $sql;
		$result = mysql_query($sql);
		$site = mysql_fetch_assoc($result);
		while($row = mysql_fetch_assoc($result)){
			$site = $row;
		}
		$ts = date('Y-m-d H:i:s');
		//$sql = "SELECT * from jobs where site_id = $site[0] and job_url != '' and updated_on = $ts ;";
		$sql = "SELECT * from jobs where site_id = {$site['id']} and job_status != 'expired' ;";

		//$sql = "SELECT * from jobs where site_id = {$site['id']} and job_url != '' ;";

		//echo $sql;
		$result = mysql_query($sql);
		$siteJobs['site_data']	 = $site;
		while($row = mysql_fetch_assoc($result)){
			$diff = abs(strtotime($row['updated_on']) - strtotime($row['created_on']));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			$row['job_duration'] = "$days day(s) old"	; 
			$siteJobs['site_data']['job_data'][] = $row;
		}

		$lastWeekActivities = $this->getLastWeekActivities($site['id'],'');

		$lastWeekActivitiesNew = $this->getLastWeekActivities($site['id'],'new');
		$openJobs = $this->getJobCount($site['id'],$lastWeekActivitiesNew,'open');

		$lastWeekActivitiesExpired = $this->getLastWeekActivities($site['id'],'expired');
		//$expiredJobs = $this->getJobCount($site['id'],$lastWeekActivitiesExpired,'expired');

		$siteJobs['site_data']['activity_data']['open'] = $openJobs  ;
		$siteJobs['site_data']['activity_data']['expired'] = $lastWeekActivitiesExpired  ;
		$siteJobs['site_data']['activity_data']['activity'] = $lastWeekActivities  ;

		print_r($siteJobs);exit;
		mysql_free_result($result);
		return $siteJobs;
	}

	

	//statu = open/expired
	function getJobCount($site_id,$lastWeekActivities,$status){
		$lastWeekActivitiesTemp = $lastWeekActivities;
		unset($lastWeekActivities);
		$lastWeekActivities = $lastWeekActivitiesTemp;	
		foreach($lastWeekActivities as $d => $v){
			$sql = "SELECT count(1) from jobs where site_id = $site_id AND job_status='$status';";
			$result = mysql_query($sql);
			$row = mysql_fetch_row($result);
			$displayDate = date('D m/d',strtotime($d));
			$lastWeekActivities[$displayDate] = $v + $row[0];
		}
		return $lastWeekActivities;
	}

	function getLastWeekActivities($site_id,$status=''){

		if(!empty($status)){
			$statusStr = "  and change_activity = '$status'  ";
		}

		$activities = array();
		$recorded_activity = array();
		$sql = "SELECT count(recorded_on) as activity_count, site_id,job_id, recorded_on FROM `job_activities` WHERE site_id = $site_id and recorded_on >= DATE_SUB(NOW(),INTERVAL 7 DAY) $statusStr group by recorded_on ORDER BY `recorded_on` ASC;";
		//echo $sql;
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result)){
			$activities[] = $row;
		}
		mysql_free_result($result);
		$endDate = time();
		$lastWeekDate = $endDate - 6*24*60*60; ///7 days in seconds
		while($lastWeekDate <= $endDate){
			$found = false;
			foreach($activities as $activity){
				$loggedDate = date('Y-m-d', strtotime($activity['recorded_on']));
				$displayDate = date('Y-m-d', $lastWeekDate);
				if($loggedDate == $displayDate){
					$recorded_activity[$displayDate] = $activity['activity_count'];
					$found = true;
					break;
				}
			}
			if(!$found){
				$displayDate = date('Y-m-d', $lastWeekDate);
				$recorded_activity[$displayDate] = 0;
			}
			$lastWeekDate += 1*24*60*60; // add 1 day
		}
		return $recorded_activity;
	}//end function
	



	function getActiveSites(){
		//$sql = "SELECT * from sites WHERE active = 1 and id > 1000 order by id"; BIG Benchmarking
		$sql = "SELECT * from sites WHERE active = 1 and id < 301 order by id";
		$result = mysql_query  ($sql);
		$sites = array();
		while($row = mysql_fetch_assoc($result)){
			$sites[] = $row;
		}
		mysql_free_result($result);
		return $sites;
	}//end function

	function getSiteJobs($site_id){
		$sql = "SELECT id, job_title from jobs WHERE site_id = $site_id AND job_status != 'expired'; ";
		$result = mysql_query  ($sql);
		$jobs = array();
		while($row = mysql_fetch_assoc($result)){
			$jobs[] = $row;
		}
		mysql_free_result($result);
		return $jobs;
	}

	function addNewJobs($site_id,$jobData,$status){
		foreach($jobData as $job){
			$job[0] = mysql_real_escape_string($job[0]);
			$job[1] = mysql_real_escape_string($job[1]);
			$sql = "INSERT INTO jobs (site_id,job_title,job_url,job_status) VALUES ".
				" ($site_id,'{$job[0]}','{$job[1]}','$status');";
			mysql_query($sql);
			$last_inserted_id = mysql_insert_id(); 
			if($status == 'new'){
				$this->updateChangeActivity($site_id,$last_inserted_id,$status);
			}
		}
	}

	function updateJobStatus($site_id,$job_id,$status){
		//$time_start = microtime(true);
		$sql = "UPDATE jobs set job_status = '$status',updated_on = NOW() where id = $job_id limit 1";
		mysql_query($sql);
		//$time_end = microtime(true);
		//$time = $time_end - $time_start;
		//echo  '<br />' .  $time . ' secs (updating status of a job)';
		if($status == 'expired'){
			$this->updateChangeActivity($site_id,$job_id,$status);
		}
	}

	function updateChangeActivity($site_id,$job_id,$activity){
		
		if($this->trackedActivityStarted()){
			$sql = "INSERT INTO job_activities (site_id,job_id,change_activity) VALUES ".
			" ($site_id,$job_id,'$activity');";
			mysql_query($sql);
		}
	}

	function trackedActivityStarted(){

		$sql = "SELECT count(1) as recordfound from jobs WHERE created_on <= DATE_SUB( NOW() , INTERVAL 1 DAY ); ";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		if($row[0] > 0)return true; else return false;
	}

	function deleteTodaysJobActivities($site_id,$today){
		$sql = "DELETE from job_activities WHERE recorded_on >= '$today' and site_id = $site_id ;";
		mysql_query($sql);
	}

	function jobsExistsForSite($site_id){
		$sql = "SELECT count(1) as recordfound from jobs WHERE site_id = $site_id; ";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		if($row[0] > 0)return true; else return false;
	}


}//end class

?>