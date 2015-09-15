<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);
$site_url = 'https://'.$_SERVER['HTTP_HOST'].'/~demoserver/grouplocator/';

if($_POST['action'] == 'scrape'){
	$url = trim($_POST['url']);
	//$match_percent = $_POST['match_percent'];
	$time_start = microtime(true);
	$output = crawl_page($url,1);
	//exit;
	//echo count($output[1]);exit;
	//print_r($output[1]);exit;
	require_once('html/output.php');
	exit;
	//echo '<PRE>';
	//echo 'Total URLs Scanned : ' . count($output[0]) . ', Total Links :  '.  count($output[1]);
	//print_r($output[1]);
	//echo '</PRE>';
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	//echo $time . ' secs';
}else{
	require_once('html/home.php');
}

function crawl_page($url,$depth = 1)
{
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
	@$dom->loadHTMLFile($url);
	
	$anchors = $dom->getElementsByTagName('a');
	foreach ($anchors as $element) {
		$str='';
		$href = $element->getAttribute('href');
		//if(validURL($href)){
			$job_title_file = fopen("$csv_file" .".csv", 'r');
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
		crawl_page($href, $depth - 1);
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

?>