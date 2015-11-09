<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);
$site_url = 'https://'.$_SERVER['HTTP_HOST'].'/~demoserver/grouplocator/';


if($_POST['action'] == 'scrape'){
	$url = trim($_POST['url']);
	$depth = $_POST['level_deep'];
	//$match_percent = $_POST['match_percent'];
	$time_start = microtime(true);
	
	$output = crawl_page($url,$depth);
	require_once('html/output.php');
	exit;
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	//echo $time . ' secs';
}else{
	require_once('html/home.php');
}



function crawl_page($url,$depth = 1)
{
	require_once 'vendor/autoload.php';
	$job_title_file = fopen("job_titles", 'r');

	// Initiate crawl
	$crawler = new \Arachnid\Crawler($url, $depth);
	$crawler->traverse();
	// Get link data
	$links = $crawler->getLinks();
	foreach($links as $lnk => $link){
		if(!empty($link['links_text'])){
			foreach($link['links_text'] as $tx){
				while($row = fgetcsv($job_title_file)){
					if(preg_match("/\b". $row[0] . "\b/i", $tx)){
						echo $lnk . '==='. $tx . '===' .  $row[0] . '<br />';
						$o_job_title = $tx ;
						break;
					}
				}//end while fgetcsv
				if(!empty($o_job_title)){
					$output[] = array($o_job_title,$lnk);
				}
			}//for link text
		}//empty links_text
	}//for each link
	fclose($job_title_file);
	return $output;
}//end function

?>