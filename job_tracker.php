<?php
error_reporting(0);
ini_set('max_execution_time', 0);
$time_start = microtime(true);
//error_log('SCRAPER STARTED : ' . date('Y-m-d H:i:s') . "\n", 3, dirname(__FILE__).'/scrap_log.txt');
$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/jobscrapperv2/';
$dir = dirname(__FILE__).'/';
require($dir.'db.php');
require($dir.'model.php');
$_POST['csv_file'] = 'job_titles';

$model= new Model();
$sites = $model->getActiveSites();

//if (ob_get_level() == 0) ob_start();
foreach($sites as $sindxK => $site){
	$site_scrap_time_start = microtime(true);
	//$model->deleteTodaysJobActivities($site['id'],date('Y-m-d',time()));
	unset($output);
	$url = $site['job_url'];
	#echo ($sindxK+1) . ' : ' . $url. '  ';
	$output = crawl_page($url,1);
	if(count($output[1]) <= 4){
		/*$content_search = contentSearch($url);
		$result = array_merge($output[1],$content_search);
		unset($output[1]);
		$output[1] = $result; */
	}
	$site_scrap_time_end = microtime(true);
	$site_scrap_time = $site_scrap_time_end - $site_scrap_time_start;
	//echo  $site_scrap_time	  . ' secs'. '(site scrap time)<br />';
	#echo '<br />';

	//ob_flush();
	//flush();
	$site_scrap_time_start = microtime(true);
	$lastScrapedSiteJobs = $model->getSiteJobs($site['id']);
	//checking currently scraped jobs with previously scraped jobs
	foreach($lastScrapedSiteJobs as $ljob){
		$jobExpired = true;
		foreach($output[1] as $outputIndx => $job){
			if(strtolower(trim($job[0])) == strtolower(trim($ljob['job_title']))){ //if existed
				$model->updateJobStatus($site['id'],$ljob['id'],'open');
				unset($output[1][$outputIndx]); //remove from checking pool
				$jobExpired = false;
				break;
			}
		}
		if($jobExpired){
			$model->updateJobStatus($site['id'],$ljob['id'],'expired');
		}
	}//outer for
	//all remaining job are NEW, becoz they are neither existed nor expired status
	if($model->jobsExistsForSite($site['id'])){
		$model->addNewJobs($site['id'],$output[1],'new');
	}else{
		$model->addNewJobs($site['id'],$output[1],'open');
	}
	
	$model->recordjobCount($site['id']);
	$site_scrap_time_end = microtime(true);
	$site_scrap_db = $site_scrap_time_end - $site_scrap_time_start;
	#$ts = date("Y-m-d H:i:s");
	#error_log("$ts  $url = SITE SCRAP TIME : $site_scrap_time secs, DB TIME  : $site_scrap_db \n", 3, dirname(__FILE__).'/scrap_log.txt');
	
}//end for sites


$time_end = microtime(true);
$time = $time_end - $time_start;
//echo  '<br />' .  $time . ' secs';
error_log('TOTAL SCRAPED TIME on DAY  ' . date('Y-m-d H:i:s') . ' is ' .   $time  . " secs \n", 3, dirname(__FILE__).'/scrap_log.txt');

exit;

function pr($a){
	echo '<PRE>';
	print_r($a);
	echo '</PRE>';
}


function contentSearch($url){
	$dom = new DOMDocument;
	@$dom->loadHTMLFile($url);
	//$dom->loadHTML( '<?xml encoding="UTF-8">' . $content );
	$output = array();
	$csv_file = $_POST['csv_file'];

	$xpath = new DOMXPath( $dom );
	$textNodes = $xpath->query( '//text()' );
	foreach ( $textNodes as $textNode ) {
		$parent = $textNode;
		while ( $parent ) {
			if ( ! empty( $parent->tagName ) && in_array( strtolower( $parent->tagName ), array( 'pre', 'code', 'a' ) ) && str_word_count($parent->nodeValue) > 6 ) {
					continue 2;
			}
			if(str_word_count($parent->nodeValue) < 6 && !empty($parent->tagName) ){
				$job_title_file = fopen("$csv_file" .".csv", 'r');
				while($row = fgetcsv($job_title_file)){
					$nv = strip_tags($parent->nodeValue);
					if(preg_match("/\b". $row[0] . "\b/i", $nv)){ //job title found
						//echo $parent->tagName . '===' . $parent->nodeValue . '===' .  $row[0] . '<br />';
						$output[] = array($nv,'');
						fclose($job_title_file);
						break;
					}
				}
			}
			$parent = $parent->parentNode;
		}//end while parent
	}//end  for
	return $output;
}//end function

function crawl_page($url,$depth = 1)
	{
	//echo $url;
	$csv_file = $_POST['csv_file'];
	//if (ob_get_level() == 0) ob_start();
	static $seen = array();
	if (isset($seen[$url]) || $depth === 0) {
		return;
	}
	//echo 'Scanned URL : ' . $url. '<br /><br /><br />';
	$seen[$url] = true;
	$output = array();
	$dom = new DOMDocument('1.0');
	$dom->loadHTMLFile($url);
	
	$anchors = $dom->getElementsByTagName('a');
	foreach ($anchors as $element) {
		$str='';
		$href = $element->getAttribute('href');
		//if(validURL($href)){
			//echo dirname(__FILE__).'/'. $csv_file. ".csv";
			$job_title_file = fopen(dirname(__FILE__).'/'.$csv_file .".csv", 'r');
			//var_dump($job_title_file);
			//$job_title_file = fopen('job_titles.csv', 'r');
			//echo $href . '<br /><br />';
			$nodes = $element->childNodes;
			//$str .= $href . " : ";
			foreach ($nodes as $node) 
			{
				if(!empty($node->nodeValue) && trim($node->nodeValue) != '' && $node->nodeName != 'img'  ){
					$o_job_title = '';
					while($row = fgetcsv($job_title_file)){
						//echo   $row[0] . '===' . $node->nodeValue . '<br />';
						//$match	= strripos( $node->nodeValue,$row[0]);
						//if($match !== false){
						if(preg_match("/\b". $row[0] . "\b/i", $node->nodeValue)){
							//echo $href . '==='. $node->nodeValue . '===' .  $row[0] . '<br />';
							$o_job_title = $node->nodeValue .'';
							fclose($job_title_file);
							break;
						}
					}
					if(!empty($o_job_title)){
						$output[] = array($o_job_title,$href);
					}
					//$str .= $node->nodeName . ' : '. $node->nodeValue. ",";
					break;
				}
			}
		//}validURL
		//$output[]=array($href,$element->nodeValue);
		//echo $element->nodeValue . " : " . $href . "<br />";                       // Output content
		//ob_flush();
		//flush();
		//sleep(2);
		if (0 !== strpos($href, 'http')) {
			$path = '/' . ltrim($href, '/');
			if (extension_loaded('http')) {
				$href = http_build_url($url, array('path' => $path));
			} else {
				$parts = parse_url($url);
				$href = $parts['scheme'] . '://';
				if (isset($parts['user']) && isset($parts['pass'])) {
					$href .= $parts['user'] . ':' . $parts['pass'] . '@';
				}
				$href .= $parts['host'];
				if (isset($parts['port'])) {
					$href .= ':' . $parts['port'];
				}
				$href .= $path;
			}
		}
		//crawl_page($href, $depth - 1);
	}
	//ob_end_flush();
	
	return array($seen,$output);
}

function validURL($url){
	$urlComp = parse_url($url);
	//echo $url;print_r($urlComp);
	if(isset($urlComp['host']))return true;
	elseif(isset($urlComp['path']) && !isset($urlComp['host']) )return true;
	elseif(!isset($urlComp['path']))return false;
	else return false;
}//end function

mysql_close($link);

?>
