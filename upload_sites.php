<?php
error_reporting(0);
ini_set('max_execution_time', 0);

$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscrapperv2/';
$dir = dirname(__FILE__).'/';

require($dir.'db.php');
//require_once($dir.'model.php');
//$model= new Model();

if (ob_get_level() == 0) ob_start();

$time_start = microtime(true);
//$jobs = fopen("sites.csv", 'r');
$jobs = fopen("sites_unique.csv", 'r');

while($row = fgetcsv($jobs)){
	if(!empty($row[2])){
		$url = trim($row[2]);
		insertSite($row);
		echo 'Site uploaded : '. $row[1]. '<br />';
		ob_flush();
		flush();
	}//end if job url not empty 
}//end while
fclose($jobs);

$time_end = microtime(true);
$time = $time_end - $time_start;
echo  '<br />' .  $time . ' secs';
exit;

function insertSite($data){
	array_walk($data, 'escapeString');
	$query = "INSERT INTO sites (site_url,job_url,job_email,contact_email,linkedin,facebook,twitter,active) VALUES ".
			" ('$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]',1);";
	mysql_query($query);
}

function escapeString(&$item1, $key)
{
	$item1 = mysql_real_escape_string($item1);
}


function pr($a){
	echo '<PRE>';
	print_r($a);
	echo '</PRE>';
}


mysql_close($link);

?>