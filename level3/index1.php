<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);
$site_url = 'https://'.$_SERVER['HTTP_HOST'].'/~demoserver/grouplocator/';

if($_POST['action'] == 'scrape'){
	if (ob_get_level() == 0) ob_start();
	echo '<PRE>';
	$url = trim($_POST['url']);
	$_POST['csv_file'] = "job_titles.csv";
	$time_start = microtime(true);
	$output = crawl_page($url,	$_POST['level_deep']);
	print_r($output);exit;
	require_once('html/output.php');
	exit;
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	//echo $time . ' secs';
}else{
	require_once('html/home.php');
}
$hrefs = array();
//https://www.airbnb.com/careers
function crawl_page($url,$depth = 1)
{
	$csv_file = $_POST['csv_file'];
	static $seen = array();
	global $hrefs;
	$output = array();
	ob_flush();
	flush();

	if ( $depth === 0) {
		//return "a"; 
		return $hrefs;
	}
	echo 'Scanned URL : ' . $url. '<br />';

	$seen[$url] = true;
	$dom = new DOMDocument();
	@$dom->loadHTML(get_url($url));
	$anchors = $dom->getElementsByTagName('a');
	foreach ($anchors as $element) {
		$str='';
		$href = $element->getAttribute('href');
		$job_title_file = fopen('job_titles.csv', 'r');
		$nodes = $element->childNodes;
		foreach ($nodes as $node) 
		{
			if(!empty($node->nodeValue) && trim($node->nodeValue) != '' && $node->nodeName != 'img'  ){
				$o_job_title = '';
				while($row = fgetcsv($job_title_file)){
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
				$hrefs[$url][] = $href;
				crawl_page($href, $depth - 1);
				//$str .= $node->nodeName . ' : '. $node->nodeValue. ",";
			}
		}
	}
}


function get_url($url)
{
	$curl = curl_init();
	$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

	$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml, text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
	$header[] = "Cache-Control: max-age=0"; 
	$header[] = "Connection: keep-alive"; 
	$header[] = "Keep-Alive: 300"; 
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
	$header[] = "Accept-Language: en-us,en;q=0.5"; 

	curl_setopt($curl, CURLOPT_URL, $url); 
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Ubuntu/10.04 Chromium/6.0.472.53 Chrome/6.0.472.53 Safari/534.3'); 
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
	curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); 
	curl_setopt($curl, CURLOPT_VERBOSE, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
	$data = curl_exec($curl);
	//print_r($data);
	$info = curl_getinfo($curl);
	//print_r($info);exit;
	//$logfile = fopen("crawler.log","a");
	//echo fwrite($logfile,'Page ' . $info['url'] . ' fetched in ' . $info['total_time'] . ' seconds. Http status code: ' . $info['http_code'] . "\n");
	//fclose($logfile);
	curl_close($curl);
	return $data;
}


?>